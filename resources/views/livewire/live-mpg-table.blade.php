<div>
<!--     <h1>{{ $message }}</h1>
    <button wire:click="$set('message', 'ボタンがクリックされました！')">
        クリックしてみてください
    </button>
    <br> -->
    <input type="text" wire:model.live="search" placeholder="検索..." class="form-control mb-3">
    <button wire:click="$set('message', 'something')">filter</button>
    <br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>CAR NAME</th>
                <th>MPG</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->car_name }}</td>
                    <td>{{ $car->mpg }}</td>
                    <td>{{ $car->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    {{ $cars->links() }}
</div>
