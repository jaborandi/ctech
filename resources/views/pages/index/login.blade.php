
@extends($layout)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="my-4 p-3 bg-light">
                
                
                <div>
                    @if($errors->any())
                    <div class="alert alert-danger animated bounce">{{ $errors->first() }}</div>
                    @endif
                    <form name="loginForm" action="{{ route('auth.login') }}" class="needs-validation form page-form" method="post">
                        @csrf
                        <div class="input-group form-group">
                            <input placeholder="Nome de usuário ou email" name="username"  required="required" class="form-control" type="text"  />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="form-control-feedback material-icons">account_circle</i></span>
                            </div>
                        </div>
                        <div class="input-group form-group">
                            
                            <input  placeholder="Senha" required="required" name="password" class="form-control " type="password" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="form-control-feedback material-icons">lock</i></span>
                            </div>
                        </div>
                        <div class="row clearfix mt-3 mb-3">
                            
                            <div class="col-6">
                                <label class="">
                                <input value="true" type="checkbox" name="rememberme" />
                                Lembre de mim
                                </label>
                            </div>
                            
                            <div class="col-6">
                                <a href="{{ route('password.forgotpassword') }}" class="text-danger"> Redefinir senha</a>
                            </div>
                            
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-block btn-md" type="submit"> 
                            <i class="load-indicator">
                            <clip-loader :loading="loading" color="#fff" size="20px"></clip-loader> 
                            </i>
                            Entrar <i class="material-icons">lock_open</i>
                            </button>
                        </div>
                    </form>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection
