@extends('layouts.app')

@section('content')

@if (auth()->user()->tipoUsuario=="0")
<alimentos-cliente-component />
@endif

@if (auth()->user()->tipoUsuario=="8" || auth()->user()->tipoUsuario=="2")
<alimentos-component />
@endif

@endsection