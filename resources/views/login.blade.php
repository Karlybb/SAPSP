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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  


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
      background-color: rgba(255, 255, 255, 0.1);
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
    input#pwd{
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    line-height: 1.42857143;
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

    .alert-danger{
    background-color: #F13535 !important;
    color: white !important;
    border: none;
    border-radius: 15px;
    padding: 9px;
}

form i {
      
      margin-left:-30px;
            
        }

    
    
    

  </style>

</head>
<body>
  <!--- FORMULARIO PRINCIPAL PARA INICIO DE SESIÓN --->

<div class="container log">

    
    <form action="{{route('login')}}" method="post" autocomplete="off">
      
    @csrf
      

      <div class="col-md-2 center">
        

          <h1 class="title">Sistema de Actualización <br>  de Personas Servidoras <br>Públicas</h1>
          <div class="subtitle">
            <span>Inicio de Sesión</span>
          </div>
          <br>

          <div class="inputs">

            <div class="form-group campo">
             

              <!--<label for="email">Usuario:</label>-->
              <input type="email" name="email" value="{{old('email')}}"
                    class="form-control" id="email" title="Ingresa tu usuario con el que fuiste dado de alta en el sistema SAPSP."
                    placeholder="Usuario" 
                    required>
                  
                    
                    

                    
            </div>
                      
            
            <!--
            <div class="form-group campo">
              <label for="pwd">Contraseña:</label>
              <input type="password" name ="pass"  class="form-control" id="pwd" 
                     title="Ingresa tu contraseña con el que fuiste dado de alta en el sistema SAPSP." placeholder="Contraseña">

                 


               @error('pass')
              <div class="alert alert-danger text-center m-2">
                <span>{{$message}}</span>
              </div>
              @enderror
              
            </div>   -->


            
            <div class="form-group campo">
              
              
              
              <input type="password"  name ="pass" id="pwd"  title="Ingresa tu contraseña con el que fuiste dado de alta en el sistema SAPSP." placeholder="Contraseña" required> 
              <i class="bi bi-eye-slash"  id="togglePassword"></i>
              
              

            </div>

            <script>
              const togglePassword = document
                  .querySelector('#togglePassword');
        
              const password = document.querySelector('#pwd');
        
              togglePassword.addEventListener('click', () => {
        
                  
                  const type = password
                      .getAttribute('type') === 'password' ?
                      'text' : 'password';
                        
                  password.setAttribute('type', type);
        
                  this.classList.toggle('bi-eye');
              });
          </script>

             
           
          </div>


          <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

          <div id="button"class="text-center m-2">
            <button type="success">INGRESAR</button>
          </div>

          <br>

          @if(session('msj'))
          <div class="alert alert-danger text-center m-2">
            <span>{{session('msj')}}</span>
          </div>
          @endif
        

      </div>

  </form>

</div>

</body> 
</html>