$(document).ready(function(){
	/**
	 * Method to handle resource display in mycalendar
	 */
	
	$("#calRes").click(function(){
		var arr=new Array;
		$("#options").find("input[type=checkbox]:checked").each(function(){
			arr.push($(this).attr("id"));
		});
		
		//alert("NOT WORKING.... YET");
		$('#calendar').fullCalendar({
			editable: false,
			events: "calendar_feed.php?ids="+arr,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'

			},
			/*eventRender: function(event, element) {
		        element.qtip({
		            content: event.description
		        });
		    },*/
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
			
		});

		
	});
	
	
	
});