

@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
        </div>
            
@if (auth()->user()->tipoUsuario=="0")
        
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('argon') }}/img/brand/freecoffee.png" alt="First slide">
      
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('argon') }}/img/brand/sabias.png" alt="Second slide">
    </div>
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                @endif
                @if (auth()->user()->tipoUsuario=="8")
                <div class="table-responsive">

                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        
                    <img class="d-block w-100" src="{{ asset('argon') }}/img/brand/admin.png" alt="First slide">
                
                @endif

                @if (auth()->user()->tipoUsuario=="2")
                <div class="table-responsive">

                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        
                    <img class="d-block w-100" src="{{ asset('argon') }}/img/brand/negocio.png" alt="First slide">
                
                @endif
                        <!-- Projects table -->
                        <!--<div class="row">
                        <div class="col">
                        <div class="card bg-secondary shadow">
                        <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo de Usuario</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Fecha de alta</th>
                                </tr>
                            </thead>
                            <?php

use Illuminate\Support\Facades\DB;

                            $users = DB::table('users')
                                ->where('tipoUsuario', '!=', 8)
                                ->orderBy('created_at','DESC')
                                ->get();
                            ?>
                            <tbody>
                                @if ($users->count() < 1)
                                    <tr>
                                        <th>No hay Usuarios</th>
                                    </tr>
                                @else
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">
                                                {{ $user->name }}
                                            </th>
                                            <td>
                                            @if ($user->tipoUsuario == 0)
                                                    Cliente
                                                @elseif($user->tipoUsuario==1)
                                                    Repartidor
                                                @else
                                                    Negocio
                                                @endif
                                            </td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $user->telefono }}
                                            </td>
                                            <td>
                                                {{ $user->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>-->
                    
                    </div>
                </div>
            
            
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js" type="application/javascript"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js" type="application/javascript"></script>
    @if (Cookie::get('aviso'))
        <script>
            Swal.fire({
                title: 'Alto!',
                text: 'Acceso No Autorizado',
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (Cookie::get('pago'))
        <script>
            Swal.fire("¡Gracias por su compra!", "Se registró el pago correctamente", "success");
        </script>
    @endif
@endpush
