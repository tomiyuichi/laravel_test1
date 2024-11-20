@extends('adminlte::page')

@section('title', 'Markdown Index')

@section('content_header')
    <h1>Markdown Index</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                @foreach ($fileList as $fileName)
                    <li>
                        <a href="{{ route('markdown.show', ['fileName' => $fileName]) }}">
                            {{ ucfirst(str_replace('-', ' ', $fileName)) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop
