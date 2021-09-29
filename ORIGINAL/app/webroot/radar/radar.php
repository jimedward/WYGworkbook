<?php

/**
 * Produces a PNG radar plot of the results passed in through GET parameters.
 *
 * Assumes that the files 'radar_grid.png' and 'radar_scale.png' exist in the 
 * same directory as the file.  These provide templates that are layered together
 * with the data to form the graph.
 */
 
/* The X and Y coordinates of the center of the graph in radar_grid.png */


define('FONT',2);
define('POINT_SIZE',25);

/* The distance between the center and the value 1 on the graph */
define('SCALE',37);


$all_product_specs = array(
  'PSA' => array(
    'categories' => 8,
    'height' => 445,
    'width' => 536,
    'centerx' => 260,
    'centery' => 210,
  ),
  
);


$product = "PSA";
$product_specs = $all_product_specs[$product];

define('CENTER_X', $product_specs['centerx']); 
define('CENTER_Y', $product_specs['centery']);
//----------------------------------------------

/**
 * Answer an array of values representing the averages of each 
 * category.  These are expected to be passed in using a GET request
 * as the array q
 *
 * Outputs an error image if the input is not as expected
 */
function results() {
  global $product_specs, $product;
  $data = unserialize(base64_decode($_GET['q']));
  
  //check to see that we have 11 results
  if(count($data) != $product_specs['categories']) {
    error_image("An unexpected error has occurred.\n\nError code: 1");
  }
  //ensure that all values are valid
  for($i=0; $i < count($data); $i++) {
    if(! ($data[$i] >= 1.0 && $data[$i]  <= 5.0) ) {
      error_image("An unexpected error has occurred.\n\nError code: 2");
    }
  }
  return $data;
}

/**
 * Answer an image object build from the png $pngfile
 */
function loadpng($pngfile) {
  $im = imagecreatefrompng($pngfile);

  if (!$im) { /* See if it failed */
    error_image("Error loading $pngfile");
  }
  return $im;
}

/**
 * Output to the browser an error message as a png image, 
 * 300x300 pixels.  The only contents of the image is a 
 * black text string with the contents of $error.
 *
 * @param error The error string
 */
function error_image($error) {
  $im  = imagecreatetruecolor(300, 300); /* Create a blank image */
  $bgc = imagecolorallocate($im, 255, 255, 255);
  $tc  = imagecolorallocate($im, 0, 0, 0);
  imagefilledrectangle($im, 0, 0, 300, 300, $bgc);
  /* Output an errmsg */
  imagestring($im, 5, 5, 5, $error, $tc);
  header("Content-Type: image/png");
  imagepng($im);
  exit;
}

/**
 * Produce a png image of the argument and output to the browser, along
 * with proper header.
 */
function display_image($image) {
  header("Content-Type: image/png");
  imagepng($image);
}

/**
 * Answer an array of the (x,y) coordinates that correspond to the polygon vertex
 * appropriate for the radar chart value.
 *
 * $center - the array of the (x,y) coordinates representing the center of this graph
 * $scale  - the distance from the center to the value 1
 * $axis   - the axis, represented on a scale of 0 to 1, for this value (eg, 2.0/11.0)
 * $value  - the value to plot
 */
function get_coords($center, $scale, $axis, $value) {
  $theta = $axis * 2 * pi() * -1;
  $x = $value * sin($theta) * $scale;
  $y = $value * cos($theta) * $scale;
  return array($center[0] - $x,$center[1] - $y);
}


$results = results();
$imgname = 'grid_psa.png';
$img = loadpng($imgname);
$scaleimg = loadpng("radar_scale.png");

$primary  = imagecolorallocatealpha($img,65,147,162,15);
$black = imagecolorallocate($img,0,0,0);
$red = imagecolorallocate($img,206,30,3);
$white = imagecolorallocate($img,255,255,255);

imageantialias($img,true);


$points = array();

// the image polygon functions in php take a list of points as
// array(point1x, point1y, point2x, point2y, ...)
// so iterate through the results generating the coordinates for 
// each and append them to the $points array
for ($i=0; $i<count($results) ; $i++) {
  $vertex = get_coords(array(CENTER_X,CENTER_Y),SCALE,$i/($product_specs['categories'] + 0.0),$results[$i]);
  $points[] = $vertex[0];
  $points[] = $vertex[1];
}

//draw the radar data
imagefilledpolygon($img,$points,$product_specs['categories'],$primary);

//add an outline
imagesetthickness($img,2);
imagepolygon($img,$points,$product_specs['categories'],$black);

//add the scale from an overlay image
imagecopy($img,$scaleimg,0,0,0,0,$product_specs['width'],$product_specs['height']);

//add some circles as datapoints
for ($i=0; $i<count($results) ; $i++) {
  imagefilledellipse($img,$points[$i*2],$points[$i*2+1],POINT_SIZE,POINT_SIZE,$red);
  imageellipse($img,$points[$i*2],$points[$i*2+1],POINT_SIZE,POINT_SIZE,$black);
}


// add values to the chart
for ($i=0; $i<count($results) ; $i++) {
  $vertex = get_coords(array(CENTER_X,CENTER_Y),SCALE,$i/($product_specs['categories'] + 0.0),$results[$i]);
  imagestring($img,FONT,$vertex[0] - imagefontwidth(FONT) * 3 / 2,$vertex[1] - imagefontheight(FONT) /2  ,$results[$i],$white);
}


display_image($img);
?>