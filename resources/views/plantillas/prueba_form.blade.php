@extends('plantillas/nav')

@section('content')

    <h1>Pruebas</h1>

    @if($seccion == 1)

        <form action="{{route('formprueba')}}" method="post" autocomplete="off" class="row g-2"> 
                @csrf

            <div class="col-md-3">
                <span class="glyphicon glyphicon-user"></span>
                <label for="validationDefault02" class="form-label">P. nombre:</label>
                <input type="text" name="nombre1" maxlength="30" pattern="[A-Z\s]+{30}" class="form-control upper" id="limpiartexto1" onkeyup="this.value = this.value.toUpperCase();" required/>
                @error('nombre1')
                    <small><b>*{{$message}}</b></small>
                @enderror
            </div>


            <div id="separacion">
                <div class="col-12" align="center">
                    <button class="btn btn-primary" type="submit">CONFIRMAR CAMBIOS</button>
                </div>
            </div>

        </form>

    @endif



@endsection