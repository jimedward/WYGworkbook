<?php 
App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

$tcpdf->SetAuthor("What's Your Genius by Jay Niblick"); 
$tcpdf->SetAutoPageBreak( true ); 
$tcpdf->setHeaderFont(array($textfont,'',24)); 
$tcpdf->xheadercolor = array(255,255,255); 
$tcpdf->xheadertext = 'What\'s Your Genius Problem Self Assessment'; 
$tcpdf->xfootertext = 'Copyright %d What\'s Your Genius by Jay Niblick. All rights reserved.'; 



// Now you position and print your page content 
// example:  
$tcpdf->SetTextColor(0, 0, 0); 
$tcpdf->SetFont($textfont,'B',20); 
$tcpdf->Cell(0,14, "Hello World", 0,1,'L'); 
// ... 
// etc. 
// see the TCPDF examples  

echo $tcpdf->Output('filename.pdf', 'I'); 

?>