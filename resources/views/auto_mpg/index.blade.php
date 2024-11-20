@extends('adminlte::page')

@section('title', 'Car List')

@section('content')
<div class="container">
    <h1>Car List</h1>

    <!-- 絞り込みフォーム -->
    @php
        // 一時変数名
        $min_mpg = $limits["mpg"]["min"];
        $max_mpg = $limits["mpg"]["max"];
        $min_cylinders = $limits["cylinders"]["min"];
        $max_cylinders = $limits["cylinders"]["max"];
        $min_horsepower = $limits["horsepower"]["min"];
        $max_horsepower = $limits["horsepower"]["max"];
    @endphp
    <form method="GET" action="{{ route('auto_mpg.index') }}">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="mpg">MPG</label>
                <input type="number" class="form-control" id="mpg" name="mpg" min={{$min_mpg}} max={{$max_mpg}} placeholder="mpgを入力" value="{{ request('mpg') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="cylinders">MIN Cylinders</label>
                <input type="number" class="form-control" id="min_cylinders" name="min_cylinders" min={{$min_cylinders}} max={{$max_cylinders}} placeholder="cylindersを入力" value="{{ request('min_cylinders') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="cylinders">MAX Cylinders</label>
                <input type="number" class="form-control" id="max_cylinders" name="max_cylinders" min={{$min_cylinders}} max={{$max_cylinders}} placeholder="cylindersを入力" value="{{ request('max_cylinders') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="min_horsepower">MIN Horsepower</label>
                <input type="number" class="form-control" id="min_horsepower" name="min_horsepower" min={{$min_horsepower}} max={{$max_horsepower}} placeholder="horsepowerを入力" value="{{ request('min_horsepower') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="max_horsepower">MAX Horsepower</label>
                <input type="number" class="form-control" id="max_horsepower" name="max_horsepower" min={{$min_horsepower}} max={{$max_horsepower}} placeholder="horsepowerを入力" value="{{ request('max_horsepower') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- 絞り込み結果表示 -->
    @if(!$cars->isEmpty())
        <div class="alert alert-info mt-4">
            絞り込み条件に合致するレコード数: <strong>{{ $cars->total() }}</strong>
        </div>
    @endif

    @if($cars->isEmpty())
        <div class="alert alert-warning">結果が見つかりませんでした。</div>
    @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>番号</th>
                    <!-- <th>ID</th> -->
                    <!-- <th>Car Name</th> -->
                    <!-- <th>MPG</th> -->
                    <!-- <th>Cylinders</th> -->
                    <!-- <th>Horsepower</th> -->
                    <th>
                        <a href="{{ route('auto_mpg.index', array_merge(request()->query(), ['sort_column' => 'id', 'sort_order' => ($sortColumn == 'id' && $sortOrder == 'asc') ? 'desc' : 'asc'])) }}">
                            ID
                            @if($sortColumn == 'id')
                                @if($sortOrder == 'asc') ↑ @else ↓ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('auto_mpg.index', array_merge(request()->query(), ['sort_column' => 'car_name', 'sort_order' => ($sortColumn == 'car_name' && $sortOrder == 'asc') ? 'desc' : 'asc'])) }}">
                            Car Name
                            @if($sortColumn == 'car_name')
                                @if($sortOrder == 'asc') ↑ @else ↓ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('auto_mpg.index', array_merge(request()->query(), ['sort_column' => 'mpg', 'sort_order' => ($sortColumn == 'mpg' && $sortOrder == 'asc') ? 'desc' : 'asc'])) }}">
                            MPG
                            @if($sortColumn == 'mpg')
                                @if($sortOrder == 'asc') ↑ @else ↓ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('auto_mpg.index', array_merge(request()->query(), ['sort_column' => 'cylinders', 'sort_order' => ($sortColumn == 'cylinders' && $sortOrder == 'asc') ? 'desc' : 'asc'])) }}">
                            Cylinders
                            @if($sortColumn == 'cylinders')
                                @if($sortOrder == 'asc') ↑ @else ↓ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('auto_mpg.index', array_merge(request()->query(), ['sort_column' => 'horsepower', 'sort_order' => ($sortColumn == 'horsepower' && $sortOrder == 'asc') ? 'desc' : 'asc'])) }}">
                            Horsepower
                            @if($sortColumn == 'horsepower')
                                @if($sortOrder == 'asc') ↑ @else ↓ @endif
                            @endif
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- $cars comes from Auto_mpg_Controller -->
                @foreach ($cars as $index => $car)
                    <tr>
                        <td>{{ ($cars->currentPage() - 1) * $cars->perPage() + $index + 1 }}</td>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->car_name }}</td>
                        <td>{{ $car->mpg }}</td>
                        <td>{{ $car->cylinders }}</td>
                        <td>{{ $car->horsepower }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- ページネーション -->
        {{ $cars->links() }}
    @endif
</div>
@endsection