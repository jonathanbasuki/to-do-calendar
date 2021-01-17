<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>To Do: Calendar</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.css">

	<!-- Full Calendar CSS -->
	<link rel="stylesheet" href="assets/css/full-calendar.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card text-center">
				  <div class="card-header fs-1 bg-primary text-light py-3">
				    Calendar Schedule <?= date('Y'); ?> 
				  </div>
				  <div class="card-body">
				    <div id="calendar">
				    	
				    </div>
				  </div>
				  <div class="card-footer text-muted">
				    &copy; <?= date('Y'); ?>, Jonathan Basuki.
				  </div>
				</div>
			</div>
		</div>
	</div>

	<!-- Script -->
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/jquery-ui.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/full-calendar.min.js"></script>
	<script>
		$(document).ready(function() {
			var calendar = $('#calendar').fullCalendar({
				editable: true,
				header: {
					left: 'prev, next today',
					center: 'title',
					right: 'agendaDay, agendaWeek, month'
				},
				events: 'view.php',
				selectable: true,
				selectHelper: true,
				// Add event
				select: function(start, end, allDay) {
					var title = prompt('Add title');

					if (title) {
						var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:MM:SS');
						var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:MM:SS');

						$.ajax({
							url: 'save.php',
							type: 'POST',
							data: {
								title: title,
								start: start,
								end: end
							},
							success: function() {
								calendar.fullCalendar('refetchEvents');
								alert('Event saved!');
							}
						});
					}
				},
				// Edit event
				eventDrop: function(event) {
					var id = event.id;
					var title = event.title;
					var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:MM:SS');
					var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:MM:SS');

					$.ajax({
						url: 'edit.php',
						type: 'POST',
						data: {
							id: id,
							title: title,
							start: start,
							end: end
						},
						success: function() {
							calendar.fullCalendar('refetchEvents');
							alert('Event changed!');
						}
					});
				},
				// Delete event
				eventClick: function(event) {
					if (confirm("Are you sure want to delete this event?")) {
						var id = event.id;

						$.ajax({
							url: 'delete.php',
							type: 'POST',
							data: {
								id: id
							},
							success: function() {
								calendar.fullCalendar('refetchEvents');
								alert('Event deleted!');
							}
						});
					}
				}
			});
		});
	</script>
</body>
</html>