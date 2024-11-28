<div>
    <h1>TODOs</h1>
    <!-- フォーム -->
    <form wire:submit.prevent="{{ $editingId ? 'updateTodo' : 'addTodo' }}" class="mb-4">
        <div class="input-group">
            <input type="text" wire:model="title" class="form-control" placeholder="ToDoを入力してください">
            <button type="submit" class="btn btn-primary">
                {{ $editingId ? '更新' : '追加' }}
            </button>
        </div>
        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    </form>

    <!-- ToDoリスト -->
    <ul class="list-group">
        @forelse ($todos as $todo)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <input type="checkbox" wire:click="toggleCompletion({{ $todo->id }})" {{ $todo->completed ? 'checked' : '' }}>
                    <span class="{{ $todo->completed ? 'text-decoration-line-through' : '' }}">
                        {{ $todo->title }}
                    </span>
                </div>
                <div>
                    <button wire:click="editTodo({{ $todo->id }})" class="btn btn-sm btn-warning">編集</button>
                    <button wire:click="deleteTodo({{ $todo->id }})" class="btn btn-sm btn-danger">削除</button>
                </div>
            </li>
        @empty
            <li class="list-group-item text-center">ToDoがありません</li>
        @endforelse
    </ul>
</div>