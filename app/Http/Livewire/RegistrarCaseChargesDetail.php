<?php

namespace App\Http\Livewire;

use App\Models\Mod;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Registrar;
use App\Models\CaseCharge;
use App\Models\ModEmployee;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegistrarCaseChargesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Registrar $registrar;
    public CaseCharge $caseCharge;
    public $modsForSelect = [];
    public $modEmployeesForSelect = [];
    public $caseChargeCrimeDate;
    public $caseChargeChargeDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New CaseCharge';

    protected $rules = [
        'caseCharge.modID' => ['required', 'max:255', 'string'],
        'caseCharge.MIDnumber' => ['required', 'max:255', 'string'],
        'caseCharge.rank' => ['required', 'max:255', 'string'],
        'caseCharge.fullName' => ['required', 'max:255', 'string'],
        'caseCharge.address' => ['required', 'max:255', 'string'],
        'caseCharge.state' => ['required', 'max:255', 'string'],
        'caseCharge.crimeType' => ['required', 'max:255', 'string'],
        'caseChargeCrimeDate' => ['required', 'date'],
        'caseChargeChargeDate' => ['required', 'date'],
        'caseCharge.mod_id' => ['required', 'exists:mods,id'],
        'caseCharge.mod_employee_id' => ['required', 'exists:mod_employees,id'],
    ];

    public function mount(Registrar $registrar): void
    {
        $this->registrar = $registrar;
        $this->modsForSelect = Mod::pluck('name', 'id');
        $this->modEmployeesForSelect = ModEmployee::pluck('modID', 'id');
        $this->resetCaseChargeData();
    }

    public function resetCaseChargeData(): void
    {
        $this->caseCharge = new CaseCharge();

        $this->caseChargeCrimeDate = null;
        $this->caseChargeChargeDate = null;
        $this->caseCharge->mod_id = null;
        $this->caseCharge->mod_employee_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCaseCharge(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.registrar_case_charges.new_title');
        $this->resetCaseChargeData();

        $this->showModal();
    }

    public function editCaseCharge(CaseCharge $caseCharge): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.registrar_case_charges.edit_title');
        $this->caseCharge = $caseCharge;

        $this->caseChargeCrimeDate = optional(
            $this->caseCharge->crimeDate
        )->format('Y-m-d');
        $this->caseChargeChargeDate = optional(
            $this->caseCharge->chargeDate
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

        if (!$this->caseCharge->registrar_id) {
            $this->authorize('create', CaseCharge::class);

            $this->caseCharge->registrar_id = $this->registrar->id;
        } else {
            $this->authorize('update', $this->caseCharge);
        }

        $this->caseCharge->crimeDate = \Carbon\Carbon::make(
            $this->caseChargeCrimeDate
        );
        $this->caseCharge->chargeDate = \Carbon\Carbon::make(
            $this->caseChargeChargeDate
        );

        $this->caseCharge->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', CaseCharge::class);

        CaseCharge::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCaseChargeData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->registrar->caseCharges as $caseCharge) {
            array_push($this->selected, $caseCharge->id);
        }
    }

    public function render(): View
    {
        return view('livewire.registrar-case-charges-detail', [
            'caseCharges' => $this->registrar->caseCharges()->paginate(20),
        ]);
    }
}
