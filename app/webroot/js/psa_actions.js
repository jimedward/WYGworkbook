function getCheckedValue(name) {
	input = Form.getInputs('PsaTestAddForm','radio',name).find(function(radio) { return radio.checked; });
	
	if (input) { 
	  return input.value; 
	} else {
	  return null;
	}
  
}

function update_all_statuses() { 
  var names = all_radio_names();
  for (var i = 0; i < names.length ; i++) {
    updatestatus(names[i]);
  }
}

function all_radio_names() {
  var result = $('PsaTestAddForm').getInputs('radio').map(function (e) {
    return e.name;
  }).uniq();
  return result;
}

function checkform() {
  var result = true;
  var names = all_radio_names();
  
  for(var i = 0 ; i < names.length; i++) {
    if(!getCheckedValue(names[i])) {
      result = false;
      var statuselement = $("status" + names[i]);
      statuselement.innerHTML = " Please Select";
      statuselement.addClassName('warning');
      statuselement.highlight();
    }
  }  
  if(result == false) { 
    $('errorplaceholder').style['display'] = 'block';
  }
  return result;
}

function updatestatus(name) {
 var txtValue = "";
 switch (getCheckedValue(name)) {
   case "1": 
     txtValue = "Strongly Disagree";
     break;
   case "2":
     txtValue = "Disagree";
     break;
   case "3": 
     txtValue = "Neutral";
     break;
   case "4":
     txtValue = "Agree";
     break;
   case "5": 
     txtValue = "Strongly Agree";
     break;
   }
   $("status" + name).innerHTML = txtValue;
   $("status" + name).removeClassName('warning');
}