<div>

    <!-- 検索ボックス -->
    <div class="mb-4">
        search : 
        <input type="text" class="form-control" placeholder="Search..." wire:model.live="search">
    </div>

    <!-- カラムの切り替えボタン -->
    <div class="mb-4">
        @foreach ($allColumns as $column)
            <button wire:click="toggleColumn('{{ $column }}')" 
                class="btn btn-sm {{ in_array($column, $columns) ? 'btn-primary' : 'btn-secondary' }}">
                {{ ucfirst($column) }}
            </button>
        @endforeach
    </div>

    <!-- データテーブル -->
    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ ucfirst($column) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    @foreach ($columns as $column)
                        <td>{{ $car[$column] }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- ページネーション -->
    {{ $cars->links() }}
</div>