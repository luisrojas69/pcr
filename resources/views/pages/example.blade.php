@extends('layouts.master')

@section('title-page', "Bienvenido - PCR")

@section('message')
{{-- Incluimos las plantillas de error and success --}}
@endsection

@section('content')

 <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Titulo</h3>
        </div>
        <!-- Light table -->
        <div class="text-center">
          Aqui va el contenido
        </div>
        <!-- Card footer -->
        <div class="card-footer py-4">
          footer
        </div>
      </div>
    </div>
  </div>

@endsection

 