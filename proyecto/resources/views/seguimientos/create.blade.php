@extends('layouts.modal')
@section ('content')

<style type="text/css">
    .form-gray{
        background-color: #f0f2f5 !important;
        border: none !important;
    }
    .msg {
    display: grid;
    margin: 20px;
    grid-template-columns: repeat(5, 1fr);
    grid-template-rows: repeat(1, 1fr);
}
.content {
    padding: 30px;
}
.recepient {
    grid-area: 1 / 1 / 2 / 2;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: auto auto;
}
.recepient .icon {
    grid-area: 1 / 2 / 3 / 3;
    padding: 5px;
    align-self: center;
}
.recepient .name {
    grid-area: 1 / 1 / 2 / 2;
    align-self: end;
    font-weight: bold;
    text-align: right;
}
.recepient .time {
    grid-area: 2 / 1 / 3 / 2;
    align-self: start;
    color: gray;
    text-align: right;
}
.sender {
    grid-area: 1 / 5 / 2 / 6;
    display: grid;
    /*grid-template-columns: repeat(2, 1fr);*/
    grid-template-rows: auto auto;
}
.sender .icon {
    grid-area: 1 / 1 / 3 / 2;
    padding: 5px;
    align-self: center;
}
.sender .name {
    grid-area: 1 / 2 / 2 / 3;
    font-weight: bold;
    align-self: end;
}
.sender .time {
    grid-area: 2 / 2 / 3 / 3;
    color: gray;
    align-self: start;
}
.msg_from .content {
    grid-area: 1 / 2 / 2 / 5;
    background: #DDA0DD;
    border-radius: 20px 20px 20px 0;
    text-align: left;
    align-self: center;
}
.msg_to .content {
    grid-area: 1 / 2 / 2 / 5;
    background: lavender;
    color: #555;
    border-radius: 20px 20px 0 20px;
    text-align: right;
    align-self: center;
}
img {
    width: 100%;
}

.chat{
    max-height: 350px;
    background: ghostwhite;
    overflow: overlay;
}

#scrole::-webkit-scrollbar-track
{
    border-radius: 10px;
    background-color: #F5F5F5;
}

#scrole::-webkit-scrollbar
{
    width: 8px;
    background-color: #F5F5F5;
}

#scrole::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    background-color: #ccc;
}

.circulo {
   width: 2rem;
   height: 2rem;
   border-radius: 50%;
   display: flex;
   align-items: center;
   justify-content: center;
   margin:0px auto;
   padding:2%;
}

.circulo > h3 {
   font-family: sans-serif;
   color: white;
   font-size: 1rem;
   font-weight: bold;
   text-transform: uppercase;
}
</style>
{!! Form::open(array('route' => array('seguimientos.store',$seguimiento),'method'=>'post','class'=>'')) !!}
<div class="row mt-3 justify-content-center">
    {!! Form::label('','*Ingrese comentarios con características importantes sobre el servicio. Estos serán visibles para el usuario.',array('class' => 'text-sm text-center pb-0')) !!}
    <div id="scrole" class="col-10 chat">
        @foreach($comentarios as $key => $comentario)
  <div class="msg msg_to">
    <div class="content p-3"><b>{{$comentario->admin ? $comentario->admin : 'NA'}}</b></br>
      {{$comentario->comentario ? $comentario->comentario : 'NA'}}</div>
    <div class="sender"><span class="icon circulo ml-2 bg-{{$bg->customcolor}}">
                       <h3 class="m-0 icon-letter">{{$letter[$key] ? $letter[$key] : 'NA'}}</h3>
                     </span><span class="name text-sm">{{$comentario->created_at ? $comentario->created_at->format('Y-m-d') : 'NA'}}</span><span class="time text-sm">{{$comentario->created_at ? $comentario->created_at->format('h:i') : 'NA'}}</span></div>
  </div>
  @endforeach
  <br>
  <!-- <div class="msg msg_from">
    <div class="recepient"><span class="icon"><img src="https://i.postimg.cc/PCQqM7XX/she.png"></span><span class="name">Dora</span><span class="time">1 day ago</span></div>
    <div class="content">Do not write me anymore.</div>
  </div> -->
</div>
    </div>
</div>

<div class="row justify-content-center position-absolute bottom-0 w-100 py-2 ml-1" style="background-color: #fff;">
    <div class="col-lg-2 col-md-2 col-sm-12 cerrar">
        <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark mb-0" data-dismiss="modal">Cerrar</button>
    </div>
    <div class="col-lg-7 col-md-7 col-sm-12">
        {!! Form::textarea('comentario', '' ,array('class' => 'form-control form-gray p-2', 'placeholder'=>'Ingrese un comentario', 'rows' => 2, 'required'))!!}
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12">
        <button type="submit"class="btn {{$bg->custom}} mb-0 guardar">Guardar</button>
    </div>
    
</div>

{!! Form::close() !!}

<script type="text/javascript">

    if ($(window).width() < 700) {
        $(".guardar").addClass('mt-2 w-100');
        $(".cerrar").addClass('d-none');
        $(".icon").addClass('d-none');
        $(".name").addClass('ml-2');
        $(".time").addClass('ml-2');
      }

    localStorage.setItem('res','');
    @if(session('nook'))
    localStorage.setItem('res','{{Session::get('nook')}}');
    window.parent.closeModal();
    @endif
  </script>

@endsection