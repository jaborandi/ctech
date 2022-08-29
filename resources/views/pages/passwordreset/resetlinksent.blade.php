@extends('layouts.info')
@section('content')
<div class="container mt-4">
	<h3>Gerenciador de redefinição de senha</h3>
	<hr />
	<div class="">
		<h4 class="text-info bold">
			<i class="material-icons">email</i> Uma mensagem foi enviada para o seu email. Por favor, siga o link para redefinir sua senha
		</h4>
	</div>
	<hr />
	<a href="<?php print_link("/"); ?>" class="btn btn-info">Clique aqui para logar</a>
</div>
@endsection