<?php

namespace App\Livewire;

use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Carbon\Carbon;

class Calendar extends Component
{
    public $openModal = false;
    public $name;
    public $startDate = '';
    public $endDate = '';

    public function newAppointment()
    {
        $validated = Validator::make(
            [
                'name' => $this->name,
                'start_time' => $this->startDate,
                'end_time' => $this->endDate,
            ],
            [
                'name' => 'required|min:1|max:40',
                'start_time' => 'required',
                'end_time' => 'required',
            ]
        )->validate();

        $validated['start_time'] = Carbon::parse($validated['start_time'])->toDateTimeString();
        $validated['end_time'] = Carbon::parse($validated['end_time'])->toDateTimeString();

        $appointment = Appointment::create(
            $validated
        );

        $this->reset(['openModal', 'name', 'startDate', 'endDate']);

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Well done!',
            'text' => 'The event has been registered successfully.',
        ]);
    }

    public function updateAppointment($id, $name, $startDate, $endDate)
    {
        $validated = Validator::make(
            [
                'start_time' => $startDate,
                'end_time' => $endDate,
            ],
            [
                'start_time' => 'required',
                'end_time' => 'required',
            ]
        )->validate();

        $validated['start_time'] = Carbon::parse($validated['start_time'])->toDateTimeString();
        $validated['end_time'] = Carbon::parse($validated['end_time'])->toDateTimeString();

        Appointment::findOrFail($id)->update($validated);
    }

    public function render()
    {
        $appointments = [];

        foreach (Appointment::all() as $appointment) {
            $start = Carbon::parse($appointment->start_time);
            $end = Carbon::parse($appointment->end_time);

            $appointments[] = [
                'id' => $appointment->id,
                'title' => $appointment->name,
                'start' => $start->toIso8601String(),
                'end' => $end->toIso8601String(),
            ];
        }

        return view('livewire.calendar', [
            'appointments' => $appointments
        ]);
    }
}
