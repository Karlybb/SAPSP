<!DOCTYPE html>
<html>
<head>
  <title>ACCESO AL SISTEMA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' cdn.jsdelivr.net cdn.datatables.net maxcdn.bootstrapcdn.com ajax.googleapis.com 'unsafe-inline'">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <link rel="icon" href="{{ asset('/public/img/escudoedomex.png') }}" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" crossorigin="anonymous">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

  <style type="text/css">

  @import url('https://fonts.googleapis.com/css2?family=Albert+Sans:wght@100;200;300;400;600;800&family=Nunito+Sans:wght@300;400;600;900&family=Work+Sans:wght@400;600;700&display=swap');

  * {
      font-family: 'Albert Sans', sans-serif;
      font-style: normal;
  }

    body{
        background-image: url({{url('/public/img/loginimg4.jpg')}});
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: rgb(204, 209, 209);
    }

    button{
        height: auto;
        color: #FFFFFF;
        background-color: #646464;
        border: none;
        border-radius: 14px;
        font-size: 1.8rem;
        font-weight: 400;
        padding: 5px 15px;
    }

    button:hover{
        background-color: transparent;
        border: #646464 solid 2px;
        color: #000000;
        font-weight: 400;
    }
    .log{
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }
    .center {
      width: auto;
      border-radius: 25px;
      background-color: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(5px);
      padding: 4rem 6rem;
      box-shadow: 3px 13px 82px -10px rgb(58, 58, 58);
    }

    input{
      background-color: #ffffff !important;
      border-radius: 15px !important;
      color: #000000 !important;
      border: none !important;

    }

    input::placeholder{
      color: #646464 !important;
    }

    .campo{
      margin-bottom: 2rem;
      padding: 5px;
    }

    .title{
      color: #ffffff;
      font-size: 2.8rem;
      font-weight: 600 !important;
      text-align: center;
    }

    .subtitle{
      color: #ffffff;
      text-align: center;
      font-weight: 500;
      margin-top: 2.5rem !important;
      margin-bottom: 3rem !important;
      font-size: 1.8rem;
    }

  </style>

</head>
<body>

<div class="container log">

    <form action="{{route('consul')}}" method="post" autocomplete="off">
      @csrf

      <div class="col-md-2 center">

          <h1 class="title">Sistema de Actualización <br>  de Personas Servidoras <br>Públicas</h1>
          <div class="subtitle">
            <span>Inicio de Sesión</span>
          </div>
          <br>

          <div class="inputs">

            <div class="form-group campo">
              <!--<label for="usua">Usuario:</label>-->
              <input type="password" name="usua" maxlength="30" value="{{old('usua')}}"
                    class="form-control" id="usua" title="Ingresa tu usuario con el que fuiste dado de alta en el sistema SAPSP."
                    placeholder="Usuario" required>
              @error('usua')
                <small><b>* {{$message}}</b></small>
              @enderror
            </div>

            <div class="form-group campo">
              <!--<label for="pwd">Contraseña:</label>-->
              <input type="password" name ="contr" maxlength="10" value="{{old('contr')}}" class="form-control" id="pwd" title="Ingresa tu contraseña con el que fuiste dado de alta en el sistema SAPSP." placeholder="Contraseña" required>
              @error('contr')
                <small><b>* {{$message}}</b></small>
              @enderror
            </div>
          </div>


          <input type="hidden" name="_token" value="{{ csrf_token() }}" />

          <div id="button" align="center">
            <br>
            <button type="success">INGRESAR</button>
          </div>

      </div>

  </form>

</div>

</body> 
</html>