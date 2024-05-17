@extends('apostol.plantilla')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/varios.css') }}"> {{-- asset css PARA GENERACIÓN DE HTML --}}
@endsection

@section('content_header')
<h3 id="titulo">PARTE DEL (DE LA) {{$unidad->abrev}} DEL {{$hoy}}</h3>
@endsection

@section('content')
@php
    $armas_sup = efectivos_personal($unidad->id, 1);
    $armas_sub = efectivos_personal($unidad->id, 2);
    $armas_sofs = efectivos_personal($unidad->id, 3);
    $armas_sgtos = efectivos_personal($unidad->id, 4);
    $mus_sofs = efectivos_personal($unidad->id, 5);
    $mus_sgtos = efectivos_personal($unidad->id, 6);
    $serv_oo = efectivos_personal($unidad->id, 7);
    $serv_sofs = efectivos_personal($unidad->id, 8);
    $serv_sgtos = efectivos_personal($unidad->id, 9);
    $ee_cc_prof = efectivos_personal($unidad->id, 10);
    $ee_cc_tec = efectivos_personal($unidad->id, 11);
    $ee_cc_adm = efectivos_personal($unidad->id, 12);
    $ee_cc_apad = efectivos_personal($unidad->id, 13);
    $destino_novedad = destino_novedad($unidad, $hoy);
    $destinados = destinados($unidad->id);
    $efectivo = count($destinados);
@endphp
<table class="table table-bordered" id="tabla_parte">
    <thead>
        <tr>
            <th scope="col" rowspan="2" id="celda">DETALLE</th>
            <th scope="col" colspan="4" id="celda">ARMAS</th>
            <th scope="col" colspan="2" id="celda">B.M.</th>
            <th scope="col" colspan="3" id="celda">SERVICIOS</th>
            <th scope="col" colspan="4" id="celda">EE.CC.</th>
            <th scope="col" id="celda">TOTAL</th>
        </tr>
        <tr>
            <th scope="col" id="celda">OO. SUP.</th>
            <th scope="col" id="celda">OO. SUB.</th>
            <th scope="col" id="celda">SOFS.</th>
            <th scope="col" id="celda">SGTOS.</th>
            <th scope="col" id="celda">SOFS.</th>
            <th scope="col" id="celda">SGTOS.</th>
            <th scope="col" id="celda">OO. SERV.</th>
            <th scope="col" id="celda">SOFS. SERV.</th>
            <th scope="col" id="celda">SGTOS. SERV.</th>
            <th scope="col" id="celda">PROFS.</th>
            <th scope="col" id="celda">TÉCS.</th>
            <th scope="col" id="celda">ADM.</th>
            <th scope="col" id="celda">APAD.</th>
            <th scope="col" id="celda">TOTAL</th>
        </tr>
    </thead>
    <tbody>
        <tr class="tr_negrita">
            <td id="celda">EFECTIVO</td>
            <td id="celda">{{$armas_sup}}</td>
            <td id="celda">{{$armas_sub}}</td>
            <td id="celda">{{$armas_sofs}}</td>
            <td id="celda">{{$armas_sgtos}}</td>
            <td id="celda">{{$mus_sofs}}</td>
            <td id="celda">{{$mus_sgtos}}</td>
            <td id="celda">{{$serv_oo}}</td>
            <td id="celda">{{$serv_sofs}}</td>
            <td id="celda">{{$serv_sgtos}}</td>
            <td id="celda">{{$ee_cc_prof}}</td>
            <td id="celda">{{$ee_cc_tec}}</td>
            <td id="celda">{{$ee_cc_adm}}</td>
            <td id="celda">{{$ee_cc_apad}}</td>
            <td id="celda_fin">{{$efectivo}}</td>
        </tr>
        @php
            $acum = 0;
        @endphp
        @foreach ($novedads as $novedad)
            @php
                $cont = 0;
            @endphp
            @foreach ($destino_novedad as $dest_nov)
                @if ($novedad->id == $dest_nov->novedad_id)
                    @php
                        $cont++;
                    @endphp
                @endif
            @endforeach
            @if ($cont > 0)
                <tr>
                    <td id="celda">{{$novedad->novedad}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '1')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '2')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '3')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '4')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '5')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '6')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '7')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '8')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '9')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '10')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '11')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '12')}}</td>
                    <td id="celda">{{novedad_cantidad($unidad->id, $novedad->id, '13')}}</td>
                    <td id="celda_fin">{{$cont}}</td>
                </tr>
            @endif
            @php
                $acum = $acum + $cont;
            @endphp
        @endforeach
        <tr class="tr_negrita">
            <td id="celda">NO DISPONIBLES</td>
            <td id="celda">{{no_disponibles($unidad->id, '1')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '2')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '3')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '4')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '5')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '6')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '7')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '8')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '9')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '10')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '11')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '12')}}</td>
            <td id="celda">{{no_disponibles($unidad->id, '13')}}</td>
            <td>{{no_disponibles_total($unidad->id)}}</td>
        </tr>
        <tr class="tr_negrita">
            <td>DISPONIBLES</td>
            <td>{{$armas_sup - no_disponibles($unidad->id, '1')}}</td>
            <td>{{$armas_sub - no_disponibles($unidad->id, '2')}}</td>
            <td>{{$armas_sofs - no_disponibles($unidad->id, '3')}}</td>
            <td>{{$armas_sgtos - no_disponibles($unidad->id, '4')}}</td>
            <td>{{$mus_sofs - no_disponibles($unidad->id, '5')}}</td>
            <td>{{$mus_sgtos - no_disponibles($unidad->id, '6')}}</td>
            <td>{{$serv_oo - no_disponibles($unidad->id, '7')}}</td>
            <td>{{$serv_sofs - no_disponibles($unidad->id, '8')}}</td>
            <td>{{$serv_sgtos - no_disponibles($unidad->id, '9')}}</td>
            <td>{{$ee_cc_prof - no_disponibles($unidad->id, '10')}}</td>
            <td>{{$ee_cc_tec - no_disponibles($unidad->id, '11')}}</td>
            <td>{{$ee_cc_adm - no_disponibles($unidad->id, '12')}}</td>
            <td>{{$ee_cc_apad - no_disponibles($unidad->id, '13')}}</td>
            <td>{{$efectivo - $acum}}</td>
        </tr>
        <tfoot class="tr_negrita">
            <tr>
                <th scope="col">TOTAL</th>
                <td>{{$armas_sup}}</td>
                <td>{{$armas_sub}}</td>
                <td>{{$armas_sofs}}</td>
                <td>{{$armas_sgtos}}</td>
                <td>{{$mus_sofs}}</td>
                <td>{{$mus_sgtos}}</td>
                <td>{{$serv_oo}}</td>
                <td>{{$serv_sofs}}</td>
                <td>{{$serv_sgtos}}</td>
                <td>{{$ee_cc_prof}}</td>
                <td>{{$ee_cc_tec}}</td>
                <td>{{$ee_cc_adm}}</td>
                <td>{{$ee_cc_apad}}</td>
                <th scope="col">{{$efectivo}}</th>
            </tr>
        </tfoot>
    </tbody>
  </table>
  <h4 id="titulo">DEMOSTRACIÓN</h4>
    @foreach ($novedads as $novedad)
        @php
            $cont = 0;
        @endphp
        @foreach ($destino_novedad as $dest_nov)
            @if ($novedad->id == $dest_nov->novedad_id)
                @php
                    $cont++;
                @endphp
                @if ($cont == 1)
                    <div class="form-group" id="novedad_id">
                        {{ Form::label('novedad_id', $novedad->novedad) }}
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">GRADO Y NOMBRE COMPLETO</th>
                                <th scope="col">DESDE</th>
                                <th scope="col">HASTA</th>
                                <th scope="col">OBS.</th>
                            </tr>
                        </thead>
                        <tbody>
                @endif
                            <tr>
                                <th scope="row">{{$cont}}</th>
                                <td>{{grado_nombre_completo($dest_nov->user_id)}}</td>
                                <td>{{$dest_nov->desde}}</td>
                                <td>{{$dest_nov->hasta}}</td>
                                <td>{{$dest_nov->obs}}</td>
                            </tr>
            @endif
        @endforeach
                    </tbody>
                </table>
    @endforeach
    <br>
    @if(count($uu_dd))
        <h4 id="uu_dd">UNIDADES DEPENDIENTES DEL (DE LA) {{ $unidad->unidad }}</h4>
        @foreach($uu_dd as $u_d)
            <h5 id="uu_dd">PARTE DEL (DE LA) {{$u_d->abrev}} DEL {{$hoy}}</h5>
            @php
                $armas_sup = efectivos_personal($u_d->id, 1);
                $armas_sub = efectivos_personal($u_d->id, 2);
                $armas_sofs = efectivos_personal($u_d->id, 3);
                $armas_sgtos = efectivos_personal($u_d->id, 4);
                $mus_sofs = efectivos_personal($u_d->id, 5);
                $mus_sgtos = efectivos_personal($u_d->id, 6);
                $serv_oo = efectivos_personal($u_d->id, 7);
                $serv_sofs = efectivos_personal($u_d->id, 8);
                $serv_sgtos = efectivos_personal($u_d->id, 9);
                $ee_cc_prof = efectivos_personal($u_d->id, 10);
                $ee_cc_tec = efectivos_personal($u_d->id, 11);
                $ee_cc_adm = efectivos_personal($u_d->id, 12);
                $ee_cc_apad = efectivos_personal($u_d->id, 13);
                $destino_novedad = destino_novedad($u_d, $hoy);
                $destinados = destinados($u_d->id);
                $efectivo = count($destinados);
            @endphp
            <table class="table table-bordered" id="tabla_parte">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" id="celda">DETALLE</th>
                        <th scope="col" colspan="4" id="celda">ARMAS</th>
                        <th scope="col" colspan="2" id="celda">B.M.</th>
                        <th scope="col" colspan="3" id="celda">SERVICIOS</th>
                        <th scope="col" colspan="4" id="celda">EE.CC.</th>
                        <th scope="col" id="celda">TOTAL</th>
                    </tr>
                    <tr>
                        <th scope="col" id="celda">OO. SUP.</th>
                        <th scope="col" id="celda">OO. SUB.</th>
                        <th scope="col" id="celda">SOFS.</th>
                        <th scope="col" id="celda">SGTOS.</th>
                        <th scope="col" id="celda">SOFS.</th>
                        <th scope="col" id="celda">SGTOS.</th>
                        <th scope="col" id="celda">OO. SERV.</th>
                        <th scope="col" id="celda">SOFS. SERV.</th>
                        <th scope="col" id="celda">SGTOS. SERV.</th>
                        <th scope="col" id="celda">PROFS.</th>
                        <th scope="col" id="celda">TÉCS.</th>
                        <th scope="col" id="celda">ADM.</th>
                        <th scope="col" id="celda">APAD.</th>
                        <th scope="col" id="celda">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tr_negrita">
                        <td id="celda">EFECTIVO</td>
                        <td id="celda">{{$armas_sup}}</td>
                        <td id="celda">{{$armas_sub}}</td>
                        <td id="celda">{{$armas_sofs}}</td>
                        <td id="celda">{{$armas_sgtos}}</td>
                        <td id="celda">{{$mus_sofs}}</td>
                        <td id="celda">{{$mus_sgtos}}</td>
                        <td id="celda">{{$serv_oo}}</td>
                        <td id="celda">{{$serv_sofs}}</td>
                        <td id="celda">{{$serv_sgtos}}</td>
                        <td id="celda">{{$ee_cc_prof}}</td>
                        <td id="celda">{{$ee_cc_tec}}</td>
                        <td id="celda">{{$ee_cc_adm}}</td>
                        <td id="celda">{{$ee_cc_apad}}</td>
                        <td id="celda_fin">{{$efectivo}}</td>
                    </tr>
                    @php
                        $acum = 0;
                    @endphp
                    @foreach ($novedads as $novedad)
                        @php
                            $cont = 0;
                        @endphp
                        @foreach ($destino_novedad as $dest_nov)
                            @if ($novedad->id == $dest_nov->novedad_id)
                                @php
                                    $cont++;
                                @endphp
                            @endif
                        @endforeach
                        @if ($cont > 0)
                            <tr>
                                <td id="celda">{{$novedad->novedad}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '1')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '2')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '3')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '4')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '5')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '6')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '7')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '8')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '9')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '10')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '11')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '12')}}</td>
                                <td id="celda">{{novedad_cantidad($u_d->id, $novedad->id, '13')}}</td>
                                <td id="celda_fin">{{$cont}}</td>
                            </tr>
                        @endif
                        @php
                            $acum = $acum + $cont;
                        @endphp
                    @endforeach
                    <tr class="tr_negrita">
                        <td id="celda">NO DISPONIBLES</td>
                        <td id="celda">{{no_disponibles($u_d->id, '1')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '2')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '3')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '4')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '5')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '6')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '7')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '8')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '9')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '10')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '11')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '12')}}</td>
                        <td id="celda">{{no_disponibles($u_d->id, '13')}}</td>
                        <td>{{no_disponibles_total($u_d->id)}}</td>
                    </tr>
                    <tr class="tr_negrita">
                        <td>DISPONIBLES</td>
                        <td>{{$armas_sup - no_disponibles($u_d->id, '1')}}</td>
                        <td>{{$armas_sub - no_disponibles($u_d->id, '2')}}</td>
                        <td>{{$armas_sofs - no_disponibles($u_d->id, '3')}}</td>
                        <td>{{$armas_sgtos - no_disponibles($u_d->id, '4')}}</td>
                        <td>{{$mus_sofs - no_disponibles($u_d->id, '5')}}</td>
                        <td>{{$mus_sgtos - no_disponibles($u_d->id, '6')}}</td>
                        <td>{{$serv_oo - no_disponibles($u_d->id, '7')}}</td>
                        <td>{{$serv_sofs - no_disponibles($u_d->id, '8')}}</td>
                        <td>{{$serv_sgtos - no_disponibles($u_d->id, '9')}}</td>
                        <td>{{$ee_cc_prof - no_disponibles($u_d->id, '10')}}</td>
                        <td>{{$ee_cc_tec - no_disponibles($u_d->id, '11')}}</td>
                        <td>{{$ee_cc_adm - no_disponibles($u_d->id, '12')}}</td>
                        <td>{{$ee_cc_apad - no_disponibles($u_d->id, '13')}}</td>
                        <td>{{$efectivo - $acum}}</td>
                    </tr>
                    <tfoot class="tr_negrita">
                        <tr>
                            <th scope="col">TOTAL</th>
                            <td>{{$armas_sup}}</td>
                            <td>{{$armas_sub}}</td>
                            <td>{{$armas_sofs}}</td>
                            <td>{{$armas_sgtos}}</td>
                            <td>{{$mus_sofs}}</td>
                            <td>{{$mus_sgtos}}</td>
                            <td>{{$serv_oo}}</td>
                            <td>{{$serv_sofs}}</td>
                            <td>{{$serv_sgtos}}</td>
                            <td>{{$ee_cc_prof}}</td>
                            <td>{{$ee_cc_tec}}</td>
                            <td>{{$ee_cc_adm}}</td>
                            <td>{{$ee_cc_apad}}</td>
                            <th scope="col">{{$efectivo}}</th>
                        </tr>
                    </tfoot>
                </tbody>
            </table>
            <h4 id="titulo">DEMOSTRACIÓN</h4>
                @foreach ($novedads as $novedad)
                    @php
                        $cont = 0;
                    @endphp
                    @foreach ($destino_novedad as $dest_nov)
                        @if ($novedad->id == $dest_nov->novedad_id)
                            @php
                                $cont++;
                            @endphp
                            @if ($cont == 1)
                                <div class="form-group" id="novedad_id">
                                    {{ Form::label('novedad_id', $novedad->novedad) }}
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">GRADO Y NOMBRE COMPLETO</th>
                                            <th scope="col">DESDE</th>
                                            <th scope="col">HASTA</th>
                                            <th scope="col">OBS.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            @endif
                                        <tr>
                                            <th scope="row">{{$cont}}</th>
                                            <td>{{grado_nombre_completo($dest_nov->user_id)}}</td>
                                            <td>{{$dest_nov->desde}}</td>
                                            <td>{{$dest_nov->hasta}}</td>
                                            <td>{{$dest_nov->obs}}</td>
                                        </tr>
                        @endif
                    @endforeach
                                </tbody>
                            </table>
                @endforeach
                <br>
        @endforeach
    @endif
        <a href="{{route('unidads.index')}}" class="btn btn-secondary">RETORNAR</a>
@endsection