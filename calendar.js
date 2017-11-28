	/* calendar.js: renders the calendar used in calendar.php. 
	 * 
	 * Uses the FullCalendar JS library.
	 */
$(document).ready(function() {
	var calendar = $('#calendar').fullCalendar({
		// calendar may not be edited
		editable: false,
		
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},

		// events.php serves events for the calendar
		events: "events.php"
	});
});