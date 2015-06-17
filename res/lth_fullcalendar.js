$(document).ready(function() { 
    $("#eventStartDate").datepicker( {dateFormat : 'yy-mm-dd'});
    $("#eventEndDate").datepicker({dateFormat : 'yy-mm-dd'});
    //$("input.eventStartTime").timepicki({});
    //$("input.eventEndTime").timepicki({});
    
    $myCalendar = $('#lthFullCalendar').fullCalendar({
            header: {
                    left : 'prev,next today',
                    center : 'title',
                    right : 'month,agendaWeek,agendaDay'
            },
            timezone : 'Europe/Stockholm',
            editable : true,
            events : "index.php?eID=lth_fullcalendar&action=listEvents&sid="+Math.random(),
            timeFormat : 'H(:mm)',
            selectable : true,
            selectHelper : true,
            select: function(start, end) {
                var d = new Date();
                $('#eventStartDate').datepicker("setDate", new Date(start));
                $('#eventEndDate').datepicker("setDate", new Date(start));
                $('.eventStartTime').val(d.getHours() + ' : ' + d.getMinutes()).timepicki({show_meridian:false,min_hour_value:0,
		max_hour_value:23,
		overflow_minutes:true,
		increase_direction:'up'});
                $('.eventEndTime').val(d.getHours() + ' : ' + d.getMinutes()).timepicki({show_meridian:false,min_hour_value:0,
		max_hour_value:23,
		overflow_minutes:true,
		increase_direction:'up'});
                $('#calEventDialog #eventTitle').val('');
                $('#calEventDialog #eventPlace').val('');
                $('#calEventDialog #description').val('');
                $('#calEventDialog').dialog('open');
            },
            eventClick: function(calEvent, jsEvent, view) {
                //console.log(calEvent.uid);
                $.ajax({
                    url: 'index.php',
                    data: {
                        eID : 'lth_fullcalendar',
                        action : 'getEvent',
                        uid : calEvent.uid,
                        sid : Math.random()
                    },
                    type: "POST",
                    success: function(json) {
                        json = JSON.parse(json);
                        var ds = new Date(json.start);
                        var de = new Date(json.end);
                        $('#eventStartDate').datepicker("setDate", ds);
                        $('#eventEndDate').datepicker("setDate", de);
                        $('.eventStartTime').val(ds.getHours() + ' : ' + ds.getMinutes()).timepicki({"start_time":[ds.getHours(),ds.getMinutes()] ,show_meridian:false,min_hour_value:0,
                            max_hour_value:23,
                            overflow_minutes:true,
                            increase_direction:'up'});
                                    $('.eventEndTime').val(de.getHours() + ' : ' + de.getMinutes()).timepicki({"start_time": [de.getHours(),de.getMinutes()],show_meridian:false,min_hour_value:0,
                            max_hour_value:23,
                            overflow_minutes:true,
                            increase_direction:'up'});
                        $('#calEventDialog #eventTitle').val(json.title);
                        $('#calEventDialog #eventPlace').val(json.place);
                        $('#calEventDialog #eventDescription').val(json.description);
                        $('#calEventDialog #eventUid').val(json.uid);
                        $('#calEventDialog').dialog('open');
                    }
                });
            },
            eventResize: function(event, delta, revertFunc) {

                alert(event.title + " end is now " + event.end.format());

                if (!confirm("is this okay?")) {
                    revertFunc();
                }

            },
            eventLimit : true, // allow "more" link when too many events
    });
    
    
    
    var eventClass, color;
    $('#calEventDialog').dialog({
        resizable: false,
        autoOpen: false,
        title: 'Add Event',
        width: 400,
        buttons: {
            Save: function() {
                var title = $('#eventTitle');
                var startDate = $('#eventStartDate');
                var endDate = $('#eventEndDate');
                var startTime = $('#eventStartTime');
                var endTime = $('#eventEndTime');
                var allday = $('#allday');
                var description = $('#eventDescription');
                var place = $('#eventPlace');
                var uid = $('#eventUid');
                var action = 'addEvent';
                
                if(uid.val()) {
                    action = 'updateEvent';
                }

               /* if ($('input:radio[name=allday]:checked').val() == "1") {
                    eventClass = "gbcs-halfday-event";
                    color = "#9E6320";
                    end.val(start.val());
                }
                else {
                    eventClass = "gbcs-allday-event";
                    color = "#875DA8";
                }*/
                if (title.val() !== '') {
                    $.ajax({
                        url: 'index.php',
                        data: {
                            eID : 'lth_fullcalendar',
                            action : action,
                            title : title.val(),
                            startDate : startDate.val(),
                            endDate : endDate.val(),
                            startTime : startTime.val(),
                            endTime : endTime.val(),
                            allday : allday.val(),
                            description : description.val(),
                            place : place.val(),
                            uid : uid.val(),
                            sid : Math.random(),
                        },
                        type: "POST",
                        success: function(json) {
                            //console.log(startDate.val() + 'T' + startTime.val().replace(/ /gi,''));
                            $myCalendar.fullCalendar( 'refetchEvents' );
                        }
                    });
                }
                $myCalendar.fullCalendar('unselect');
                $(this).dialog('close');
            },
            Cancel: function() {
                $(this).dialog('close');
            },
            Delete: function() {
                if(confirm('Are you sure?')) {
                    var uid = $('#eventUid');
                    $.ajax({
                        url: 'index.php',
                        data: {
                            eID : 'lth_fullcalendar',
                            action : 'deleteEvent',
                            uid : uid.val(),
                            sid : Math.random(),
                        },
                        type: "POST",
                        success: function(json) {
                            //console.log(startDate.val() + 'T' + startTime.val().replace(/ /gi,''));
                            $myCalendar.fullCalendar( 'refetchEvents' );
                        }
                    });
                    $(this).dialog('close');
                } else {
                    return false;
                }
            }
        }
    });

});
/*
 * eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
 *  $(document).ready(function() {
    $('#datepicker').datepicker({
        inline: true,
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);
            $('#calendar').fullCalendar('gotoDate', d);
        }
    }); 
}

 *  select: function(start, end, allDay) {
            var title = prompt('Event Title:');
            var url = prompt('Type Event url, if exits:');
            if (title) {
                //var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
                //var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
                var start = moment(start).format('YYYY-MM-DDTHH:mm:ssZ'); 
                var end = moment(end).format('YYYY-MM-DDTHH:mm:ssZ'); 
                $.ajax({
                    url: 'index.php',
                    data: 'eID=lth_fullcalendar&title='+ title+'&start='+ start +'&end='+ end +'&url='+ url+'&action=addEvent&sid='+Math.random(),
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
                true // make the event "stick"
                );
            }
            calendar.fullCalendar('unselect');
        },

        editable: true,
        eventDrop: function(event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
            $.ajax({
                url: 'index.php',
                data: 'eID=lth_fullcalendar&title='+ event.title+'&start='+ start +'&end='+ end +'&uid='+ event.id + '&action=updateEvent&sid='+Math.random(),
                type: "POST",
                success: function(json) {
                    alert("Updated Successfully");
                }
            });
        },
        eventResize: function(event) {
        var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
        $.ajax({
            url: 'index.php',
            data: 'eID=lth_fullcalendar&title=title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id + '&action=updateevent&sid='+Math.random(),
            type: "POST",
            success: function(json) {
                alert("Updated Successfully");
            }
        });
 */