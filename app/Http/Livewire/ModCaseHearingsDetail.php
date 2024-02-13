<?php

namespace App\Http\Livewire;

use App\Models\Mod;
use App\Models\Court;
use App\Models\Judge;
use Livewire\Component;
use App\Models\Witness;
use App\Models\Attorney;
use Illuminate\View\View;
use App\Models\CaseHearing;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ModCaseHearingsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Mod $mod;
    public CaseHearing $caseHearing;
    public $attorneysForSelect = [];
    public $courtsForSelect = [];
    public $judgesForSelect = [];
    public $witnessesForSelect = [];
    public $caseHearingCaseStartDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New CaseHearing';

    protected $rules = [
        'caseHearing.casehearingID' => ['required', 'max:255', 'string'],
        'caseHearing.modID' => ['required', 'max:255', 'string'],
        'caseHearing.courtID' => ['required', 'max:255', 'string'],
        'caseHearing.judgeID' => ['required', 'max:255', 'string'],
        'caseHearing.attorneyID' => ['required', 'max:255', 'string'],
        'caseHearing.attoneryWitnessID' => ['required', 'max:255', 'string'],
        'caseHearing.accusedWitnessID' => ['required', 'max:255', 'string'],
        'caseHearing.chilotname' => ['required', 'max:255', 'string'],
        'caseHearing.accEmpID' => ['required', 'max:255', 'string'],
        'caseHearing.fileNumber' => ['required', 'max:255', 'string'],
        'caseHearingCaseStartDate' => ['required', 'date'],
        'caseHearing.address' => ['required', 'max:255', 'string'],
        'caseHearing.state' => ['required', 'max:255', 'string'],
        'caseHearing.location' => ['required', 'max:255', 'string'],
        'caseHearing.description' => ['required', 'max:255', 'string'],
        'caseHearing.attorney_id' => ['required', 'exists:attorneys,id'],
        'caseHearing.court_id' => ['required', 'exists:courts,id'],
        'caseHearing.judge_id' => ['required', 'exists:judges,id'],
        'caseHearing.witness_id' => ['required', 'exists:witnesses,id'],
    ];

    public function mount(Mod $mod): void
    {
        $this->mod = $mod;
        $this->attorneysForSelect = Attorney::pluck('courtID', 'id');
        $this->courtsForSelect = Court::pluck('name', 'id');
        $this->judgesForSelect = Judge::pluck('name', 'id');
        $this->witnessesForSelect = Witness::pluck('name', 'id');
        $this->resetCaseHearingData();
    }

    public function resetCaseHearingData(): void
    {
        $this->caseHearing = new CaseHearing();

        $this->caseHearingCaseStartDate = null;
        $this->caseHearing->attorney_id = null;
        $this->caseHearing->court_id = null;
        $this->caseHearing->judge_id = null;
        $this->caseHearing->witness_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCaseHearing(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.mod_case_hearings.new_title');
        $this->resetCaseHearingData();

        $this->showModal();
    }

    public function editCaseHearing(CaseHearing $caseHearing): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.mod_case_hearings.edit_title');
        $this->caseHearing = $caseHearing;

        $this->caseHearingCaseStartDate = optional(
            $this->caseHearing->caseStartDate
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

        if (!$this->caseHearing->mod_id) {
            $this->authorize('create', CaseHearing::class);

            $this->caseHearing->mod_id = $this->mod->id;
        } else {
            $this->authorize('update', $this->caseHearing);
        }

        $this->caseHearing->caseStartDate = \Carbon\Carbon::make(
            $this->caseHearingCaseStartDate
        );

        $this->caseHearing->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', CaseHearing::class);

        CaseHearing::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCaseHearingData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->mod->caseHearings as $caseHearing) {
            array_push($this->selected, $caseHearing->id);
        }
    }

    public function render(): View
    {
        return view('livewire.mod-case-hearings-detail', [
            'caseHearings' => $this->mod->caseHearings()->paginate(20),
        ]);
    }
}
