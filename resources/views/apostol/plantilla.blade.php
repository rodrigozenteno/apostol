@extends('adminlte::page')

@section('title', 'APOSTOL')

@section('content_header')
    
@stop

@section('content')
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @yield('css_bootstrap')
    @yield('css_datatable')
    @yield('css_chosen')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    @yield('js_bootstrap')
    @yield('js_datatable')
    @yield('js_chosen')
    @yield('js_script')
    @yield('js_script2')
    @yield('js_sweetalert')
@stop