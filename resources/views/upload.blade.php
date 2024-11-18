@extends('adminlte::page')

@section('title', 'CSV Upload')

@section('content_header')
    <h1>CSVファイルアップロード</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">CSVファイルを選択</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">アップロード</button>
    </form>
@stop
