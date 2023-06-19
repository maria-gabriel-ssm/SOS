
@extends('layouts.plantilla')

@section('content')
<style type="text/css">
  .form-white, .select2-selection{
    background-color: white!important;
    color: #333;
  }
  #user_age_handler_min, #user_age_handler_max {
    width: 3em;
    margin-left: -1.5em;
    height: 1.6em;
    top: 50%;
    margin-top: -.8em;
    text-align: center;
    line-height: 1.6em;
  }

    .form-gray{
        background-color: #f0f2f5 !important;
        border: none !important;
    }

.rating {
  display: flex;
  width: 100%;
  justify-content: center;
  overflow: hidden;
  flex-direction: row-reverse;
  position: relative;
}

.rating-0 {
  filter: grayscale(100%);
}

.rating > input {
  display: none;
}

.rating > label {
  cursor: pointer;
  width: 40px;
  height: 40px;
  margin-top: auto;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: center;
  background-size: 76%;
  transition: .3s;
}

.rating > input:checked ~ label,
.rating > input:checked ~ label ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}


.rating > input:not(:checked) ~ label:hover,
.rating > input:not(:checked) ~ label:hover ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}

#rating-1:checked ~ .emoji-wrapper > .emoji { transform: translateY(-100px); }
#rating-2:checked ~ .emoji-wrapper > .emoji { transform: translateY(-200px); }
#rating-3:checked ~ .emoji-wrapper > .emoji { transform: translateY(-300px); }
#rating-4:checked ~ .emoji-wrapper > .emoji { transform: translateY(-400px); }
#rating-5:checked ~ .emoji-wrapper > .emoji { transform: translateY(-500px); }


</style>

<div class="container-fluid card p-4">
  <h5>Operatividad general del sistema</h5>
  <div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <a href="{{ url('expediente') }}"><div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">assignment</i>
          </div></a>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize text-bold">Ordenes finalizadas</p>
            <h4 class="mb-0">{{$total['finalizadas']}}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2">
          <p class="mb-0"><span class="text-primary text-sm font-weight-bolder">+{{$total['pendientes']}} </span>pendientes</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <a href="{{ url('admins') }}"><div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">verified_user</i>
          </div></a>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize text-bold">Usuarios de soporte</p>
            <h4 class="mb-0">{{$usuarios['tecnicos']}}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2">
          <p class="mb-0"><span class="text-dark text-sm font-weight-bolder">+{{$usuarios['administradores']}} </span>administradores</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <a href="{{ url('usuarios') }}"><div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">person</i>
          </div></a>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize text-bold">Usuarios registrados</p>
            <h4 class="mb-0">{{$usuarios['normales']}}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2">
          <p class="mb-0"><span class="text-info text-sm font-weight-bolder">+{{$usuarios['nuevos']}} </span> esta semana</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">home_work</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize text-bold">Áreas solventadas</p>
            <h4 class="mb-0">{{$total['sustentadas']}}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2">
          <p class="mb-0">de <span class="text-success text-sm font-weight-bolder">{{$total['areas']}}</span> áreas registradas</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <h5 class="mb-3">Reporte semanal automático</h5>
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card z-index-2 ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 ">Servicios finalizados en la semana</h6>
          <p class="text-sm ">Ordenes realizadas en los últimos 5 días hábiles</p>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto me-1">storage</i>
            <p class="mb-0 text-sm"> {{$total['semanales']}} registros</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card z-index-2  ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 "> Servicios realizados por técnico </h6>
          <p class="text-sm ">Ordenes realizadas por los técnicos (ID Técnico)<span class="font-weight-bolder"></span></p>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto me-1">storage</i>
            <p class="mb-0 text-sm"> {{$total['tecnicos']}} técnicos </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mt-4 mb-3">
      <div class="card z-index-2 ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 ">Usuarios registrados en la semana</h6>
          <p class="text-sm ">Nuevos usuarios en los últimos 5 días hábiles</p>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto me-1">storage</i>
            <p class="mb-0 text-sm">{{$usuarios['nuevos']}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <h5 class="mb-3">Seguimiento de órdenes pendientes</h5>
    <div class="col-lg-4 col-md-4 mt-4 mb-4">
      <div class="card z-index-2">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="border-radius-lg py-3 pe-1">
            <div class="chart chart-size col-10 offset-1">
              <canvas id="totales" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 "> Estado del total de órdenes </h6>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-md my-auto me-1">notifications</i>
            <p class="mb-0 text-sm" id="total_total"></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 mt-4 mb-4">
      <div class="card z-index-2">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="border-radius-lg py-3 pe-1">
            <div class="chart chart-size col-10 offset-1">
              <canvas id="prioridad" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 "> Prioridad de órdenes pendientes </h6>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-md my-auto me-1">access_time</i>
            <p class="mb-0 text-sm" id="prioridad_total"></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 mt-4 mb-4">
      <div class="card z-index-2">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="border-radius-lg py-3 pe-1">
            <div class="chart chart-size col-10 offset-1">
              <canvas id="comentarios" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 "> Seguimientos de órdenes pendientes </h6>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-md my-auto me-1">send</i>
            <p class="mb-0 text-sm" id="seguimiento_total"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <h5>Reporte manual</h5>
    <div class="row mt-5">
      <div class="col-lg-2 col-md-2 col-sm-12 card-size">
        <div class="card form-gray" style="margin-top: -1.25rem;">
          <div class="card-body px-3 py-4">
            <h6>Filtrar por:</h6>
            <form id="filter" method="GET" autocomplete="off">
              <fieldset class="form-group">
              <div class="row">
                <div class="col-sm-10">
                  <div class="form-check p-0">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                    <label class="form-check-label" for="gridRadios1">
                      Técnicos
                    </label>
                  </div>
                  <div class="form-check p-0">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                      Tareas
                    </label>
                  </div>
                  <div class="form-check p-0">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                    <label class="form-check-label" for="gridRadios3">
                      Areas
                    </label>
                  </div>
                  <div class="form-check p-0">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="option4">
                    <label class="form-check-label" for="gridRadios4">
                      Usuarios
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
            <hr class="dark horizontal bg-gradient-dark">
              <div class="form-group">
                <span class="custom-control-description text-sm">Fecha</span>
                {!! Form::text('datefilter','',array('class' => 'form-control form-white px-2 py-2', 'placeholder'=>'Seleccione un rango de fechas', ''))!!}
              </div>
              <div class="form-group" id="div_tar">
                <span class="custom-control-description text-sm">Tipo de tarea</span>
                {{ Form::select('tarea', $cat_tarea, '', ['class' => 'form-control form-white','id'=>'cat_tarea','placeholder'=>'Seleccione una tarea',''])}}
              </div>
              <div class="form-group" id="div_are">
                <span class="custom-control-description text-sm">Área</span>
                {{ Form::select('area', $cat_area, '', ['class' => 'form-control form-white','id'=>'cat_area','placeholder'=>'Seleccione una área',''])}}
              </div>
              <div class="form-group">
                <span class="custom-control-description text-sm">Tipo de equipo</span>
                {{ Form::select('equipo', $cat_equipo, '', ['class' => 'form-control form-white','id'=>'cat_equipo','placeholder'=>'Seleccione un equipo',''])}}
              </div>
              <div class="form-group d-none" id="div_tec">
                <span class="custom-control-description text-sm">Técnico</span>
                {{ Form::select('tecnico', $cat_tecnico, '', ['class' => 'form-control form-white','id'=>'cat_tecnico','placeholder'=>'Seleccione un técnico',''])}}
              </div>
              <div class="form-group" id="rating">
                <span class="custom-control-description text-sm">Calificación</span>
                <div class="rating py-1">
                    <input type="radio" name="rating5" id="rating-5">
                      <label for="rating-5"></label>
                      <input type="radio" name="rating4" id="rating-4">
                      <label for="rating-4"></label>
                      <input type="radio" name="rating3" id="rating-3">
                      <label for="rating-3"></label>
                      <input type="radio" name="rating2" id="rating-2">
                      <label for="rating-2"></label>
                      <input type="radio" name="rating1" id="rating-1">
                      <label for="rating-1"></label>
                    </div>
              </div>
              <div id="alert2" class="row justify-content-center mt-4">
                <div class="col-3">
                  <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                <span class="text-xs text-center text-primary">Cargando...</span>
              </div>
              <div class="form-group mb-0">
                <button id="get_graphics" type="button" class="btn btn-block btn-primary mb-1 invisible">Generar</button>
                <button id="limpiar" type="button" class="btn btn-block btn-dark">Limpiar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-12 card-size-2">
        <div class="card z-index-2  ">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="form-gray border-radius-lg py-3 pe-1">
              <div class="chart">
                <canvas id="tecnicos" class="chart-canvas"></canvas>
                <canvas id="tareas" class="chart-canvas d-none"></canvas>
                <canvas id="areas" class="chart-canvas d-none"></canvas>
                <canvas id="usuarios" class="chart-canvas d-none"></canvas>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="mb-0" id="reporte_name"></h6>
            <hr class="dark horizontal">
            <div class="d-flex ">
              <i class="material-icons text-sm my-auto me-1">storage</i>
              <p class="mb-0 text-sm mr-2" id="reporte_total"> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><br>

<script type="text/javascript" src="{{ URL::asset('js/table.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

<script type="text/javascript">

$("#titulo").text('Dashboard');
    let array_ordenes = @json($total, JSON_PRETTY_PRINT);
    let array_priori = @json($prioridad, JSON_PRETTY_PRINT);
    let array_tecnicos = @json($tecnico, JSON_PRETTY_PRINT);
    console.log(array_tecnicos);

    let graf_tecnicos = document.getElementById('tecnicos').getContext('2d');
    let graf_tareas = document.getElementById('tareas').getContext('2d');
    let graf_areas = document.getElementById('areas').getContext('2d');
    let graf_usuarios = document.getElementById('usuarios').getContext('2d');

    var colores = ['rgba(73, 163, 241, 0.9)','rgba(106, 62, 140, 0.9)','rgba(102, 187, 106, 0.9)','rgba(66, 66, 74, 0.9)','rgba(73, 163, 241, 0.9)','rgba(106, 62, 140, 0.9)','rgba(102, 187, 106, 0.9)','rgba(66, 66, 74, 0.9)','rgba(73, 163, 241, 0.9)','rgba(106, 62, 140, 0.9)','rgba(102, 187, 106, 0.9)','rgba(66, 66, 74, 0.9)','rgba(73, 163, 241, 0.9)','rgba(106, 62, 140, 0.9)','rgba(102, 187, 106, 0.9)','rgba(66, 66, 74, 0.9)','rgba(73, 163, 241, 0.9)','rgba(106, 62, 140, 0.9)','rgba(102, 187, 106, 0.9)','rgba(66, 66, 74, 0.9)','rgba(73, 163, 241, 0.9)','rgba(106, 62, 140, 0.9)','rgba(102, 187, 106, 0.9)','rgba(66, 66, 74, 0.9)','rgba(73, 163, 241, 0.9)','rgba(106, 62, 140, 0.9)','rgba(102, 187, 106, 0.9)','rgba(66, 66, 74, 0.9)','rgba(73, 163, 241, 0.9)','rgba(106, 62, 140, 0.9)','rgba(102, 187, 106, 0.9)','rgba(66, 66, 74, 0.9)'];
    var bordes = ['rgb(73, 163, 241)','rgba(106, 62, 140)','rgba(102, 187, 106, 1)','rgba(66, 66, 74)','rgb(73, 163, 241)','rgba(106, 62, 140)','rgba(102, 187, 106, 1)','rgba(66, 66, 74)','rgb(73, 163, 241)','rgba(106, 62, 140)','rgba(102, 187, 106, 1)','rgba(66, 66, 74)','rgb(73, 163, 241)','rgba(106, 62, 140)','rgba(102, 187, 106, 1)','rgba(66, 66, 74)','rgb(73, 163, 241)','rgba(106, 62, 140)','rgba(102, 187, 106, 1)','rgba(66, 66, 74)','rgb(73, 163, 241)','rgba(106, 62, 140)','rgba(102, 187, 106, 1)','rgba(66, 66, 74)','rgb(73, 163, 241)','rgba(106, 62, 140)','rgba(102, 187, 106, 1)','rgba(66, 66, 74)','rgb(73, 163, 241)','rgba(106, 62, 140)','rgba(102, 187, 106, 1)','rgba(66, 66, 74)'];

  $(function(){
    $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });

    $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      fchIni = picker.startDate.format('MM/DD/YYYY');
      fchFin = picker.endDate.format('MM/DD/YYYY');
      $("#get_graphics").click();
      console.log('Un nuevo rango fue seleccionado: ' + fchIni + ' to ' + fchFin);
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      fchIni = 0;
      fchFin = 0;
      $(this).val('');
    });

    $('#limpiar').on('click',function(){
      fchIni = 0;
      fchFin = 0;
      tarea = 0;
      area = 0;
      equipo = 0;
      filtro = 0;
      estrellas = 0;
      usuarios = 0;
      tecnico = 0;
      $("#rating-1").prop('checked', false);
      $("#rating-2").prop('checked', false);
      $("#rating-3").prop('checked', false);
      $("#rating-4").prop('checked', false);
      $("#rating-5").prop('checked', false);
      $('#cat_tarea').val('').change();
      $('#cat_area').val('').change();
      $('#cat_equipo').val('').change();
      $('#cat_tecnico').val('').change();
      $('input[name="datefilter"]').val('');
    });

    $(".cancelBtn").on('click',function(){
      fchIni = 0;
      fchFin = 0;
      $("#get_graphics").click();
    });
    $("#cat_tarea").on('change',function(){ 
     tarea = (this.value);
     $("#get_graphics").click();
    });
    $("#cat_area").on('change',function(){ 
     area = (this.value);
     $("#get_graphics").click();
    });
    $("#cat_equipo").on('change',function(){ 
     equipo = (this.value);
     $("#get_graphics").click();
    });
    $("#cat_tecnico").on('change',function(){ 
     tecnico = (this.value);
     $("#get_graphics").click();
    });

    $("#gridRadios1").on('change',function(){
        filtro = 0;
        tecnico = 0;
        $('#cat_tecnico').val('').change();
        $('#tareas, #areas, #usuarios, #div_tec').addClass('d-none');
        $("#tecnicos, #rating, #div_tar, #div_are").removeClass('d-none');
        $("#get_graphics").click();
    });
    $("#gridRadios2").on('change',function(){ 
        filtro = 1;
        tarea = 0;
        $('#cat_tarea').val('').change();
        $('#tecnicos, #areas, #usuarios, #rating, #div_tar').addClass('d-none');
        $("#tareas, #div_tec, #div_are").removeClass('d-none');
        $("#get_graphics").click();
    });
    $("#gridRadios3").on('change',function(){ 
        filtro = 2;
        area = 0;
        $('#cat_area').val('').change();
        $('#tecnicos, #tareas, #usuarios, #rating, #div_are').addClass('d-none');
        $("#areas, #div_tec, #div_tar").removeClass('d-none');
        $("#get_graphics").click();
    });
    $("#gridRadios4").on('change',function(){ 
        filtro = 3;
        usuarios = 0;
        $("#get_graphics").click();
        $('#tecnicos, #tareas, #areas, #rating').addClass('d-none');
        $("#usuarios, #div_tec, #div_tar, #div_are").removeClass('d-none');
        $("#get_graphics").click();
    });

    $("#rating-1").on('click',function(){
      estrellas = 1;
      $("#rating-2").prop('checked', false);
      $("#rating-3").prop('checked', false);
      $("#rating-4").prop('checked', false);
      $("#rating-5").prop('checked', false);
      $("#get_graphics").click();
    });
    $("#rating-2").on('click',function(){
      estrellas = 2;
      $("#rating-3").prop('checked', false);
      $("#rating-4").prop('checked', false);
      $("#rating-5").prop('checked', false);
      $("#get_graphics").click();
    });
    $("#rating-3").on('click',function(){
      estrellas = 3;
      $("#rating-4").prop('checked', false);
      $("#rating-5").prop('checked', false);
      $("#get_graphics").click();
    });
    $("#rating-4").on('click',function(){
      estrellas = 4;
      $("#rating-4").prop('checked', true);
      $("#get_graphics").click();
    });
    $("#rating-5").on('click',function(){
      estrellas = 5;
      $("#rating-5").prop('checked', true);
      $("#get_graphics").click();
    });

    $("#get_graphics").on('click',function(){
      $('#alert2').show();
      $.ajax({
      url: 'tecnicos',
        method:'POST',
        dataType: "json",
        data: {
          "_token": $("meta[name='csrf-token']").attr("content"),
          "fchIni": fchIni,
          "fchFin": fchFin,
          "tarea": tarea,
          "area": area,
          "equipo": equipo,
          "filtro": filtro,
          "tecnico": tecnico,
          "estrellas": estrellas,
          "usuarios": usuarios,
        },
        async: false,
        success: function (respuesta) {
          console.log(respuesta);

          if(respuesta['total'] > 0){
            if(filtro==3){
              $("#reporte_total").text("Registros: "+respuesta['total2']);
            }else{
              $("#reporte_total").text("Registros: "+respuesta['total']);
            }
            $("#reporte_name").text("Reporte de órdenes finalizadas");
            var tamanio = 10;
            if(respuesta['total'] < 150){
              tamanio = 1;
            }
            var options = {
                legend: {
                  display: false,
                },
                plugins: {
                  datalabels: {
                    color: "rgba(255, 255, 255, .9)",
                  }
                },
                scales: {
                  xAxes: [
                  {
                    ticks: {
                      beginAtZero: true,
                    },
                  },
                  ],
                  yAxes: [
                  {
                    ticks: {
                      stepSize: tamanio,
                      beginAtZero: true,
                    },
                  },
                  ],
                },
              }

            if(estrellas !=0){
              var data_tecnicos = {
              labels: Object.keys(respuesta['tecnicos']),
              datasets: [{
                label: 'Ordenes',
                data: Object.values(respuesta['tecnicos']),
                backgroundColor: colores,
                borderColor: bordes,
                borderWidth: 1,
              },
              {
                label: estrellas+' estrella(s)',
                data: Object.values(respuesta['estrellas']),
                backgroundColor: colores,
                borderColor: bordes,
                borderWidth: 1,
              }]
            };
            }else{
              var data_tecnicos = {
              labels: Object.keys(respuesta['tecnicos']),
              datasets: [{
                label: 'Ordenes',
                data: Object.values(respuesta['tecnicos']),
                backgroundColor: colores,
                borderColor: bordes,
                borderWidth: 1,
              },
              {
                label: 'Total estrellas',
                data: Object.values(respuesta['evaluacion']),
                backgroundColor: colores,
                borderColor: bordes,
                borderWidth: 1,
              }]
            };
            }
              
            if (window.ctx_tecnicos) {
              window.ctx_tecnicos.clear();
              window.ctx_tecnicos.destroy();
            }
            window.ctx_tecnicos = new Chart(graf_tecnicos, {
              type: 'bar',
              data: data_tecnicos,
              options: options,
            });

            var data_tareas = {
            labels: Object.keys(respuesta['tareas']),
            datasets: [{
              label: 'Ordenes',
              axis: 'y',
              data: Object.values(respuesta['tareas']),
              backgroundColor: colores,
              borderColor: bordes,
              borderWidth: 1,
            }]
          };
          if (window.ctx_tareas) {
            window.ctx_tareas.clear();
            window.ctx_tareas.destroy();
          }
          window.ctx_tareas = new Chart(graf_tareas, {
            type: 'horizontalBar',
            data: data_tareas,
            options: options,
          });

          var data_areas = {
              labels: Object.keys(respuesta['areas']),
              datasets: [{
                label: 'Ordenes',
                axis: 'y',
                data: Object.values(respuesta['areas']),
                backgroundColor: colores,
                borderColor: bordes,
                borderWidth: 1,
              }]
            };
            if (window.ctx_areas) {
              window.ctx_areas.clear();
              window.ctx_areas.destroy();
            }
            window.ctx_areas = new Chart(graf_areas, {
              type: 'horizontalBar',
              data: data_areas,
              options: options,
            });

            var data_usuarios = {
            labels: Object.keys(respuesta['usuarios']),
            datasets: [{
              label: 'Ordenes',
              axis: 'y',
              data: Object.values(respuesta['usuarios']),
              backgroundColor: colores,
              borderColor: bordes,
              borderWidth: 1,
            }]
          };
          if (window.ctx_usuarios) {
            window.ctx_usuarios.clear();
            window.ctx_usuarios.destroy();
          }
          window.ctx_usuarios = new Chart(graf_usuarios, {
            type: 'horizontalBar',
            data: data_usuarios,
            options: {
              tooltips: {
              callbacks: {
                label: function(tooltipItem) {
                  var res;
                  Object.entries(respuesta['nombres']).forEach(([key, value]) => {
                    if(tooltipItem.yLabel == key){
                    res = value+": "+tooltipItem.xLabel;
                    }
                  });
                  return res;
                }
              }
            },
                legend: {
                  display: false,
                },
                plugins: {
                  datalabels: {
                    color: "rgba(255, 255, 255, .9)",
                  }
                },
                scales: {
                  xAxes: [
                  {
                    ticks: {
                      beginAtZero: true,
                    },
                  },
                  ],
                  yAxes: [
                  {
                    ticks: {
                      stepSize: tamanio,
                      beginAtZero: true,
                    },
                  },
                  ],
                },
              }

          });

          }else{

            if (window.ctx_tecnicos) {
              window.ctx_tecnicos.clear();
              window.ctx_tecnicos.destroy();
            }
            window.ctx_tecnicos = new Chart(graf_tecnicos, {});
            if (window.ctx_tareas) {
              window.ctx_tareas.clear();
              window.ctx_tareas.destroy();
            }
            window.ctx_tareas = new Chart(graf_tareas, {});
            if (window.ctx_areas) {
              window.ctx_areas.clear();
              window.ctx_areas.destroy();
            }
            window.ctx_areas = new Chart(graf_areas, {});
            if (window.ctx_usuarios) {
              window.ctx_usuarios.clear();
              window.ctx_usuarios.destroy();
            }
            window.ctx_usuarios = new Chart(graf_usuarios, {});
            $("#reporte_name").click();
            $("#reporte_name").text("");
            $("#reporte_total").text("No se encontraron registros.");
          }
          
        },
        complete: function(){
        $('#alert2').hide();
        },
        error: function (respuesta) {
          console.log(respuesta);
        },
      });
    });

    carga_inicial(array_ordenes, array_priori, array_tecnicos);

  });

  function carga_inicial(array_ordenes, array_priori, array_tecnicos){

    let graf_totales = document.getElementById('totales').getContext('2d');
    let graf_priori = document.getElementById('prioridad').getContext('2d');
    let graf_commens = document.getElementById('comentarios').getContext('2d');

    var pen = array_ordenes['pendientes'];
    var fin = array_ordenes['finalizadas'];
    var suc = array_priori['success'];
    var war = array_priori['warning'];
    var dan = array_priori['danger'];
    var com = array_priori['commen'];

    $("#total_total").text(pen +" pendiente(s) y "+fin+" finalizadas");
    $("#prioridad_total").text(suc+" de hoy o hace un día y "+(war+dan)+ " de dos días o más");
    $("#seguimiento_total").text(com+" seguimiento(s) de "+pen);

    var data_totales = {
      labels: ['Pendientes','Finalizadas'],
      datasets: [{
        axis: 'y',
        label: '',
        data: [pen,fin],
        backgroundColor: colores,
        borderColor: bordes,
        borderWidth: 1,
      }]
    };
    if (window.ctx_totales) {
      window.ctx_totales.clear();
      window.ctx_totales.destroy();
    }
    window.ctx_totales = new Chart(graf_totales, {
      type: 'doughnut',
      data: data_totales,
      options: {
        plugins: {
          datalabels: {
            display: true,
            color: "rgba(255, 255, 255, .9)",
            formatter: (value, graf_priori) => {
              let percentage = (value * 100 / (fin + pen)).toFixed(2) + "%";
              return percentage;
            },
          },
        },
      },
    });

    const data_priori = {
      labels: [
      'Hoy o hace un día',
      'Hace dos días',
      'Hace más de dos'
      ],
      datasets: [{
        label: '',
        data: [suc, war, dan],
        backgroundColor: colores,
        borderColor: bordes,
        borderWidth: 1,
      }]
    };

    if (window.ctx_priori) {
      window.ctx_priori.clear();
      window.ctx_priori.destroy();
    }
    window.ctx_priori = new Chart(graf_priori, {
      type: 'pie',
      data: data_priori,
      options: {
        plugins: {
          datalabels: {
            display: true,
            color: "rgba(255, 255, 255, .9)",
            formatter: (value, graf_priori) => {
              let percentage = (value * 100 / pen).toFixed(2) + "%";
              return percentage;
            },
          },
        },
      },
    });

    const data_comen = {
      labels: [
      'Con seguimiento',
      'Sin seguimiento',
      ],
      datasets: [{
        label: '',
        data: [com, (pen-com)],
        backgroundColor: colores,
        borderColor: bordes,
        borderWidth: 1,
      }]
    };

    if (window.ctx_comen) {
      window.ctx_comen.clear();
      window.ctx_comen.destroy();
    }
    window.ctx_comen = new Chart(graf_commens, {
      type: 'pie',
      data: data_comen,
      options: {
        plugins: {
          datalabels: {
            display: true,
            color: "rgba(255, 255, 255, .9)",
            formatter: (value, graf_commens) => {
              let percentage = (value * 100 / pen).toFixed(2) + "%";
              return percentage;
            },
          },
        },
      },
    });

  }
</script>

<script>
  $("#cat_tecnico").select2({theme: 'bootstrap4', width:'100%'});
  var ctx = document.getElementById("chart-bars").getContext("2d");
  let array_semana = @json($semanal, JSON_PRETTY_PRINT);
  let array_semanaday = @json($semanalday, JSON_PRETTY_PRINT);
  let array_tecnicosem = @json($tecnicosem, JSON_PRETTY_PRINT);
  let array_users = @json($tecnico, JSON_PRETTY_PRINT);
  let array_nuevos = @json($nuevosem, JSON_PRETTY_PRINT);
  let array_nuevosday = @json($nuevosday, JSON_PRETTY_PRINT);

  new Chart(ctx, {
    type: "line",
    data: {
      labels: Object.values(array_semanaday),
      datasets: [{
        label: "Total",
        borderWidth: 4,
        tension: 0,
        pointRadius: 5,
        borderRadius: 4,
        borderSkipped: false,
        pointBackgroundColor: "rgba(255, 255, 255, .8)",
        pointBorderColor: "transparent",
        borderColor: "rgba(255, 255, 255, .8)",
        borderColor: "rgba(255, 255, 255, .8)",
        backgroundColor: "transparent",
        data: [array_semana['lunes'], array_semana['martes'], array_semana['miercoles'], array_semana['jueves'], array_semana['viernes']],
        maxBarThickness: 6
      }, ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false,
      },
      plugins: {
        datalabels: {
          display: false,
        }
      },
      scales: {
       yAxes: [{
        ticks: {
          beginAtZero: true,
          fontColor: 'white',
        },
      }],
      xAxes: [{
        ticks: {
          fontColor: 'white',
        },
      }],
    },    
  },
});


  var ctx2 = document.getElementById("chart-line").getContext("2d");

  new Chart(ctx2, {
    type: "bar",
    data: {
      labels: Object.keys(array_tecnicosem),
      datasets: [{
        label: "Ordenes",
        borderWidth: 0,
        tension: 0,
        borderRadius: 4,
        borderSkipped: false,
        backgroundColor: "rgba(255, 255, 255, .8)",
        data: Object.values(array_tecnicosem),
        maxBarThickness: 6

      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false,
      },
      plugins: {
        datalabels: {
          display: false,
        }
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem) {
            if(tooltipItem.xLabel == "ID 10"){
              return "jose.samano: "+ tooltipItem.yLabel;
            }
            if(tooltipItem.xLabel == "ID 11"){
              return "viridiana.lopez: "+ tooltipItem.yLabel;
            }
            if(tooltipItem.xLabel == "ID 5"){
              return "israel.gomez: "+ tooltipItem.yLabel;
            }
            if(tooltipItem.xLabel == "ID 6"){
              return "rafael.martinez: "+ tooltipItem.yLabel;
            }
            if(tooltipItem.xLabel == "ID 12"){
              return "edgar.angelina: "+ tooltipItem.yLabel;
            }
            if(tooltipItem.xLabel == "ID 15"){
              return "monica.sotelo: "+ tooltipItem.yLabel;
            }
            if(tooltipItem.xLabel == "ID 16"){
              return "carlos.mauricio: "+ tooltipItem.yLabel;
            }
            if(tooltipItem.xLabel == "ID 13"){
              return "ismael.lopez: "+ tooltipItem.yLabel;
            }
            if(tooltipItem.xLabel == "ID 17"){
              return "jahaziel.peralta: "+ tooltipItem.yLabel;
            }
            if(tooltipItem.xLabel == "ID 18"){
              return "cristian.vargas: "+ tooltipItem.yLabel;
            }
          }
        }
      },
      scales: {
       yAxes: [{
        ticks: {
          beginAtZero: true,
          fontColor: 'white',
        },
      }],
      xAxes: [{
        ticks: {
          fontColor: 'white',
        },
      }],
    },    
  },
});

  var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

  new Chart(ctx3, {
    type: "line",
    data: {
      labels: Object.values(array_nuevosday),
      datasets: [{
        label: "Total",
        borderWidth: 4,
        pointRadius: 5,
        borderRadius: 4,
        borderSkipped: false,
        pointBackgroundColor: "rgba(255, 255, 255, .8)",
        pointBorderColor: "transparent",
        borderColor: "rgba(255, 255, 255, .8)",
        borderColor: "rgba(255, 255, 255, .8)",
        backgroundColor: "transparent",
        data: [array_nuevos['lunes'], array_nuevos['martes'], array_nuevos['miercoles'], array_nuevos['jueves'], array_nuevos['viernes']],
        maxBarThickness: 6
      }, ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false,
      },
      plugins: {
        datalabels: {
          display: false,
        }
      },
      scales: {
       yAxes: [{
        ticks: {
          beginAtZero: true,
          fontColor: 'white',
        },
      }],
      xAxes: [{
        ticks: {
          fontColor: 'white',
        },
      }],
    },    
  },
});


</script>
<script>
  $( document ).ready(function() {
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }

  if ($(window).width() < 1820) {
        $('.card-size').addClass('col-lg-3');
        $(".card-size").removeClass('col-lg-2');
        $('.card-size-2').addClass('col-lg-9');
        $(".card-size-2").removeClass('col-lg-10');
        $(".chart-size").removeClass('col-10 offset-1');
      }

    tarea = 0;
    area = 0;
    equipo = 0;
    tecnico = 0;
    fchIni = 0;
    fchFin = 0;
    filtro = 0;
    usuarios = 0;
    estrellas = 0;
    $("#get_graphics").click();
  });

</script>

@endsection
