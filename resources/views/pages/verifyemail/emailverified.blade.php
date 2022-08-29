@extends('layouts.info')
@section('content')
<div class="container mt-4">
	<h4>Confirmação de email concluída.</h4>
	<hr />
	<div class="">
		<a href="{{ route('home') }}" class="btn btn-primary">Continuar</a>
	</div>
</div>
@endsection