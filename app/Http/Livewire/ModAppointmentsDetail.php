<?php

namespace App\Http\Livewire;

use App\Models\Mod;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Appointment;
use App\Models\CaseHearing;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ModAppointmentsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Mod $mod;
    public Appointment $appointment;
    public $caseHearingsForSelect = [];
    public $appointmentAppointmentDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Appointment';

    protected $rules = [
        'appointment.caseHearID' => ['required', 'max:255', 'string'],
        'appointment.empID' => ['required', 'max:255', 'string'],
        'appointment.modID' => ['required', 'max:255', 'string'],
        'appointment.fullname' => ['required', 'max:255', 'string'],
        'appointment.chargeType' => ['required', 'max:255', 'string'],
        'appointmentAppointmentDate' => ['required', 'date'],
        'appointment.description' => ['required', 'max:255', 'string'],
        'appointment.case_hearing_id' => [
            'required',
            'exists:case_hearings,id',
        ],
    ];

    public function mount(Mod $mod): void
    {
        $this->mod = $mod;
        $this->caseHearingsForSelect = CaseHearing::pluck(
            'casehearingID',
            'id'
        );
        $this->resetAppointmentData();
    }

    public function resetAppointmentData(): void
    {
        $this->appointment = new Appointment();

        $this->appointmentAppointmentDate = null;
        $this->appointment->case_hearing_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAppointment(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.mod_appointments.new_title');
        $this->resetAppointmentData();

        $this->showModal();
    }

    public function editAppointment(Appointment $appointment): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.mod_appointments.edit_title');
        $this->appointment = $appointment;

        $this->appointmentAppointmentDate = optional(
            $this->appointment->appointmentDate
        )->format('Y-m-d');

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->appointment->mod_id) {
            $this->authorize('create', Appointment::class);

            $this->appointment->mod_id = $this->mod->id;
        } else {
            $this->authorize('update', $this->appointment);
        }

        $this->appointment->appointmentDate = \Carbon\Carbon::make(
            $this->appointmentAppointmentDate
        );

        $this->appointment->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Appointment::class);

        Appointment::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAppointmentData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->mod->appointments as $appointment) {
            array_push($this->selected, $appointment->id);
        }
    }

    public function render(): View
    {
        return view('livewire.mod-appointments-detail', [
            'appointments' => $this->mod->appointments()->paginate(20),
        ]);
    }
}
