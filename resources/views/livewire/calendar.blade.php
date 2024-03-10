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
                    console.log(data);
                    // Open Modal
                    @this.set('openModal', true);
                    // Dates
                    @this.set('startDate', data.start.toISOString());
                    @this.set('endDate', data.end.toISOString());
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

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            {{ __('Schedule Appointment') }}
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label class="mb-1">
                    {{ __('Name') }}
                </x-label>
                <x-input wire:model="name" class="w-full" autofocus required />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$set('openModal', false)">
                {{ __('Cancel') }}
            </x-danger-button>
            <x-button class="ml-2" wire:click="newAppointment()">
                {{ __('Schedule') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
