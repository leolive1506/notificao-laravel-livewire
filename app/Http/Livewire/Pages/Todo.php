<?php

namespace App\Http\Livewire\Pages;

use App\Http\Livewire\Events\ExemploUm;
use App\Models\Todo as ModelsTodo;
use Livewire\Component;
use Livewire\WithPagination;

class Todo extends Component
{
    use WithPagination;

    public $title = '';
    public $description = '';
    public $buscaTabela = null;
    public $salvo = false;

    public $rules = [
        'title' => 'required|min:3',
        'description' => 'nullable|min:3',
    ];

    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    protected $listeners = ['echo:orders,.ExemploUm' => 'notifyNewOrder'];

    public function mount()
    {
        // return $this->newEvent();
    }

    public function newEvent()
    {
        return event(new ExemploUm);
    }

    public function notifyNewOrder()
    {
        $this->title = 'Evento chegou';
        $this->store();
    }

    public function updated($field)
    {
        if (in_array($field, ['title', 'description'])) {
            $this->salvo = false;
            $this->validateOnly($field, $this->rules);
        }
    }

    public function store()
    {
        $this->validate();
        // sleep(2);
        ModelsTodo::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $this->resetPage();
        $this->reset('title', 'description');

        $this->salvo = true;
        $this->dispatchBrowserEvent('todo-added');
    }

    public function delete($id)
    {
        ModelsTodo::destroy($id);
    }

    public function render()
    {
        return view('livewire.pages.todo', [
            'todos' => ModelsTodo::orderBy('id', 'desc')
                ->where(function ($query) {
                    if (!empty($this->buscaTabela)) {
                        $query->where('title', 'like', "%{$this->buscaTabela}%");
                    }
                })
                ->paginate(5)
        ])->layout('layouts.admin');
    }
}
