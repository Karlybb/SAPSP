
@extends('plantillas/nav')

@section('content')

    @if($datos != null)
        <div style="margin-left:10%; margin-right: 10%; margin-top: 10%">
            <table id="tabladt" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Hora Inicio</th>
                        <th>Hora Inicio Pausa</th>
                        <th>Hora Fin Pausa</th>
                        <th>Hora Final</th>
                        <th>Total Horas</th>
                    </tr>
                </thead>
                <tbody>
                    
                        @foreach($datos as $ob)
                    
                    <tr >
                        <td>{{$ob->folio}}</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}}</td>
                        @if( $ob->folio == 'CA0000000029')
                        <td>-----------------------</td>
                        @else
                        <td>asfdas</td>
                        @endif
                        <td>$320,800</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                    <tr>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12</td>
                        <td>$86,000</td>
                    </tr>
                   
                </tbody>
                <tfoot>
                    <tr>
                        <th>Usuario</th>
                        <th>Hora Inicio</th>
                        <th>Hora Inicio Pausa</th>
                        <th>Hora Fin Pausa</th>
                        <th>Hora Final</th>
                        <th>Total Horas</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <h1>No hay datos.</h1>
    @endif
        

      
@endsection