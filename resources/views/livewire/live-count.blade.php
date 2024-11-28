<div class="card">
    <div class="card-header">
        <h3 class="card-title">Livewire Dynamic Page Example</h3>
    </div>
    <div class="card-body">
        <label for="inputText">Type something:</label>
        <input 
            type="text" 
            id="inputText" 
            class="form-control" 
            wire:model.live="text" 
            placeholder="Enter some text"
        >

        <p class="mt-3">
            <strong>Character count:</strong> {{ strlen($text) }}
        </p>
    </div>
</div>