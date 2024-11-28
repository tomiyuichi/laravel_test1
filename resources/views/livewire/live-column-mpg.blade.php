<div>
    <!-- 検索ボックス -->
    <div class="mb-4">
        <!-- キーワード -->
        search : 
        <input type="text" class="form-control" placeholder="Search..." wire:model.live="search">

        <!-- 範囲1 -->
        <div class="row mb-2">
            <div class="col">
                <label for="minMpg">min mpg</label>
                <input type="number" id="minMpg" class="form-control" wire:model.live="minMpg">
            </div>
            <div class="col">
                <label for="maxMpg">max mpg</label>
                <input type="number" id="maxMpg" class="form-control" wire:model.live="maxMpg">
            </div>
        </div>

        <!-- 範囲2 -->
        <div class="row mb-2">
            <div class="col">
                <label for="minHorsepower">min horsepower</label>
                <input type="number" id="minHorsepower" class="form-control" wire:model.live="minHorsepower">
            </div>
            <div class="col">
                <label for="maxHorsepower">max horsepower</label>
                <input type="number" id="maxHorsepower" class="form-control" wire:model.live="maxHorsepower">
            </div>
        </div>
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


    <!-- 絞り込み結果表示 -->
    @if(!$cars->isEmpty())
        <div class="alert alert-info mt-4">
            絞り込み条件に合致するレコード数: <strong>{{ $cars->total() }}</strong>
        </div>
    @endif

    @if($cars->isEmpty())
        <div class="alert alert-warning">結果が見つかりませんでした。</div>
    @else
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
    @endif
</div>