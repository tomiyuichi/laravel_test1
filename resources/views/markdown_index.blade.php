@extends('adminlte::page')

@section('title', 'Markdown Index')

@section('content_header')
    <h1>Markdown Index</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                @foreach ($fileList as $file)
                    <li>
                        <a href="{{ route('markdown.show', ['path' => $file['path']]) }}">
                            {{ $file['path'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop