<?php

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/hover.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/lib/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="calendar-style.css"> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script>

 $(document).ready(function() {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  var calendar = $('#calendar').fullCalendar({
   editable: true,
   header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
   },

   events: "events.php",

   eventRender: function(event, element, view) {
    if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
   },
   selectable: true,
   selectHelper: true,
   select: function(start, end, allDay) {
   var title = prompt('Event Title:');

   if (title) {
   var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
   $.ajax({
	   url: 'add_events.php',
	   data: 'title='+ title+'&start='+ start +'&end='+ end,
	   type: "POST",
	   success: function(json) {
	   alert('Added Successfully');
	   }
   });
   calendar.fullCalendar('renderEvent',
   {
	   title: title,
	   start: start,
	   end: end,
	   allDay: allDay
   },
   true
   );
   }
   calendar.fullCalendar('unselect');
   },

   editable: true,
   eventDrop: function(event, delta) {
   var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
   $.ajax({
	   url: 'update_events.php',
	   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
	   type: "POST",
	   success: function(json) {
	    alert("Updated Successfully");
	   }
   });
   },
   eventClick: function(event) {
	var decision = confirm("Do you really want to do that?"); 
	if (decision) {
	$.ajax({
		type: "POST",
		url: "delete_events.php",
		data: "&id=" + event.id,
		 success: function(json) {
			 $('#calendar').fullCalendar('removeEvents', event.id);
			  alert("Updated Successfully");}
	});
	}
  	},
   eventResize: function(event) {
	   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
	   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
	   $.ajax({
	    url: 'update_events.php',
	    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
	    type: "POST",
	    success: function(json) {
	     alert("Updated Successfully");
	    }
	   });
	}
   
  });
  
 });

</script>
<style>
 body {
  margin-top: 40px;
  text-align: center;
  font-size: 14px;
  font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
  }
 #calendar {
  width: 850px;
  margin: 0 auto;
  }
</style>
</head>
<body>
 
 <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
         <div class="navbar-header">
          <a href="#"><img src="img/title.png"></img></a>
         </div>
           <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="calendar.php">Home</a></li>
                <li><a href="inputtime.php">Schedule</a></li>
                <li><a href="ta-list.php">Notify</a></li>
                <li style="float:right"> <a href="logout.php">Logout</a></li>
               </ul>     
           </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
 </nav>

 <div id='calendar'></div>
</body>
</html>