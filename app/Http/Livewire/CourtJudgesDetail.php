<?php

namespace App\Http\Livewire;

use App\Models\Court;
use App\Models\Judge;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourtJudgesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Court $court;
    public Judge $judge;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Judge';

    protected $rules = [
        'judge.CourtID' => ['required', 'max:255', 'string'],
        'judge.judgeID' => ['required', 'max:255', 'string'],
        'judge.name' => ['required', 'max:255', 'string'],
        'judge.courtType' => ['required', 'max:255', 'string'],
        'judge.address' => ['required', 'max:255', 'string'],
        'judge.state' => ['required', 'max:255', 'string'],
        'judge.empType' => ['required', 'max:255', 'string'],
        'judge.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(Court $court): void
    {
        $this->court = $court;
        $this->resetJudgeData();
    }

    public function resetJudgeData(): void
    {
        $this->judge = new Judge();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newJudge(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.court_judges.new_title');
        $this->resetJudgeData();

        $this->showModal();
    }

    public function editJudge(Judge $judge): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.court_judges.edit_title');
        $this->judge = $judge;

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

        if (!$this->judge->court_id) {
            $this->authorize('create', Judge::class);

            $this->judge->court_id = $this->court->id;
        } else {
            $this->authorize('update', $this->judge);
        }

        $this->judge->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Judge::class);

        Judge::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetJudgeData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->court->judges as $judge) {
            array_push($this->selected, $judge->id);
        }
    }

    public function render(): View
    {
        return view('livewire.court-judges-detail', [
            'judges' => $this->court->judges()->paginate(20),
        ]);
    }
}
