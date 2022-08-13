@extends('layouts.app')

@section('content')

@if (auth()->user()->tipoUsuario=="0")
<pedidos-cliente-component/>
@endif

@if (auth()->user()->tipoUsuario=="1")
<pedidos-repartidor-component/>
@endif

@if (auth()->user()->tipoUsuario=="2")
<pedidos-negocio-component/>
@endif

@if (auth()->user()->tipoUsuario=="8")
<pedidos-component/>
@endif

@endsection