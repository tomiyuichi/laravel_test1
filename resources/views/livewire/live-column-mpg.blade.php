@section('css')
    {{-- nouislider.min.jsのテーマCSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css">
@stop

@section('js')
    {{-- nouislider.min.jsのスクリプト --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            const slider = document.getElementById('slider');

            // スライダーが初期化されていない場合のみ実行
            if (slider && !slider.noUiSlider) {
                noUiSlider.create(slider, {
                    start: [{{ $minHorsepower }}, {{ $maxHorsepower }}],
                    connect: true,
                    range: {
                        'min': 0,
                        'max': 100
                    }
                });

                slider.noUiSlider.on('update', function (values) {
                    const [min, max] = values.map(value => Math.round(value));
                    @this.set('minHorsepower', min);
                    @this.set('maxHorsepower', max);
                    document.getElementById('slider-min').innerText = min;
                    document.getElementById('slider-max').innerText = max;
                });
            }
        });
    </script>
@stop

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

        <!-- スライダーのHTML -->
<!--         <div class="mb-4">
            <label>Numeric Range</label>
            <div id="slider" wire:ignore></div>
            <div class="d-flex justify-content-between mt-2">
                <span>Min: <span id="slider-min">{{ $minHorsepower }}</span></span>
                <span>Max: <span id="slider-max">{{ $maxHorsepower }}</span></span>
            </div>
        </div> -->


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
                        <!-- <th>{{ ucfirst($column) }}</th> -->
                        <th>
                            <button wire:click="sortBy('{{ $column }}')">
                                {{ ucfirst($column) }}
                                @if ($sortField === $column)
                                    @if ($sortDirection === 'asc')
                                        ▲
                                    @else
                                        ▼
                                    @endif
                                @else
                                    -
                                @endif
                            </button>
                        </th>
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


