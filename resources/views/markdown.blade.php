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

    {{-- PlantUMLサーバーでレンダリングする例 --}}
    <script src="https://unpkg.com/plantuml-encoder"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const plantumlElements = document.querySelectorAll('.plantuml');
            plantumlElements.forEach(el => {
                const encodedDiagram = plantumlEncoder.encode(el.textContent);
                const img = document.createElement('img');
                img.src = `https://www.plantuml.com/plantuml/svg/${encodedDiagram}`;
                el.replaceWith(img);
            });
        });
    </script>

    {{-- mermaid記法のスクリプト --}}
    <script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            mermaid.initialize({ startOnLoad: true });
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
