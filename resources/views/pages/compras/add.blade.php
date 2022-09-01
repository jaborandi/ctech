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
                        <form id="compras-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('compras.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="objeto">Objeto </label>
                                    <div id="ctrl-objeto-holder" class=" "> 
                                        <input id="ctrl-objeto"  value="<?php echo get_value('objeto') ?>" type="text" placeholder="Ex: 2 canetas marcadoras"  name="objeto"  class="form-control " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="data">Data </label>
                                        <div id="ctrl-data-holder" class="input-group "> 
                                            <input id="ctrl-data" class="form-control datepicker  datepicker"  value="<?php echo get_value('data', date('Y-m-d')) ?>" type="datetime" name="data" placeholder="Entrar Data" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="d/m/Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="control-label" for="link_referencia">Link de Referencia </label>
                                        <div id="ctrl-link_referencia-holder" class=" "> 
                                            <input id="ctrl-link_referencia"  value="<?php echo get_value('link_referencia') ?>" type="url" placeholder="https://"  name="link_referencia"  class="form-control " />
                                        </div>
                                        <small class="form-text">Caso o objeto seja específico ou você encontre um bom valor, deixe o link aqui</small>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="observacoes">Observacoes </label>
                                    <div id="ctrl-observacoes-holder" class=" "> 
                                        <textarea placeholder="Descreva observações e características do objeto a ser comprado" id="ctrl-observacoes"  rows="5" name="observacoes" class="htmleditor form-control"><?php echo get_value('observacoes') ?></textarea>
                                        <!--<div class="invalid-feedback animated bounceIn text-center">Por favor insira o texto</div>-->
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="status">Status </label>
                                    <div id="ctrl-status-holder" class=" "> 
                                        <?php
                                            $options = Menu::status();
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if current option is checked option
                                            $checked = Html::get_field_checked('status', $value, "AGUARDANDO ANÁLISE");
                                        ?>
                                        <label class="form-check">
                                        <input class="form-check-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="status" />
                                        <span class="form-check-label"><?php echo $label ?></span>
                                        </label>
                                        <?php
                                            }
                                            }
                                        ?>
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
