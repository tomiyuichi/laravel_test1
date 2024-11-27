@extends('adminlte::page')
<!-- <p>components/layouts/app.blade.php !!!</p> -->
@section('content')
   {{ $slot }}
@stop

@section('js')
    @livewireScripts
@stop

@section('css')
    @livewireStyles
@stop