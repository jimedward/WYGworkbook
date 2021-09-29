function checkform() {
  
  var result = true;
  var names = $('AscTestAddForm').getInputs('radio').map(function (e) {
    return e.name;
  }).uniq();
  
  for(var i = 0 ; i < names.length; i++) {
    var statuselement = $("status_for_" + names[i]);
    
    if(!getCheckedValue(names[i])) {
      result = false;
      statuselement.innerHTML = " Please Select";
      statuselement.addClassName('warning');
      statuselement.highlight();
    } else {
      statuselement.innerHTML = "";
    }
  }  
  if(result == false) { 
    $('errorplaceholder').style['display'] = 'block';
  }
  return result;
}

function getCheckedValue(name) {
	input = Form.getInputs('AscTestAddForm','radio',name).find(function(radio) { return radio.checked; });
	if (input) { 
	  return input.value; 
	} else {
	  return null;
	}
  
}
