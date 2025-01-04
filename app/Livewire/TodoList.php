<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
        // $this->todos = Todo::orderBy('created_at', 'desc')->get();
        // ログイン中のユーザーに紐付いたToDoを取得
        $this->todos = Todo::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function addTodo()
    {
        $this->validate();

        // Todo::create(['title' => $this->title]);
        Todo::create([
            'title' => $this->title,
            'user_id' => Auth::id(), // ログイン中のユーザーIDを保存
        ]);
        $this->title = '';
        $this->loadTodos();
    }

    public function editTodo($id)
    {
        // $todo = Todo::find($id);
        $todo = Todo::where('user_id', Auth::id())->find($id);

        if ($todo) {
            $this->editingId = $todo->id;
            $this->title = $todo->title;
        }
    }

    public function updateTodo()
    {
        $this->validate();

        // $todo = Todo::find($this->editingId); //without user_id
        $todo = Todo::where('user_id', Auth::id())->find($this->editingId);

        if ($todo){
            $todo->update(['title' => $this->title]);
            $this->resetForm();
            $this->loadTodos();
        }
    }

    public function toggleCompletion($id)
    {
        // $todo = Todo::find($id); //without user_id
        $todo = Todo::where('user_id', Auth::id())->find($id);

        if ($todo){
            $todo->update(['completed' => !$todo->completed]);
            $this->loadTodos();
        }
    }

    public function deleteTodo($id)
    {
        // Todo::find($id)->delete(); //without user_id
        $todo = Todo::where('user_id', Auth::id())->find($id);

        if ($todo){
            $todo->delete();
            $this->loadTodos();
        }
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