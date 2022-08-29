@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Adicionar novo";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3" >
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto " >
                    <div class=" h5 font-weight-bold text-primary" >
                        Adicionar novo
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid" >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class=" page-content" >
                        <!--[form-start]-->
                        <form id="tarefas-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('tarefas.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="prioridade">Prioridade </label>
                                        <div id="ctrl-prioridade-holder" class=" "> 
                                            <input class="ion-range " id="ctrl-prioridade"  type="text" data-from="<?php echo get_value('prioridade') ?>" data-step="any" data-max="10" data-min="0" data-force_edge="true" name="prioridade"  data-grid="true" /> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="titulo">Titulo <span class="text-danger">*</span></label>
                                    <div id="ctrl-titulo-holder" class=" "> 
                                        <input id="ctrl-titulo"  value="<?php echo get_value('titulo') ?>" type="text" placeholder="O que precisa ser feito?"  required="" name="titulo"  class="form-control " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="fazer_ate">Data limite </label>
                                        <div id="ctrl-fazer_ate-holder" class="input-group "> 
                                            <input id="ctrl-fazer_ate" class="form-control datepicker  datepicker"  value="<?php echo get_value('fazer_ate') ?>" type="datetime" name="fazer_ate" placeholder="Clique para selecionar" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="usuarios">Atribuir tarefa para: <span class="text-danger">*</span></label>
                                        <div id="ctrl-usuarios-holder" class=" "> 
                                            <select required=""  id="ctrl-usuarios" name="usuarios"  placeholder="Clique para abrir a lista"    class="custom-select" >
                                            <option value="">Clique para abrir a lista</option>
                                            <?php 
                                                $options = $comp_model->usuarios_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('usuarios', $value);
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                            <?php echo $label; ?>
                                            </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="descricao">Descrição adicional (opcional) </label>
                                    <div id="ctrl-descricao-holder" class=" "> 
                                        <textarea placeholder="Entrar Descrição adicional (opcional)" id="ctrl-descricao"  rows="5" name="descricao" class="htmleditor form-control"><?php echo get_value('descricao') ?></textarea>
                                        <!--<div class="invalid-feedback animated bounceIn text-center">Por favor insira o texto</div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-button-start]-->
                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                <button class="btn btn-primary" type="submit">
                                Enviar
                                <i class="material-icons">send</i>
                                </button>
                            </div>
                            <!--[form-button-end]-->
                        </form>
                        <!--[form-end]-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('pagecss')
<style>

</style>
@endsection
@section('pagejs')
<script>
	/*
	* Page Custom Javascript | Jquery codes
	*/

	//$(document).ready(function(){
	//	
	//});
</script>

@endsection
