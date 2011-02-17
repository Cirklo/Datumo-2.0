arrayOfData = new Array(
			 [10.3,'Jan','#f3f3f3'],
			 [15.2,'Feb','#f4f4f4'],
			 [13.1,'Mar','#cccccc'],
			 [16.3,'Apr','#333333'],
			 [14.5,'May','#666666']
	 ); 
function projectInfo(account_id){	
	$('#projectGraph').html("");
	$.get("ajaxProject.php?graph",{
		account:account_id},
		function(data){
			//return the data
			var str=eval(data);
			//get info to draw graph bars
			$('#projectGraph').jqBarGraph({ 
				 data: arrayOfData, // array of data for your graph
				 height:400,
				 width:300
			 });
			
			$.get("ajaxProject.php?info",{
				account:account_id},
				function(data){
					$("#projectInfo").html(data);
					//$("#accountDetails_"+account_id).html(data);
				});
		}
	);
}
