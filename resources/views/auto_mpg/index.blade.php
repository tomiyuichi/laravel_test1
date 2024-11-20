@extends('adminlte::page')

@section('title', 'Car List')

@section('content')
<div class="container">
    <h1>Car List</h1>

    <!-- 絞り込みフォーム -->
    <form method="GET" action="{{ route('auto_mpg.index') }}">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="mpg">MPG</label>
                <input type="number" class="form-control" id="mpg" name="mpg" value="{{ request('mpg') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="cylinders">Cylinders</label>
                <input type="number" class="form-control" id="cylinders" name="cylinders" value="{{ request('cylinders') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="min_horsepower">MIN Horsepower</label>
                <input type="number" class="form-control" id="min_horsepower" name="min_horsepower" value="{{ request('min_horsepower') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="max_horsepower">MAX Horsepower</label>
                <input type="number" class="form-control" id="max_horsepower" name="max_horsepower" value="{{ request('max_horsepower') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- 絞り込み結果表示 -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Car Name</th>
                <th>MPG</th>
                <th>Cylinders</th>
                <th>Horsepower</th>
            </tr>
        </thead>
        <tbody>
            <!-- $cars comes from Auto_mpg_Controller -->
            @foreach ($cars as $car)
                <tr>
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
</div>
@endsection