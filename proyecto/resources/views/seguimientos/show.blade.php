@extends('layouts.modal')

@section('content')

<style type="text/css">
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
    max-height: 300px;
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            @csrf
            <div class="form-group row">
                <h6 class="mb-3 text-sm">
                    <img src="{{URL::asset('/image/avatar/mns.gif')}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                    Comentarios del técnico
                    <span class="float-right" href="javascript:;"><i class="material-icons text-sm me-2">event</i>
                        @if(empty($comentario->created_at))
                        NA
                        @else
                        {{$comentario->created_at->format('d/m/Y')}}
                        @endif
                    </span>
                </h6>

                <!-- <span class="mb-1 text-xs">Comentarios del técnico:</span> -->

                <div id="scrole" class="chat">
                    @foreach($comentarios as $key => $comentario)
                    <div class="msg msg_to">
                        <div class="content p-3"><b>{{$admin->usuario->username ? $admin->usuario->username : 'NA'}}</b></br>
                          {{$comentario->comentario ? $comentario->comentario : 'NA'}}</div>
                          <div class="sender"><span class="icon circulo ml-2 bg-{{$bg->customcolor}}">
                             <h3 class="m-0 icon-letter">{{$letter ? $letter : 'NA'}}</h3>
                         </span><span class="name text-sm">{{$comentario->created_at ? $comentario->created_at->format('Y-m-d') : 'NA'}}</span><span class="time text-sm"></span></div>
                     </div>
                     @endforeach
                     <br>
                 </div>
                 <div class="form-group row mb-0 mt-2">
                    <div class="col-md-12 text-center">
                        <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection