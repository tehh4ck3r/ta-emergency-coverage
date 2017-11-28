$(document).ready(function() {
	var calendar = $('#calendar').fullCalendar({
		editable: false,
		
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},

		events: "events.php"
	});
});