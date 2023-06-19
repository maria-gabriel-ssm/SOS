<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Formato - Solicitud de Videoconferencia</title>
<style>
/* Estilos de etiqueta*/
@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

*{
  font-family: "Poppins", sans-serif;
}

body {
  color: rgba(70,70,72,255);
  border-radius: 10px;
  padding: .5rem;
}

table {
  /*background: white;*/
  width: 100%;
  margin: 0 auto;
  border-collapse: collapse;
  font-size: 9pt;
}

th {
  height: 35px;
  /*border-bottom: 1px solid rgb(210, 220, 250);
  color: rgb(120, 120, 120);*/
}

td {
  width: 25%;
  padding: 0px 10px 0px 10px;
  height: 30px;
  /*border: 0.1px solid rgba(240, 240, 240, 10);*/
}

tfoot {
  font-weight: bold;
}

.cabecera {
  width: 94%;
  height: auto;
  padding: 1em;
  padding-bottom: 0px;
  font-size: 13pt;
  font-weight: bold;
}

.titulo{
    padding-left: 10px;
    float: right;
}

a{
  text-decoration: none;
  color: white;
  font-size: 13pt;
}

hr.hr-1 {
  border: 0;
  height: 7px;
  border-top: 2px solid lavender;
}

.bg-white{
    background-color: ghostwhite;
    border-radius: 5px;
}

.h-50{
    height: 120px;
    color: lavender;
}

.center{
    text-align: center;
}

.small{
    font-size: 9pt;
    font-weight: normal;
    text-align: right;
    color: #5B5B5F;
}

.name{
    color: #5B5B5F;
    font-weight: normal;
}

.justify{
    text-align: justify;
    background-color: ghostwhite;
    border-radius: 5px;
}

.td-title{
    background-color: #6A3E8C;
    color: white;
    font-weight: bold;
    font-size: 10pt;
    border-radius: 5px;
}

.border-top{
    border: 0;
    height: 5px;
    border-top: 1px solid lavender;
}
/*
footer {
  margin-top: 40px;
  text-align: center;
}*/
</style>
</head>
<body>
<header class="cabecera">
  <img src="{{ $logo }}" width="150">
  <span class="titulo">Formato de solicitud de videoconferencia <br><p class="small">VSSM-{{$conferencia->id}}
</p></span>
</header>
<hr class="hr-1">
<table>
  <tbody>
    <tr class="center">
      <td class="bg-white"><b>Folio:</b> OC/{{$conferencia->id ?? 'XX'}}</td>
      <td></td>
      <td></td>
      <td class="bg-white"><b>{{$conferencia->updated_at->format('d/m/Y')}}</b></td>
    </tr>
    <td colspan="4"></td>
    <tr>
      <td class="td-title">Datos del solicitante</td>
      <td colspan="3"></td>
    </tr><br>
    <tr class="bg-white">
      <td colspan="2"><b>Nombre: </b> {{$conferencia->usuario->nombreCompleto ?? 'Sin Asignar'}} ({{$conferencia->cargo ?? 'NA'}})</td>
      <td></td>
      <td class="center"><b>{{$conferencia->usuario->username ?? 'Sin Asignar'}} </b> </td>
    </tr>
    <tr class="bg-white">
      <td colspan="4"><b>Dirección: </b> {{$conferencia->direcciones->nombre ?? 'Sin Asignar'}}<br>
      <b>Subdirección: </b> {{$conferencia->subdirecciones->nombre ?? 'Sin Asignar'}}<br>
      <b>Departamento: </b> {{$conferencia->departamentos->nombre ?? 'Sin Asignar'}}
    </td>
    </tr>
    <tr class="bg-white">
      <td colspan="4"><b>Ext: </b> {{$conferencia->usuario->telefono ?? 'Sin Asignar'}} <b>&nbsp;Celular: </b> {{$conferencia->celular ?? 'Sin Asignar'}}</td>
    </tr>
    <td colspan="4"><hr class="hr-1"></td>
    <tr>
      <td class="td-title">Datos de la videoconferencia</td>
      <td colspan="3"></td>
    </tr><br>
    <tr class="bg-white">
      <td colspan="2"><b>Nombre del evento: </b> {{$conferencia->nombre ?? 'Sin Asignar'}}</td>
      <td></td>
      <td class="center"><b>Tipo:</b> {{$conferencia->tipo ?? 'Sin Asignar'}} </td>
    </tr>
    <tr class="bg-white">
      <td colspan="3"><b>Sede emisora: </b> {{$conferencia->sedes->nombre ?? 'Sin Asignar'}}<br><b>Lugar de emisión: </b> {{$conferencia->emision ?? 'Sin Asignar'}}</td>
      <td class="center"></td>
    </tr>
    <!-- <tr class="bg-white">
      <td colspan="4"><b>Tipo de equipo: </b> {{$conferencia->equipos->equipo ?? 'Sin Asignar'}}</td>
    </tr> -->
    <tr class="bg-white">
      <td colspan="4" class="justify"><b>Inico: </b> {{$conferencia->feini ?? 'Sin Asignar'}}
      <b>   Fin: </b> {{$conferencia->fefin ?? 'Sin Asignar'}}<br></td>
    </tr>
    <td colspan="4"><hr class="hr-1"></td>
    <tr>
      <td class="td-title" colspan="2">Terminos y condiciones</td>
      <td colspan="2"></td>
    </tr><br>
    <tr>
      <td colspan="4" class="justify">
        <span>
            <br>Al firmar este documento usted acepta de conformidad lo siguiente:
            <ul style="padding-left: 10px;">
            <li><b>Nota 1:</b> Únicamente están autorizados a solicitar videoconferencias, directores(as), subdirectores(as), jefes(as) de departamento, coordinadores(as), responsables de programa. </li><br>
            <li><b>Nota 2:</b> En caso de cancelación favor de notificar al responsable de videconferencias al tel. 777 362 2370 ext.IP 5505 o bien, solicitar cancelación a través del sistema.</li><br>
            <li><b>Nota 3:</b> El solicitante de la videoconferencia deberá enviar al responsable de videconferencia las listas de asistencia en forma digital de todos los participantes de la sesión.</li>
            </ul><br>
        </span>
        </td>
    </tr>
    <tr class="bg-white center">
      <td colspan="2"><b>Firma del solicitante </b></td>
      <td colspan="2"><b>Firma departamento </b></td>
    </tr>
    <tr class="bg-white center">
      <td colspan="2" class="h-50"><b>___________________________<br><span class="name">{{$conferencia->usuario->nombreCompleto ?? 'Sin Asignar'}}</span></b></td>
      <td colspan="2" class="h-50"><b>___________________________<br><span class="name">Sello del área y firma Director(as), subdirector(as), jefe(a) de departamento</span> </b></td>
    </tr>
    <td colspan="4"><hr class="hr-1"></td>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="2"></td>
      <td></td>
      <td></td>
    </tr>
  </tfoot>
</table>
</body>
</html>