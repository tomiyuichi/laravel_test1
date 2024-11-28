<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoList extends Component
{
    public $todos;
    public $title = '';
    public $editingId = null;

    protected $rules = [
        'title' => 'required|min:3',
    ];

    public function mount()
    {
        $this->loadTodos();
    }

    public function loadTodos()
    {
        $this->todos = Todo::orderBy('created_at', 'desc')->get();
    }

    public function addTodo()
    {
        $this->validate();

        Todo::create(['title' => $this->title]);
        $this->title = '';
        $this->loadTodos();
    }

    public function editTodo($id)
    {
        $todo = Todo::find($id);
        $this->editingId = $todo->id;
        $this->title = $todo->title;
    }

    public function updateTodo()
    {
        $this->validate();

        $todo = Todo::find($this->editingId);
        $todo->update(['title' => $this->title]);

        $this->resetForm();
        $this->loadTodos();
    }

    public function toggleCompletion($id)
    {
        $todo = Todo::find($id);
        $todo->update(['completed' => !$todo->completed]);
        $this->loadTodos();
    }

    public function deleteTodo($id)
    {
        Todo::find($id)->delete();
        $this->loadTodos();
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->title = '';
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}