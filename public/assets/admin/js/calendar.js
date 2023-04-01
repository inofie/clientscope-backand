var user_id=[];

function addAppointmentsToCalendar(events){
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        right: 'prevYear,prev,next,nextYear today',
        center: 'title',
        left: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      eventClick: function(info) {
       editAppointment(info);
      },
      eventDidMount: function(info) {
        console.log('info',info.event.extendedProps);
        var tooltip = new Tooltip(info.el, {
          title: info.event.extendedProps.description,
          placement: 'top',
          trigger: 'hover',
          container: 'body'
        });
      },
      events: events
    });  
    calendar.render();
}

function generateCalendarEventsByAppointmentsData(appointments){
  return appointments.map(appointment => {
      return {
          'id': appointment.id,
          'title':appointment.title,
          'description': appointment.user_pin.house_address,
          'start': new Date(appointment.start_datetime),
          'end': new Date(appointment.end_datetime)
      }
  });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#status-icon').attr('src', e.target.result); //where to show recently chosen image
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

function editAppointment(appointmentInfo){
    let element = "#editAppointment";
    ajax_request(base_url+'/admin/edit-appointment', 'GET', { "appointment_id": appointmentInfo.event.id }).then(function(res) {
        $('#edit_appointment_modal').html(res.html);
        $(element).modal('show');
    }).catch(function(err){
        console.error(err);
    });
}

$('body').on('click', '#selectAllEmployees', function () {
   user_id = [];
   if ($(this).hasClass('allChecked')) {
      $('input[type="checkbox"].selectEmployee').prop('checked', false);
      user_id = [];
   } else {
      $('input[type="checkbox"].selectEmployee').prop('checked', true);
      $("input:checkbox[name='company_users[]']:checked").each(function(){
         user_id.push($(this).val());
      });
   }
   $(this).toggleClass('allChecked');

   ajax_request(base_url+'/api/appointment', 'GET', {"user_id": user_id.toString() }).then(function(res) {
      if(res.code == 200){
        events = generateCalendarEventsByAppointmentsData(res.data);
            addAppointmentsToCalendar(events);
      }
  });
});

$(document).ready(function(){

  $('#calendar-filter').click(function(){
    
        if( $('.filters').hasClass('d-none') ){
               $('.filters').removeClass('d-none');
               $('.calender-grid').removeClass('col-md-12').addClass('col-md-9');
        } else {
               $('.filters').addClass('d-none');
               $('.calender-grid').removeClass('col-md-9').addClass('col-md-12');
        }
        if( events != null && events != '' ){
            addAppointmentsToCalendar(JSON.parse(events));
        }

     })
})

$('body').on('click', '.selectEmployee', function () {
   if($(this).prop("checked") == true) {
      user_id.push($(this).val());
   }
   else if($(this).prop("checked") == false) {
      var idx = $.inArray($(this).val(), user_id);
      user_id.splice(idx, 1);
   }
  
   ajax_request(base_url+'/api/appointment', 'GET', {"user_id": user_id.toString() }).then(function(res) {
      if(res.code == 200){
        events = generateCalendarEventsByAppointmentsData(res.data);
            addAppointmentsToCalendar(events);
      }
  });
});

$('body').on('change', '#selectEmplyeeUser', function () {
   user_id = [];
   user_id.push($(this).val());

   ajax_request(base_url+'/api/appointment', 'GET', {"user_id": user_id.toString() }).then(function(res) {
      if(res.code == 200){
        events = generateCalendarEventsByAppointmentsData(res.data);
            addAppointmentsToCalendar(events);
      }
  });
});

$('body').on('click','.delete_appointment',function(e){
    e.preventDefault();
    var element = $(this);
    var msg = confirm('Are you sure you want to continue');
    if( msg ){
        var record_id = element.attr('id');
        ajax_request(base_url + '/api/appointment/' + record_id,'DELETE',{}).then( function(res){
            alert(res.message)
            location.reload(true);
        })
    } else {
        return false
    }
})
