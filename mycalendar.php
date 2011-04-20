<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title>	My Calendar </title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="css/mycalendar/dailog.css" rel="stylesheet" type="text/css" />
    <link href="css/mycalendar/calendar.css" rel="stylesheet" type="text/css" /> 
    <link href="css/mycalendar/dp.css" rel="stylesheet" type="text/css" />   
    <link href="css/mycalendar/alert.css" rel="stylesheet" type="text/css" /> 
    <link href="css/mycalendar/main.css" rel="stylesheet" type="text/css" /> 
    <link href="css/tipTip.css" rel="stylesheet" type="text/css">
    
    <script src="js/jquery-1.4.4.js" type="text/javascript"></script>  
	<script type="text/javascript" src="js/jquery.tipTip.js"></script>
    <script src="js/mycalendar/Common.js" type="text/javascript"></script>    
    <script src="js/mycalendar/datepicker_lang_US.js" type="text/javascript"></script>     
    <script src="js/mycalendar/jquery.datepicker.js" type="text/javascript"></script>

    <script src="js/mycalendar/jquery.alert.js" type="text/javascript"></script>    
    <script src="js/mycalendar/jquery.ifrmdailog.js" defer="defer" type="text/javascript"></script>
    <script src="js/mycalendar/wdCalendar_lang_US.js" type="text/javascript"></script>    
    <script src="js/mycalendar/jquery.calendar.js" type="text/javascript"></script>   
    
    <script type="text/javascript">


 	
/*
 * Plugin to implement mycalendar. This is just a visualization tool so, for now, I'll disable add, update and delete features
 */

    $(document).ready(function() {  
		/*
		 * Initialize tiptip plugin
		 */
    	   $("*").tipTip();   

           var view="week";          
           
            var DATA_FEED_URL = "datafeed.php";
            var op = {
                view: view,
                theme:1,
                readonly: true,
                showday: new Date(),
                EditCmdhandler:Edit,
                DeleteCmdhandler:Delete,
                ViewCmdhandler:View,    
                onWeekOrMonthToDay:wtd,
                onBeforeRequestData: cal_beforerequest,
                onAfterRequestData: cal_afterrequest,
                onRequestDataError: cal_onerror, 
                autoload:true,
                url: DATA_FEED_URL + "?method=list",  
                quickAddUrl: DATA_FEED_URL + "?method=add", 
                quickUpdateUrl: DATA_FEED_URL + "?method=update",
                quickDeleteUrl: DATA_FEED_URL + "?method=remove"        
            };
            var $dv = $("#calhead");
            var _MH = document.documentElement.clientHeight;
            var dvH = $dv.height() + 2;
            op.height = _MH - dvH;
            op.eventItems =[];

            var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
            $("#caltoolbar").noSelect();
            
            $("#hdtxtshow").datepicker({ picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
            onReturn:function(r){                          
                            var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
                            if (p && p.datestrshow) {
                                $("#txtdatetimeshow").text(p.datestrshow);
                            }
                     } 
            });
            function cal_beforerequest(type)
            {
                var t="Loading data...";
                switch(type)
                {
                    case 1:
                        t="Loading data...";
                        break;
                    case 2:                      
                    case 3:  
                    case 4:    
                        t="The request is being processed ...";                                   
                        break;
                }
                $("#errorpannel").hide();
                $("#loadingpannel").html(t).show();    
            }
            function cal_afterrequest(type)
            {
                switch(type)
                {
                    case 1:
                        $("#loadingpannel").hide();
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $("#loadingpannel").html("Success!");
                        window.setTimeout(function(){ $("#loadingpannel").hide();},2000);
                    break;
                }              
               
            }
            function cal_onerror(type,data)
            {
                $("#errorpannel").show();
            }
            function Edit(data)
            {
               var eurl="edit.php?id={0}&start={2}&end={3}&isallday={4}&title={1}";   
                if(data)
                {
                    var url = StrFormat(eurl,data);
                    OpenModelWindow(url,{ width: 600, height: 400, caption:"Manage  The Calendar",onclose:function(){
                       $("#gridcontainer").reload();
                    }});
                }
            }    
            function View(data)
            {
                var str = "";
                $.each(data, function(i, item){
                    str += "[" + i + "]: " + item + "\n";
                });
                //alert(str);               
            }    
            function Delete(data,callback)
            {           
                
                $.alerts.okButton="Ok";  
                $.alerts.cancelButton="Cancel";  
                hiConfirm("Are You Sure to Delete this Event", 'Confirm',function(r){ r && callback(0);});           
            }
            function wtd(p)
            {
               if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $("#showdaybtn").addClass("fcurrent");
            }
            //to show day view
            $("#showdaybtn").click(function(e) {
                //document.location.href="#day";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("day").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            //to show week view
            $("#showweekbtn").click(function(e) {
                //document.location.href="#week";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("week").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //to show month view
            $("#showmonthbtn").click(function(e) {
                //document.location.href="#month";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("month").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
            $("#showreflashbtn").click(function(e){
                $("#gridcontainer").reload();
            });
            
            //Add a new event
            $("#faddbtn").click(function(e) {
                var url ="edit.php";
                OpenModelWindow(url,{ width: 500, height: 400, caption: "Create New Calendar"});
            });
            //go to today
            $("#showtodaybtn").click(function(e) {
                var p = $("#gridcontainer").gotoDate().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }


            });
            //previous date range
            $("#sfprevbtn").click(function(e) {
                var p = $("#gridcontainer").previousRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //next date range
            $("#sfnextbtn").click(function(e) {
                var p = $("#gridcontainer").nextRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
        });
    </script>    
</head>
<body>
<?php 

//variables
$title="Agendo reservation system: My Calendar";
$link="admin.php";

//initialize main div
echo "<div>";
//Set calendar title
echo "<div id='calhead' style='padding-left:1px;padding-right:1px;'>";          
echo "<div class='cHead'>";
echo "<div class='ftitle'>$title</div>";
echo "<div id='loadingpannel' class='ptogtitle loadicon' style='display: none;'>Loading data...</div>";
echo "<div id='errorpannel' class='ptogtitle loaderror' style='display: none;'>Sorry, could not load your data, please try again later</div>";
echo "</div>";          

//button toolbar definition
echo "<div id='caltoolbar' class='ctoolbar'>";
/* This div refers to add new event feature which is disabled for now
echo "<div id='faddbtn' class='fbutton'>";
echo "<div><span title='Click to Create New Event' class='addcal'>";
echo "New Event";                
echo "</span></div>";
echo "</div>";
*/

//Return to current day button
echo "<div class='btnseparator'></div>";
echo "<div id='showtodaybtn' class='fbutton'>";
echo "<div><span title='Click to back to today ' class='showtoday'>";
echo "Today</span></div>";
echo "</div>";

echo "<div class='btnseparator'></div>";
//button to display daily view
echo "<div id='showdaybtn' class='fbutton'>";
echo "<div><span title='Day' class='showdayview'>Day</span></div>";
echo "</div>";
//button to display week view
echo "<div  id='showweekbtn' class='fbutton fcurrent'>";
echo "<div><span title='Week' class='showweekview'>Week</span></div>";
echo "</div>";
//button to display monthly view
echo "<div  id='showmonthbtn' class='fbutton'>";
echo "<div><span title='Month' class='showmonthview'>Month</span></div>";
echo "</div>";

//button to refresh the page
echo "<div class='btnseparator'></div>";
echo "<div  id='showreflashbtn' class='fbutton'>";
echo "<div><span title='Refresh view' class='showdayflash'>Refresh</span></div>";
echo "</div>";
//button to select previous day/week/month
echo "<div class='btnseparator'></div>";
echo "<div id='sfprevbtn' title='Prev'  class='fbutton'>";
echo "<span class='fprev'></span>";
echo "</div>";
//button to select new day/week/month
echo "<div id='sfnextbtn' title='Next' class='fbutton'>";
echo "<span class='fnext'></span>";
echo "</div>";

//div to show calendar datepicker
echo "<div class='fshowdatep fbutton'>";
echo "<div>";
echo "<input type='hidden' name='txtshow' id='hdtxtshow' />";
echo "<span id='txtdatetimeshow'>Pick date</span>";
echo "</div>";
echo "</div>";

//separator to set a link back to main menu
echo "<div class='btnseparator'></div>";
echo "<div class='fshowdatep fbutton'>";
echo "<div>";
echo "<input type='hidden' name='txtshow' id='hdtxtshow' />";
echo "<span id='txtdatetimeshow'><a href=$link>Return to main menu</a></span>";
echo "</div>";
echo "</div>";

//nothing is set here ->Need to figure out if this is really necessary
//echo "<div class='clear'></div>";
echo "</div>";
echo "</div>";
echo "<div style='padding:1px;'>";
//echo "<div class='t1 chromeColor'>&nbsp;</div>";
//echo "<div class='t2 chromeColor'>&nbsp;</div>";
//this is where the main calendar is called
echo "<div id='dvCalMain' class='calmain printborder'>";
echo "<div id='gridcontainer' style='overflow-y: visible;'></div>";
echo "</div>";
//echo "<div class='t2 chromeColor'>&nbsp;</div>";
//echo "<div class='t1 chromeColor'>&nbsp;</div>";   
echo "</div>";
     
echo "</div>"; //End of main container
    

?>
</body>
</html>