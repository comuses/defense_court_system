<?php

namespace App\Http\Livewire;

use App\Models\Mod;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\ModEmployee;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ModModEmployeesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Mod $mod;
    public ModEmployee $modEmployee;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ModEmployee';

    protected $rules = [
        'modEmployee.modID' => ['required', 'max:255', 'string'],
        'modEmployee.EmpID' => ['required', 'max:255', 'string'],
        'modEmployee.rank' => ['required', 'max:255', 'string'],
        'modEmployee.fullName' => ['required', 'max:255', 'string'],
        'modEmployee.address' => ['required', 'max:255', 'string'],
        'modEmployee.state' => ['required', 'max:255', 'string'],
        'modEmployee.empType' => ['required', 'max:255', 'string'],
    ];

    public function mount(Mod $mod): void
    {
        $this->mod = $mod;
        $this->resetModEmployeeData();
    }

    public function resetModEmployeeData(): void
    {
        $this->modEmployee = new ModEmployee();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newModEmployee(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.mod_mod_employees.new_title');
        $this->resetModEmployeeData();

        $this->showModal();
    }

    public function editModEmployee(ModEmployee $modEmployee): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.mod_mod_employees.edit_title');
        $this->modEmployee = $modEmployee;

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

        if (!$this->modEmployee->mod_id) {
            $this->authorize('create', ModEmployee::class);

            $this->modEmployee->mod_id = $this->mod->id;
        } else {
            $this->authorize('update', $this->modEmployee);
        }

        $this->modEmployee->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', ModEmployee::class);

        ModEmployee::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetModEmployeeData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->mod->modEmployees as $modEmployee) {
            array_push($this->selected, $modEmployee->id);
        }
    }

    public function render(): View
    {
        return view('livewire.mod-mod-employees-detail', [
            'modEmployees' => $this->mod->modEmployees()->paginate(20),
        ]);
    }
}
