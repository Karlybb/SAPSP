<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA_Compatible" content="ie=edge">
        <title>Credenciales</title>

        <style type="text/css">
            .correo{ margin-left: 20%;
                     margin-right: 20%;}
        </style>
    </head>

    <body>
        <div class="correo">
            <h1 align="center">Sistema SAPSP</h1>
            <br>
            <h4>Asignacion de Credenciales</h4>

            <br>
            <p>Estimado(a): <b>{{$datos['nombre']}}</b>.</p>

            <p>Se envian las credenciales para accesar al sistema SAPSP, as&iacute; mismo en la plataforma se encuentra el manual de usuario para que pueda operar el sistema de la forma adecuada.</p><br>

            <p><b>URL: </b><a href="https://catgem.edomex.gob.mx/">Sistema SAPSP</a></p>
            <p><b>Usuario: </b>{{$datos['email']}}</p>
            <p><b>Contraseña: </b>{{$datos['pass']}}</p>

            <br>
            <p>Sin m&aacute;s por el momento reciba un cordial saludo de parte del del &Aacute;rea de Telefon&iacute;a Inform&aacute;tica del CATGEM.</p>

            <br>
            <p><a href="https://catgem.edomex.gob.mx/">Conoce la Pol&iacute;tica del CATGEM</a></p>
        </div>
        
    </body>

</html>