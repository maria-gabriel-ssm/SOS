var tablita;

$(document).ready(function() {
    tablita = $('#table').DataTable({
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
} );



/*
<!-- <tr class="explode hide">
                  <td style="display: none;"></td>  
                  <td colspan="5" class="py-4" style="display: none;">
                    <div class="row text-no-nowrap">
                      <div class="col-3">
                        <p class="mb-1 text-bold"> Descripción </p>{{$orden->descripcion}}
                      </div>
                      <div class="col-3">
                        <p class="mb-1 text-bold"> Equipo </p>
                        @if($orden->equipo =='1')  
                        PC Escritorio
                        @elseif($orden->equipo =='2')
                        Laptop 
                        @elseif($orden->equipo =='3')
                        Impresora/escáner 
                        @elseif($orden->equipo =='4')
                        Tablet 
                        @elseif($orden->equipo =='5')
                        Celular 
                        @elseif($orden->equipo =='6')
                        Otro 
                        @endif
                    </div>
                      <div class="col-3">
                        <p class="mb-1 text-bold"> Area </p>{{$orden->area->area}}
                    </div>
                    <div class="col-3">
                        <p class="mb-1 text-bold"> Teléfono </p>{{$orden->telefono}}
                    </div>
                    </div>
                  </td>
                </tr> -->
*/
