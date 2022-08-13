@extends('layouts.app', ['class' => 'bg-warning'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    
                <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>{{ __('Registrate con tus datos personales') }}</small>
                        </div>
                        
                        <!--FORM-->
                        <form role="form" method="POST" action="{{ route('register') }}">
                            <div class="row">
                                @csrf
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                            </div>
                                            
                                            <input class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre completo') }}" type="text" name="nombre"
                                                value="{{ old('nombre') }}" autofocus>
                                        </div>
                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <br>
                                </div>


                                
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Correo Electrónico') }}" type="email" name="email"
                                                value="{{ old('email') }}" >
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Contraseña') }}" type="password" name="password"
                                                >
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div
                                        class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Confirma contraseña') }}" type="password"
                                                name="password_confirmation" >
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input type="text" placeholder="Teléfono a 10 digitos"
                                                class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}"
                                                name="telefono" />
                                        </div>
                                        @if ($errors->has('telefono'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            
                                
                               


                                <!--SELECT-->

                                <!--USER-->
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('tipoUser') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <select name="tipoUser"
                                                class="form-control{{ $errors->has('tipoUser') ? ' is-invalid' : '' }}"
                                                onChange="mostrar(this.value)" required>
                                                <option selected disabled>Selecionar usuario</option>
                                                <option class="form-control" value="0">Cliente</option>
                                                <!--<option class="form-control" value="1">Repartidor</option>
                                                <option class="form-control" value="2">Sucursal</option>-->
                                            </select>
                                        </div>
                                        @if ($errors->has('tipoUser'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('tipoUser') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!--END USER-->
                                   
                                
                                <!--END SELECT-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                        
                                            <label style="margin: auto 1%;font-size: 13px">Genero</label>
                                            
                                            <select placeholder="Sexo" class="form-control" name="sexo" id="sexo" disabled>
                                            
                                                <option value="undefinied" selected >
                                                    Seleccione
                                                </option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('FecNac') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative">
                                            <label style="margin: auto 1%;font-size: 13px">Fecha de nacimiento</label>
                                            <input type="date" placeholder="Fecha de nacimiento"
                                                class="form-control{{ $errors->has('FecNac') ? ' is-invalid' : '' }}"
                                                name="FecNac" id="FecNac" disabled/>
                                            @if ($errors->has('FecNac'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('FecNac') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!--SUCURSAL-->
                      
                                
                                <!--FINAL DE SUCURSAL-->

                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                        <label class="custom-control-label" for="customCheckRegister">
                                            <span class="text-muted">{{ __('¿Aceptas el') }} <a href="{{route('avisoPrivacidad')}}"
                                                    class="text-warning">{{ __('Aviso de privacidad?') }}</a></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-danger mt-4">{{ __('Crear cuenta') }}</button>
                                    </div>
                                </div>
                                <script type="application/javascript">
                                    function mostrar(id) {
                                        if (id === "0") {
                                            
                                            document.getElementById('FecNac').disabled = false;
                                            document.getElementById('sexo').disabled = false;
                                        }
                                        if (id === "2") {
                                            document.getElementById('HorAp').disabled = false;
                                            document.getElementById('HorCi').disabled = false;
                                            document.getElementById('Desc').disabled = false;
                                            
                                        }
                                        if (id === "1") {
                                            document.getElementById('HorAp').disabled = false;
                                            document.getElementById('HorCi').disabled = false;
                                            
                                        }
                                    }
                                </script>
                        </form>
                                <!--END FORM-->
                    </div>
                            
                </div>
            </div>
        </div>
    </div>
@endsection
