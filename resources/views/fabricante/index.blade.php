@extends('adminlte::page')

@section('title', 'Fabricantes')

@section('content_header')
    <h1>Fabricantes</h1>
@stop

@section('content')
    {{-- <a href="{{route('fabricantes.create')}}" class="btn btn-primary mb-2">Cadastrar Novo</a> --}}
    <div class="card card-primary">
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
{!! $dataTable->scripts() !!}
@stop