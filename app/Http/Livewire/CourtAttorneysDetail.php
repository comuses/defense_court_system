<?php

namespace App\Http\Livewire;

use App\Models\Court;
use Livewire\Component;
use App\Models\Attorney;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourtAttorneysDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Court $court;
    public Attorney $attorney;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Attorney';

    protected $rules = [
        'attorney.courtID' => ['required', 'max:255', 'string'],
        'attorney.attoneyID' => ['required', 'max:255', 'string'],
        'attorney.fullname' => ['required', 'max:255', 'string'],
        'attorney.courtType' => ['required', 'max:255', 'string'],
        'attorney.address' => ['required', 'max:255', 'string'],
        'attorney.state' => ['required', 'max:255', 'string'],
        'attorney.empType' => ['required', 'max:255', 'string'],
        'attorney.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(Court $court): void
    {
        $this->court = $court;
        $this->resetAttorneyData();
    }

    public function resetAttorneyData(): void
    {
        $this->attorney = new Attorney();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAttorney(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.court_attorneys.new_title');
        $this->resetAttorneyData();

        $this->showModal();
    }

    public function editAttorney(Attorney $attorney): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.court_attorneys.edit_title');
        $this->attorney = $attorney;

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

        if (!$this->attorney->court_id) {
            $this->authorize('create', Attorney::class);

            $this->attorney->court_id = $this->court->id;
        } else {
            $this->authorize('update', $this->attorney);
        }

        $this->attorney->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Attorney::class);

        Attorney::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAttorneyData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->court->attorneys as $attorney) {
            array_push($this->selected, $attorney->id);
        }
    }

    public function render(): View
    {
        return view('livewire.court-attorneys-detail', [
            'attorneys' => $this->court->attorneys()->paginate(20),
        ]);
    }
}
