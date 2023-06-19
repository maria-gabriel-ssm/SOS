
@extends('layouts.modal')

<style type="text/css">
    .select2-container--bootstrap4{
        color: inherit !important;
    }
    .select2-selection{
        background-color: #f0f2f5 !important;
        border: none !important;
    }
</style>
@section('content')
<br>
<div class="container">
    <div class="row">
        @csrf
    <div class="col-12 mt-0">
        {!! Form::label('','Nombre') !!}
        {!! Form::text('nombre',$histo->name,array('class' => 'form-control form-gray', 'readonly'))!!}
    </div>
    <div class="col-6 mt-2">
        {!! Form::label('','Tarea') !!}
        {!! Form::text('tarea',$histo->tarea->tarea,array('class' => 'form-control form-gray', 'readonly'))!!}   
    </div>
    <div class="col-6 mt-2">
        {!! Form::label('','Estado') !!}
        {!! Form::text('estado',$histo->estado==1 ? 'En curso' : 'Finalizada',array('class' => 'form-control form-gray', 'readonly'))!!}   
    </div>
    <div class="col-6 mt-2">
        {!! Form::label('','Equipo') !!}
        {!! Form::text('equipo',$histo->equipos->equipo,array('class' => 'form-control form-gray', 'readonly'))!!}   
    </div>
    <div class="col-6 mt-2">
        {!! Form::label('','Teléfono') !!}
        {!! Form::text('telefono',$histo->telefono,array('class' => 'form-control form-gray', 'readonly'))!!}
    </div>
    <div class="col-6 mt-2">
        {!! Form::label('','Area') !!}
        {!! Form::textarea('area',$histo->area->area,array('class' => 'form-control form-gray', 'readonly', 'rows' => 2))!!}   
    </div>
    <div class="col-6 mt-2">
        {!! Form::label('','Descripción') !!}
        {!! Form::textarea('des',$histo->descripcion,array('class' => 'form-control form-gray', 'readonly', 'rows' => 2))!!}   
    </div>
    <br>
    
            </div>
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-12 text-center">
                                <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                                <br><br>
                            </div>
                        </div>
                        
                
        </div>
 

@endsection