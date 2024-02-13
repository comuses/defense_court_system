<?php

namespace App\Http\Livewire;

use App\Models\Bar;
use App\Models\Court;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourtBarsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Court $court;
    public Bar $bar;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Bar';

    protected $rules = [
        'bar.courtID' => ['required', 'max:255', 'string'],
        'bar.address' => ['required', 'max:255', 'string'],
        'bar.state' => ['required', 'max:255', 'string'],
        'bar.location' => ['required', 'max:255', 'string'],
        'bar.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(Court $court): void
    {
        $this->court = $court;
        $this->resetBarData();
    }

    public function resetBarData(): void
    {
        $this->bar = new Bar();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newBar(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.court_bars.new_title');
        $this->resetBarData();

        $this->showModal();
    }

    public function editBar(Bar $bar): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.court_bars.edit_title');
        $this->bar = $bar;

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

        if (!$this->bar->court_id) {
            $this->authorize('create', Bar::class);

            $this->bar->court_id = $this->court->id;
        } else {
            $this->authorize('update', $this->bar);
        }

        $this->bar->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Bar::class);

        Bar::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetBarData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->court->bars as $bar) {
            array_push($this->selected, $bar->id);
        }
    }

    public function render(): View
    {
        return view('livewire.court-bars-detail', [
            'bars' => $this->court->bars()->paginate(20),
        ]);
    }
}
