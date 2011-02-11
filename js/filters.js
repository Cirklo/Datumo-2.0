
/**
 * @author João Lagarto / Nuno Moreno
 * @description function to submit filter forms
 */

function filter(name, objName, j, order, colOrder){
	//number of rows to be displayed
	if(j=="") var nrows = 20;
	else var nrows = document.getElementById("nrows"+j).value;
	if(!isNumber(nrows)){
		alert("Please insert a valid number!");
		return;
	}
	//get form
	var CurForm = eval("document."+name);
	for(var i=0;i<CurForm.length;i++){
		if(CurForm[i].lang=='__fk'){
			if(CurForm[i].alt==""){
				//alert(CurForm[i].alt);
				url="ajax.php?val=" + CurForm[i].value + "&var=" + CurForm[i].id;
			    var str = ajaxRequest(url);
			    CurForm[i].value = str;	
			} else {
				CurForm[i].value=CurForm[i].alt;
			}
		}
	}
	//form actions
	CurForm.action = "manager.php?table="+objName+"&nrows="+nrows+"&search=1&order="+order+"&colOrder="+colOrder;
	CurForm.submit();
}

/**
 * @author João Lagarto / Nuno Moreno
 * @description function to handle multiple clauses from the advanced filter
 * @extra Possibly this function can be used with multiple insert (don't know yet how i am going to implement it)
 *  
 */

//counter initializer -> variable created for control purposes
var flag = 1; //variable that counts the number of rows to submit through the advanced filter
function checknew(type, id){
	if(type == 'sum'){	
		//do not allow to add clauses if some are left blank
		var i = document.getElementById("multiple").value;
		if(flag > 1){ //more than 1 search clause
			if(document.getElementById("val__"+i).value=='') return;
			if(document.getElementById("field__"+i).value=='') return;
			if(document.getElementById("operator__"+i).value=='') return;
		} else {
			if(document.getElementById("val").value=='') return;
			if(document.getElementById("field").value=='') return;
			if(document.getElementById("operator").value=='') return;
		}
	
		var val = document.getElementById('multiple').value++;
		flag++;
		cloneMe(id, val);
	} else {
		flag--;
		deleteMe(id);
	}	
	//do not allow to change table if we have more than 1 clause
	if(flag==1) document.getElementById("table").disabled = false;
	else document.getElementById("table").disabled = true;
}

/**
 * @author João Lagarto / Nuno Moreno
 * @description function to submit the advanced filter
 * @extra Possibly can be used in both admin.php and manager.php
 */

function filterSubmit(form){
	//target table
	var objName = document.getElementById("table").value;
	//form from which the filter was applied
	var CurForm = eval("document."+form);
	//each clause from the filter has 3 elements: field, operator and value
	//Number of clauses = Form length divided by 3 elements 
	var clauses = new Array(CurForm.length/3);
	var ctrl = 0;
	for (var i=0; i<CurForm.length;i++){
		if(CurForm[i].value==''){
	    	alert("Enter all parameters to submit filter!");
	    	return;
	    }
		if (ctrl == 0) {
			var att = CurForm[i].value;
		} else if (ctrl == 2) {
			url="ajaxFilter.php?val=" + CurForm[i].value + "&table=" + objName + "&att="+att;
		    var str = ajaxRequest(url);
		    CurForm[i].value = str;
		}
	    ctrl++;
	    if(ctrl==3) ctrl=0;
	    
	}
	CurForm.action = "manager.php?table="+objName+"&nrows=20&no=" + CurForm.length + "&filter=true&search=2";
	CurForm.submit();
}

/**
 * @author João Lagarto / Nuno Moreno
 * @description fmethod to handle page navigation with filter
 */
//
function submit(search, objName, nrows, order, colOrder, page){
	if(search == ''){
		onclick=window.open("manager.php?table="+objName+"&nrows="+nrows+"&order="+order+"&colOrder="+colOrder+"&page="+page,'_self');
	}
	if(search == 1){ //regular filter search
		//get form
		var CurForm = eval("document.table");
		for(var i=0;i<CurForm.length;i++){
			if(CurForm[i].lang=='__fk'){
				url="ajax.php?val=" + CurForm[i].value + "&var=" + CurForm[i].id;
			    var str = ajaxRequest(url);
			    CurForm[i].value = str;	
			}
		}
		CurForm.action = "manager.php?table="+objName+"&nrows="+nrows+"&order="+order+"&colOrder="+colOrder+"&page="+page+"&search=1";
		CurForm.submit();
	} 
	if(search == 2){ //advanced filter search
		var CurForm = eval("document.advFilter");
		//each clause from the filter has 3 elements: field, operator and value
		//Number of clauses = Form length divided by 3 elements 
		var clauses = new Array(CurForm.length/3);
		var ctrl = 0;
		for (var i=0; i<CurForm.length;i++){
			if (ctrl == 0) {
				var att = CurForm[i].value;
			} else if (ctrl == 2) {
				url="ajaxFilter.php?val=" + CurForm[i].value + "&table=" + objName + "&att="+att;
			    var str = ajaxRequest(url);
			    CurForm[i].value = str;
			}
		    ctrl++;
		    if(ctrl==3) ctrl=0;
		}
		CurForm.action = "manager.php?table="+objName+"&nrows="+nrows+"&order="+order+"&colOrder="+colOrder+"&page="+page+"&no=" + CurForm.length + "&filter=true&search=2";
		CurForm.submit();
	}
	
}

function qSubmit(objName,i){
	var CurForm = eval("document.qsearch"+i);
	var nrows = document.getElementById("qsearchNrows_"+i).value;
	CurForm.action = "manager.php?table="+objName+"&nrows="+nrows+"&search=3";
	CurForm.submit();
}

