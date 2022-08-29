<?php 
	$user_id = $id ?? request()->id;
?>
@extends('layouts.info')
@section('content')
<div class="container mt-4">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><i class="material-icons">email</i> {{ __('Verify Your Email Address') }}</div>
				<div class="card-body">
					
					<?php Html::display_page_errors($errors); ?>
				
					@if (!empty($message))
					<div class="alert alert-success animated bounce" role="alert">
						{{ $message }}
					</div>
					@endif
					
					Por favor, verifique seu endereço de e-mail seguindo o link em sua caixa postal

					<hr />
					<div class="text-center">
						<a class="btn btn-sm btn-info" href="{{ route('verification.resend', ['id' => $user_id]) }}">
							<i class="material-icons">email</i> Reenviar email
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection