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

class WitnessCaseHearingsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Witness $witness;
    public CaseHearing $caseHearing;
    public $attorneysForSelect = [];
    public $courtsForSelect = [];
    public $modsForSelect = [];
    public $judgesForSelect = [];
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
        'caseHearing.mod_id' => ['required', 'exists:mods,id'],
        'caseHearing.judge_id' => ['required', 'exists:judges,id'],
    ];

    public function mount(Witness $witness): void
    {
        $this->witness = $witness;
        $this->attorneysForSelect = Attorney::pluck('courtID', 'id');
        $this->courtsForSelect = Court::pluck('name', 'id');
        $this->modsForSelect = Mod::pluck('name', 'id');
        $this->judgesForSelect = Judge::pluck('name', 'id');
        $this->resetCaseHearingData();
    }

    public function resetCaseHearingData(): void
    {
        $this->caseHearing = new CaseHearing();

        $this->caseHearingCaseStartDate = null;
        $this->caseHearing->attorney_id = null;
        $this->caseHearing->court_id = null;
        $this->caseHearing->mod_id = null;
        $this->caseHearing->judge_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCaseHearing(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.witness_case_hearings.new_title');
        $this->resetCaseHearingData();

        $this->showModal();
    }

    public function editCaseHearing(CaseHearing $caseHearing): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.witness_case_hearings.edit_title');
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

        if (!$this->caseHearing->witness_id) {
            $this->authorize('create', CaseHearing::class);

            $this->caseHearing->witness_id = $this->witness->id;
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

        foreach ($this->witness->caseHearings as $caseHearing) {
            array_push($this->selected, $caseHearing->id);
        }
    }

    public function render(): View
    {
        return view('livewire.witness-case-hearings-detail', [
            'caseHearings' => $this->witness->caseHearings()->paginate(20),
        ]);
    }
}
