@extends('adminlte::page')

@section('title', 'Dynamic_mpg Sample Page')

@section('content_header')
    <h1>MPG List</h1>
@stop

@section('content')
    <form method="GET" action="{{ route('dynamic_mpg.index') }}">
        <div class="form-group">
            <label for="columns">表示するカラムを選択:</label>
            <select name="columns[]" id="columns" class="form-control" multiple>
                @foreach(['id', 'car_name', 'mpg', 'cylinders', 'horsepower', 'created_at', 'updated_at'] as $column)
                    <option value="{{ $column }}" 
                        {{ in_array($column, $columns) ? 'selected' : '' }}>
                        {{ $column }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">表示更新</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
                <tr>
                    @foreach($columns as $column)
                        <td>{{ $car->$column }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

