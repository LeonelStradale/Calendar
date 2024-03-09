<div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <div wire:ignore id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                titleFormat: {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                },
                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                timeZone: 'America/Mexico_City',
                editable: true,
                selectable: true,
                navLinks: true,
                nowIndicator: true,
                // Event Display
                events: @json($appointments),
                eventDisplay: 'block',
                eventBorderColor: '#fff',
                eventTextColor: '#fff',
                eventBackgroundColor: '#1a252f',
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                select: function(data) {
                    var event_name = prompt('Event Name:');
                    if (!event_name) {
                        return;
                    }
                    // Create New Appointment
                    @this.newAppointment(event_name, data.start.toISOString(), data.end.toISOString())
                        .then(
                            function(id) {
                                calendar.addEvent({
                                    id: id,
                                    title: event_name,
                                    start: data.startStr,
                                    end: data.endStr,
                                });
                                calendar.unselect();
                            });
                },
                eventDrop: function(data) {
                    console.log(data.event.id)
                    // Update Appointment
                    @this.updateAppointment(
                        data.event.id,
                        data.event.name,
                        data.event.start.toISOString(),
                        data.event.end.toISOString()).then(function() {
                        alert('moved event');
                    })
                },
            });
            calendar.render();
        });
    </script>

</div>
