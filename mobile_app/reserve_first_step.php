<?php
include "../controllers/include_partial_functions.php";
include "../controllers/check_login.php";
include "../controllers/bookings_functions.php";
include "../database/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php get_headBlade_mobile(); ?>
   <style>
       <style>
        table.calendar		{ border-left:1px solid #999; }
        tr.calendar-row	{  }
        td.calendar-day	{ min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
        td.calendar-day:hover	{ background:#eceff5; }
        td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
        td.calendar-day-head {background: #85b4d0;font-weight:bold;text-align:center;width:80px;padding:1.5px;border-bottom:1px solid #999;border-top:1px solid #999;border-right:1px solid #999;color: white;}
        div.day-number		{background: #85b4d0;padding: 1px;color:#fff;font-weight:bold;float:right;margin: -5px -5px 0 0;width:20px;text-align:center;}
        /* shared */
        td.calendar-day, td.calendar-day-np { width:80px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="top-left-part">
                    <a class="logo" alt="logo">
                        <b><img src="../resources/images/logo.png"/></b>
                        <small class="hidden-xs"><b>request</b></small>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>                    
                        <?php getHeaderUserName_mobile(); ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
       <?php 
        get_NavBlade_mobile();
       ?>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Scheduling</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li class="active">Scheduling</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div id='wrap'>
                            <div id='calendar'></div>
                            <div style='clear:both'></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <?php $category = "Facilities"; getReservationForm($conn, $category) ?>
                            <button class="btn btn-danger" onclick = "hideCalendar()">Choose Again</button>                                                            
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <h3 class="box-title"></h3>
                    <div class="col-md-2 col-sm-4 col-xs-12 pull-right">
                        
                    </div>
                </div>                

                <div class="row" id="table_list">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">My Reservation List</h3>
                            <div class="col-md-2 col-sm-4 col-xs-12 pull-right"> </div>
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Reserved Automobile / Facility</th>
                                            <th>Reservation Date Start</th>
                                            <th>Reservation Date End</th>
                                            <th>Reservation Status</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            getUsersReservationData_mobile($conn);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div id="facility_calendar" style="display:none">
                        <div class="col-md-6">                            
                        <?php //echo getFacilityCalendar($conn, date("m"), date("Y")); ?>
                        </div>
                        <div class="col-md-6">
                            <div class="white-box">
                                <?php //$category = "Facilities"; getReservationForm($conn, $category) ?>
                                <button class="btn btn-danger" onclick = "hideCalendar()">Choose Again</button>                                                            
                            </div>
                        </div>
                    </div>
                    <div id="automobile_calendar" style="display:none">
                        <div class="col-md-6">                            
                            <?php //echo getAutomobileCalendar($conn, date("m"), date("Y")); ?>
                        </div>
                        <div class="col-md-6">
                            <div class="white-box">
                                <?php //$category = "Automobile"; getReservationForm($conn, $category) ?>
                                <button class="btn btn-danger" onclick = "hideCalendar()">Choose Again</button>                                
                            </div>
                        </div>
                    </div>                                      
                </div> -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
  <?php 
    get_JSBlade_mobile();
  ?>
  <!-- <script>
      function showCalendar(category){
        document.getElementById("choose_buttons").style.display = "none";
          if(category == "Facilities"){
            document.getElementById("facility_calendar").style.display = "block";
            document.getElementById("table_list").style.display = "none";
          }else{
            document.getElementById("automobile_calendar").style.display = "block";
            document.getElementById("table_list").style.display = "none";
          }
      }

      function hideCalendar(){
        document.getElementById("table_list").style.display = "block";
        document.getElementById("choose_buttons").style.display = "block";
        document.getElementById("facility_calendar").style.display = "none";
        document.getElementById("automobile_calendar").style.display = "none";
      }
      </script> -->

<script src='../resources/js/jquery-1.10.2.js' type="text/javascript"></script>
<script src='../resources/js/jquery-ui.custom.min.js' type="text/javascript"></script>
<script src='../resources/js/fullcalendar.js' type="text/javascript"></script>
<script>

	$(document).ready(function() {
	    var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		/*  className colors

		className: default(transparent), important(red), chill(pink), success(green), info(blue)

		*/


		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		var calendar =  $('#calendar').fullCalendar({
			header: {
				left: 'title',
				center: 'agendaDay,agendaWeek,month',
				right: 'prev,next today'
			},
			editable: false,
			firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			selectable: false,
			defaultView: 'month',

			axisFormat: 'h:mm',
			columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
			allDaySlot: false,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');

				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;

				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}

			},

			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false,
					className: 'info'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false,
					className: 'info'
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false,
					className: 'important'
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
					className: 'important'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false,
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/',
					className: 'success'
				}
			],
		});


	});

</script>
</body>

</html>
