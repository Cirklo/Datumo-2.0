/*
	cloneFieldset.js
	by Nathan Smith, sonspring.com

	Additional credits:
	> Ara Pehlivanian, arapehlivanian.com
	> Jeremy Keith, adactio.com
	> Jonathan Snook, snook.ca
	> Peter-Paul Koch, quirksmode.org
*/


// insertAfter function, by Jeremy Keith
function insertAfter(newElement, targetElement)
{
	var parent = targetElement.parentNode;
	parent.appendChild(newElement); //add clone fields to the end of the parent table	
}


// Suffix + Counter
var suffix = '__';
var counter = 1;


// Clone nearest parent fieldset
function cloneMe(a, val, origin)
{
	// Increment counter
	counter++;

	// Find nearest parent tr
	var original = a.parentNode;
	while (original.nodeName.toLowerCase() != 'tr')
	{
		original = original.parentNode;
	}
	
	var duplicate = original.cloneNode(true);
	
	// form - Name + ID
	var newForm = duplicate.getElementsByTagName('form');
	for (var i = 0; i < newForm.length; i++)
	{
		var formName = newForm[i].name;
		if (formName)
		{
			oldForm = formName.indexOf(suffix) == -1 ? formName : formName.substring(0, formName.indexOf(suffix));
			newForm[i].name = oldForm + suffix + counter;
			//alert(document.tableman.elements[oldName].value);
			//newSelect[i].value = document.tableman.elements[oldName].value;
		}
		var CurForm = newForm[i];
	}

	// Input - Name + ID
	var newInput = duplicate.getElementsByTagName('input');
	if(!origin){
		for (var i = 0; i < newInput.length; i++)
		{
			var inputName = newInput[i].name;
			if (inputName)
			{
				oldName = inputName.indexOf(suffix) == -1 ? inputName : inputName.substring(0, inputName.indexOf(suffix));
				newInput[i].name = oldName + suffix + counter;
			}
			var inputId = newInput[i].id;
			if (inputId)
			{
				oldId = inputId.indexOf(suffix) == -1 ? inputId : inputId.substring(0, inputId.indexOf(suffix));
				var fk = newInput[i].lang;
				if (fk.indexOf('__fk') != -1){ //Search for external keys
					newInput[i].id = oldId + suffix + counter; //oldId in the old version
					newInput[i].onfocus = function(){
						//alert(str);
						$(this).simpleAutoComplete("autoSuggest.php?field="+newInput[i].id);
					};
				}else{
					newInput[i].id = oldId + suffix + counter;
				}
				 
			}			
		}
	}
	// Select - Name + ID
	var newSelect = duplicate.getElementsByTagName('select');
	for (var i = 0; i < newSelect.length; i++)
	{
		var selectName = newSelect[i].name;
		if (selectName)
		{
			oldName = selectName.indexOf(suffix) == -1 ? selectName : selectName.substring(0, selectName.indexOf(suffix));
			newSelect[i].name = oldName + suffix + counter;
			//alert(document.tableman.elements[oldName].value);
			//newSelect[i].value = document.tableman.elements[oldName].value;
		}
		var selectId = newSelect[i].id;
		if (selectId)
		{	
			oldId = selectId.indexOf(suffix) == -1 ? selectId : selectId.substring(0, selectId.indexOf(suffix));
			newSelect[i].id = oldId + suffix + counter;
		}
	}	
	duplicate.className = 'duplicate';
	insertAfter(duplicate, original);
}


// Delete nearest parent tr
function deleteMe(a)
{
	var duplicate = a.parentNode;
	while (duplicate.nodeName.toLowerCase() != 'tr')
	{
		duplicate = duplicate.parentNode;
	}
	duplicate.parentNode.removeChild(duplicate);
}

