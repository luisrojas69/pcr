
@extends('layouts.master')

@section('title-page', "Vehiculos Registrados")

@section('additionals-css')
{{-- Css Adicionales --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css') }}">

@endsection

@section('message')
{{-- Incluimos las plantillas de error and success --}}
@endsection

@section('content')
	<vehicles></vehicles>
@endsection

@section('additionals-scripts')
{{-- Scripts Adicionales --}}
<script src="{{ asset('js/datatables.js') }}"></script>    
@endsection
