<!doctype html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body style="font-family: sans-serif;">
    <div style="display: block; margin: auto; max-width: 600px;" class="main">
      <h1 style="font-size: 18px; font-weight: bold; margin-top: 20px">Solicitud de cancelación autorizada</h1>
      <p>Tu solicitud de videoconferencia ha sido cancelada.</p>
      <ul style="padding-left: 10px;">
        <li style="color: purple;"><b>Código:</b> VSSM-{{$conferencia->id}}</li>
      	<li><b>Conferencia:</b> {{$conferencia->nombre}}</li>
      	<li><b>Fecha:</b> {{$conferencia->feini}}/{{$conferencia->fefin}}</li>
      </ul>
      <img alt="Inspect with Tabs" src="https://www.ssm.gob.mx/portal/img/ssm_logo_OK.png" style="width: 50%;">
      <p>© Servicios de Salud Morelos</p>
    </div>
  </body>
</html>