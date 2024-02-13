<?php

namespace App\Http\Livewire;

use App\Models\Mod;
use Livewire\Component;
use App\Models\Decision;
use Illuminate\View\View;
use App\Models\CaseHearing;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ModDecisionsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Mod $mod;
    public Decision $decision;
    public $caseHearingsForSelect = [];
    public $decisionCaseStartDate;
    public $decisionDecisionDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Decision';

    protected $rules = [
        'decision.caseHearingID' => ['required', 'max:255', 'string'],
        'decision.modID' => ['required', 'max:255', 'string'],
        'decision.empID' => ['required', 'max:255', 'string'],
        'decision.name' => ['required', 'max:255', 'string'],
        'decision.chargeType' => ['required', 'max:255', 'string'],
        'decisionCaseStartDate' => ['required', 'date'],
        'decisionDecisionDate' => ['required', 'date'],
        'decision.decisionType' => ['required', 'max:255', 'string'],
        'decision.description' => ['required', 'max:255', 'string'],
        'decision.case_hearing_id' => ['required', 'exists:case_hearings,id'],
    ];

    public function mount(Mod $mod): void
    {
        $this->mod = $mod;
        $this->caseHearingsForSelect = CaseHearing::pluck(
            'casehearingID',
            'id'
        );
        $this->resetDecisionData();
    }

    public function resetDecisionData(): void
    {
        $this->decision = new Decision();

        $this->decisionCaseStartDate = null;
        $this->decisionDecisionDate = null;
        $this->decision->case_hearing_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newDecision(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.mod_decisions.new_title');
        $this->resetDecisionData();

        $this->showModal();
    }

    public function editDecision(Decision $decision): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.mod_decisions.edit_title');
        $this->decision = $decision;

        $this->decisionCaseStartDate = optional(
            $this->decision->caseStartDate
        )->format('Y-m-d');
        $this->decisionDecisionDate = optional(
            $this->decision->decisionDate
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

        if (!$this->decision->mod_id) {
            $this->authorize('create', Decision::class);

            $this->decision->mod_id = $this->mod->id;
        } else {
            $this->authorize('update', $this->decision);
        }

        $this->decision->caseStartDate = \Carbon\Carbon::make(
            $this->decisionCaseStartDate
        );
        $this->decision->decisionDate = \Carbon\Carbon::make(
            $this->decisionDecisionDate
        );

        $this->decision->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Decision::class);

        Decision::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetDecisionData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->mod->decisions as $decision) {
            array_push($this->selected, $decision->id);
        }
    }

    public function render(): View
    {
        return view('livewire.mod-decisions-detail', [
            'decisions' => $this->mod->decisions()->paginate(20),
        ]);
    }
}
