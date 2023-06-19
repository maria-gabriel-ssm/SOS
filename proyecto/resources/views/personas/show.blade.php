@extends('layouts.modal')
@section('content')
<br>
<div class="container-fluid px-5 py-1">
    <div class="row">
      <div class="col-md-12 table-responsive">
        <h6>Listado de participantes</h6>
        <form>
          @if(Auth::user()->tipo_usuario==2)
          <div class="form-check p-0 mb-3"><input class="form-check-input checkbox" id="cbx-select-all" type="checkbox" value="Group A 1" /><label class="form-check-label" for="cbx-select-all">Seleccionar correos</label>
          <div class="my-2 p-2 form-gray rounded text-muted tex-sm" style="height: 35px;" onclick="copyToClipboard()"><span id="emails" class="output text-sm">Ningún correo seleccionado</span>
            <i id="cop" class="material-icons text-sm line-center scale float-right mr-2 pointer" title="Copiar">content_copy</i></div></div>
            <label class="form-check-label">O descargar toda la lista en: </label>
            @endif
        <table id="table" class="table align-items-center mb-0 text-sm">
          <thead class="{{$bg->custombackground}} back-black rounded">
              <tr>
                <th class="text-uppercase text-xs font-weight-bolder pl-4 rounded-left" scope="col">Nombre</th>
                <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Cargo</th>
                <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Area</th>
                <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Contacto</th>
              </tr>
          </thead>
          <tbody>
              @foreach($personas as $key => $persona)
              <tr class="border-bottom">
                <td>
                  @if(Auth::user()->tipo_usuario==2)
                  <div class="form-check pl-1"><input class="form-check-input mt-0 checkbox cbx-group cbx-group-a" id="cbx-group-a-{{$persona->id}}" type="checkbox" value="{{$persona->id}}" data-group="a" data-id="{{$persona->email}}" /><label class="form-check-label ml-2 mb-0 text-dark text-sm text-bold" for="cbx-group-a-{{$persona->id}}">{{$persona->nombreCompleto}}</label></div>
                  @else
                  <label class="form-check-label ml-2 mb-0 text-dark text-sm text-bold noactive">{{$persona->nombreCompleto}}</label>
                  @endif
                  </td>
                  <td>{{$persona->cargo ? $persona->cargo : 'NA'}}</td>
                  <td>{{$persona->area ? $persona->area : 'NA'}}</td>
                  <td>{{$persona->email ? $persona->email : 'NA'}}<br>
                {{$persona->telefono ? 'Tel: '.$persona->telefono : 'NA'}}</td>
              </tr> 
              @endforeach
          </tbody>
        </table>
      </form>
      </div>
    </div>
  </div>  

<script type="text/javascript">
  const CHECKBOX_SELECTOR = 'input[type=checkbox]'

$("#cop").on('click',function(){ 
     $('#cop').addClass('text-success');

setTimeout(function () { 
    $('#cop').removeClass('text-success');
},  1000);

   });

// selected checkbox data
var selected = [],
    totalCheckboxes = $('.cbx-group').length;

// select all
$('#cbx-select-all').on('click', function() {
  $('.checkbox').prop('checked', $(this).prop('checked'));
  selected = getSelectedCheckbox();
  showSelected();
})


// select item
$('[id^=cbx-group-]').on('click', function() {
  $(this).prop('checked', $(this).prop('checked'));
  selected = getSelectedCheckbox();
  showSelected();
  checkAllState();
  
  // update group selector check state
  var group = $(this).data('group')
      totalGroupCheckbox = $('.cbx-group-'+group).length,
      totalGroupSelected = $('.cbx-group-'+group+':checked').length;
  if (totalGroupSelected == totalGroupCheckbox) {
    $('#cbx-select-group-'+group).prop('checked', true)
  } else {
    $('#cbx-select-group-'+group).prop('checked', false)
  }
})

// update select-all check state
function checkAllState() {
  console.log('check all state')
  if ($('.cbx-group:checked').length == totalCheckboxes) {
    $('#cbx-select-all').prop('checked', true);
  } else {
    $('#cbx-select-all').prop('checked', false);
  }
}

// get all selected checkboxes data
function getSelectedCheckbox() {
  var s = []
  $('.cbx-group:checked').each(function() {
    s.push($(this).data('id'));
  })
  return s;
}

function showSelected() {
  $('.output').text('')
  $(selected).each(function(i, v) {
    $('.output').append(v + ', ')
  })
}

 function copyToClipboard() {
var range = document.getSelection().getRangeAt(0);
                    range.selectNode(document.getElementById("emails"));
                    window.getSelection().removeAllRanges(); // clear current selection
                    window.getSelection().addRange(range); // to select text
                    document.execCommand("copy");
                    window.getSelection().removeAllRanges();// to deselect
                
  // alert("Copiado: " + range);
}

var tablita;
$(document).ready(function() {
    tablita = $('#table').DataTable({
      dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Listado de participantes'
            },
            {
                extend: 'pdf',
                title: 'Listado de participantes'
            },
            {
                extend: 'print',
                title: 'Listado de participantes'
            }
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Sin registros ",
            "info": "Página  _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros",
            "infoFiltered": "(Filtardo de _MAX_ total registros)",
            'search':'Buscar:',
            'paginate':{
              'next':'﹥',
              'previous':'﹤'
            }

        }
    } );

    $(".pagination").addClass("d-none");
    $(".buttons-excel").removeClass("dt-button").addClass("btn btn-success btn-sm");
    $(".buttons-pdf").removeClass("dt-button").addClass("btn btn-danger btn-sm");
    $(".buttons-print").removeClass("dt-button").addClass("btn btn-info btn-sm");
} );


    localStorage.setItem('res','');
    @if(session('ok'))
    localStorage.setItem('res','ok');
    window.parent.closeModal();
    @elseif(session('nook'))
    localStorage.setItem('res','{{Session::get('nook')}}');
    window.parent.closeModal();
    @endif
</script>
@endsection