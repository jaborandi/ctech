@extends('layouts.info')
@section('content')
<div class="container">
    <div class="my-4 text-center p-4 card-4">
        <i class="material-icons mi-lg text-success">check_circle</i>
        <div class="h2 text-bold text-success my-md">
            Parabéns!
        </div>
        <div class="h4">
            Sua conta foi criada
        </div>
        
        <hr class="my-md" />
        <a href="{{ url('/home') }}" class="btn btn-primary"><i class="material-icons">home</i> Continuar</a>
    </div>
</div>
@endsection