@extends('apostol.plantilla')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/datos_complementarios.css') }}"> {{-- asset css PARA GENERACIÓN DE HTML --}}
@endsection

@section('content_header')
    <h3 id="nombre">{{ grado_nombre_completo($user->id) }}</h3>
@endsection

@section('content')
    <div class="card">
        <div class="card-header" id="titulo">
            DATOS PERSONALES
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">GRADO</th>
                        @if($user->datosmilitar->escalafon->id == 1)
                            <th scope="col">ARMA</th>
                        @else
                            <th scope="col">PROF/OCUP</th>
                        @endif
                        <th scope="col">ESPECIALIDAD</th>
                        <th scope="col">AP. PATERNO</th>
                        <th scope="col">AP. MATERNO</th>
                        <th scope="col">NOMBRES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ grado($user->id,'show') }}</td>
                        @if($user->datosmilitar->escalafon->id == 1)
                            <td>{{ arma($user->id,'show') }}</td>
                        @else
                            <td>{{ profocup($user->id,'show') }}</td>
                        @endif
                        <td>{{ diplomado($user->id,'show') }}</td>
                        <td>{{ noms_aps($user->id,'prim') }}</td>
                        <td>{{ noms_aps($user->id,'seg') }}</td>
                        <td>{{ noms_aps($user->id,'nom') }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">FECHA DE NACIMIENTO</th>
                        <th scope="col">LUGAR DE NACIMIENTO</th>
                        <th scope="col">C.I.</th>
                        <th scope="col">COMPLEMENTO</th>
                        <th scope="col">EXTENSION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->f_nac}}</td>
                        <td>{{ l_nac($user->id) }}</td>
                        <td>{{ $user->ci }}</td>
                        <td>{{ $user->comp }}</td>
                        <td>{{ $user->ext }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ESTADO CIVIL</th>
                        <th scope="col">TIPO DE SANGRE</th>
                        <th scope="col">CARNET MILITAR</th>
                        <th scope="col">MATRÍCULA SEGURO DE SALUD</th>
                        <th scope="col">N° BOLETA DE PAGO</th>
                        <th scope="col">SITUACIÓN</th>
                        <th scope="col">FECHA DE ALTA EN LA INSTITUCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->e_civil }}</td>
                        <td>{{ $user->g_sang }}</td>
                        <td>{{ $user->carnet->c_militar }}</td>
                        <td>{{ $user->carnet->c_seguro }}</td>
                        <td>{{ $user->papeleta }}</td>
                        <td>{{ estado_user($user->id, 'show') }}</td>
                        <td>{{ $user->f_alt }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{route('users.edit', $user->id)}}" class="btn btn-secondary">EDITAR DATOS</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="titulo">
            DESTINO
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">UNIDAD DESTINO</th>
                        <th scope="col">DESDE</th>
                        <th scope="col">CARGO</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($destino_user)
                            <td>{{ $destino_user->unidad->abrev }}</td>
                            <td>{{ $destino_user->f_ini }}</td>
                            <td>cargo</td>
                    @else
                        <td colspan="3" align="center">SIN REGISTRO</td>
                    @endif
                </tbody>
            </table>
            @if ($destino_user)
                <a href="{{route('destinos.edit', $destino_user->id)}}" class="btn btn-secondary">EDITAR</a>
                <a href="{{route('destinos.cambiar_destino', $destino_user->id)}}" class="btn btn-secondary">CAMBIAR DE DESTINO</a>
            @else
                <a href="{{route('destinos.create', $user->id)}}" class="btn btn-secondary">INSERTAR</a>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="titulo">
            DIRECCIÓN, NÚMERO TELEFÓNICO Y CONTACTO DE EMERGENCIA
        </div>
        <div class="card-body">
            <table class="table" id="table_datos_complementarios">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">DIRECCIÓN</th>
                        <th scope="col">NÚMERO TELEFÓNICO</th>
                        <th scope="col">CONTACTO DE EMERGENCIA</th>
                        <th scope="col">TELÉFONO DEL CONTACTO DE EMERGENCIA</th>
                        <th scope="col">OBS.</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($datos_complementarios as $datos_complementario)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{ $i}}</td>
                            <td>{{ $datos_complementario->direccion }}</td>
                            <td>{{ $datos_complementario->cel }}</td>
                            <td>{{ $datos_complementario->contacto }}</td>
                            <td>{{ $datos_complementario->cel_contacto }}</td>
                            @if($datos_complementario->estado == 1)
                                <td>
                                    ACTUAL
                                </td>
                            @else
                                <td>
                                    ANTERIOR
                                </td>
                            @endif
                            <td>
                                <a href="{{route('datos.edit', $datos_complementario->id)}}" class="btn btn-secondary" title="EDITAR"><i class="fas fa-fsolid fa-pen"></i></a>
                                <a href="{{route('datos.eliminar', $datos_complementario->id)}}" class="btn btn-secondary" title="ELIMINAR"><i class="fas fa-light fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{route('datos.create', $user->id)}}" class="btn btn-secondary">INSERTAR</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="titulo">
            DATOS FAMILIARES
        </div>
        <div class="card-body">
            <table class="table" id="table_datofamiliars">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">RELACIÓN</th>
                        <th scope="col">AP. PATERNO</th>
                        <th scope="col">AP. MATERNO</th>
                        <th scope="col">NOMBRES</th>
                        <th scope="col">SEGURO</th>
                        <th scope="col">CARNET DEL SEGURO</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($datofamiliars as $datofamiliar)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{ $i}}</td>
                            <td>{{ $datofamiliar->relacion->relacion }}</td>
                            <td>{{ $datofamiliar->prim_apellido }}</td>
                            <td>{{ $datofamiliar->seg_apellido }}</td>
                            <td>{{ $datofamiliar->nombres }}</td>
                            <td>{{ $datofamiliar->seguro->seguro }}</td>
                            <td>{{ $datofamiliar->c_seguro }}</td>
                            <td>
                                <a href="{{route('datofamiliars.edit', $datofamiliar->id)}}" class="btn btn-secondary" title="EDITAR"><i class="fas fa-fsolid fa-pen"></i></a>
                                <a href="{{route('datos.eliminar', $datofamiliar->id)}}" class="btn btn-secondary" title="ELIMINAR"><i class="fas fa-light fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{route('datofamiliars.create', $user->id)}}" class="btn btn-secondary">INSERTAR</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="titulo">
            PISTOLA DE DOTACIÓN INDIVIDUAL
        </div>
        <div class="card-body">
            <table class="table" id="table_pistolas">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">N° DE SERIE</th>
                        <th scope="col">MARCA</th>
                        <th scope="col">MODELO</th>
                        <th scope="col">TIPO</th>
                        <th scope="col">CALIBRE</th>
                        <th scope="col">SITUACIÓN</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($armamentos_users as $armamento_user)
                        @if($armamento_user->tipo == 1)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $armamento_user->serie }}</td>
                                <td>{{ $armamento_user->modelo->marca->marca }}</td>
                                <td>{{ $armamento_user->modelo->modelo }}</td>
                                <td>{{ $armamento_user->modelo->modelo }}</td>
                                <td>{{ $armamento_user->modelo->calibre }}</td>
                                <td>{{ $armamento_user->situacion->situacion }}</td>
                                <td>
                                    <a href="{{route('armamentos_users.show', $armamento_user->id)}}" class="btn btn-secondary" title="VER MÁS DATOS"><i class="fas fa-fsolid fa-eye"></i></a>
                                    <a href="{{route('armamentos_users.edit', $armamento_user->id)}}" class="btn btn-secondary" title="EDITAR"><i class="fas fa-fsolid fa-pen"></i></a>
                                    <a href="#" class="btn btn-secondary" title="ELIMINAR"><i class="fas fa-light fa-trash"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @if($user->datosmilitar->escalafon->id == 1)
                <a href="{{route('armamentos_users.create', [$user->id, 1])}}" class="btn btn-secondary">INSERTAR</a>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="titulo">
            BAYONETA DE DOTACIÓN
        </div>
        <div class="card-body">
            <table class="table" id="table_bayonetas">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">N° DE SERIE</th>
                        <th scope="col">MARCA</th>
                        <th scope="col">MODELO</th>
                        <th scope="col">USO</th>
                        <th scope="col">SITUACIÓN</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($armamentos_users as $armamento_user)
                        @if($armamento_user->tipo == 2)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $armamento_user->serie }}</td>
                                <td>{{ $armamento_user->modelo->marca->marca }}</td>
                                <td>{{ $armamento_user->modelo->modelo }}</td>
                                <td>{{ $armamento_user->uso }}</td>
                                <td>{{ $armamento_user->situacion->situacion }}</td>
                                <td>
                                    <a href="{{route('armamentos_users.show', $armamento_user->id)}}" class="btn btn-secondary" title="VER MÁS DATOS"><i class="fas fa-fsolid fa-eye"></i></a>
                                    <a href="{{route('armamentos_users.edit', $armamento_user->id)}}" class="btn btn-secondary" title="EDITAR"><i class="fas fa-fsolid fa-pen"></i></a>
                                    <a href="#" class="btn btn-secondary" title="ELIMINAR"><i class="fas fa-light fa-trash"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @if($user->datosmilitar->escalafon->id == 1)
                <a href="{{route('armamentos_users.create', [$user->id, 2])}}" class="btn btn-secondary">INSERTAR</a>
            @endif
        </div>
    </div>
@endsection

