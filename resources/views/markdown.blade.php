@extends('adminlte::page')

@section('css')
    {{-- Highlight.jsのテーマCSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css">
@stop

@section('js')
    {{-- Highlight.jsのスクリプト --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    <script>
        // ページ読み込み時にコードブロックをハイライト
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        });
    </script>
@stop

@section('title', 'Markdown Page')

@section('content_header')
    <h1>Markdown Page</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! $htmlContent !!}
        </div>
    </div>
@stop
