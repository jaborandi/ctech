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
                        Agendar utilização do laboratório
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
                        <form id="agenda_laboratorio-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('agenda_laboratorio.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="titulo">Titulo <span class="text-danger">*</span></label>
                                        <div id="ctrl-titulo-holder" class=" "> 
                                            <input id="ctrl-titulo"  value="<?php echo get_value('titulo') ?>" type="text" placeholder="Ex: Projeto de português"  required="" name="titulo"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="numero_pessoas">Número de Pessoas <span class="text-danger">*</span></label>
                                        <div id="ctrl-numero_pessoas-holder" class=" "> 
                                            <input id="ctrl-numero_pessoas"  value="<?php echo get_value('numero_pessoas') ?>" type="number" placeholder="Máximo de 20 pessoas" max="20" step="any"  required="" name="numero_pessoas"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="data_inicio">Data Inicio <span class="text-danger">*</span></label>
                                        <div id="ctrl-data_inicio-holder" class="input-group "> 
                                            <input id="ctrl-data_inicio" class="form-control datepicker  datepicker"  required="" value="<?php echo get_value('data_inicio') ?>" type="datetime" name="data_inicio" placeholder="Clique para selecionar" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="d/m/Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="hora_inicio">Hora Inicio <span class="text-danger">*</span></label>
                                        <div id="ctrl-hora_inicio-holder" class="input-group "> 
                                            <input id="ctrl-hora_inicio" class="form-control datepicker  datepicker"  required="" value="<?php echo get_value('hora_inicio') ?>" type="time" name="hora_inicio" placeholder="Clique para selecionar" data-enable-time="true" data-min-date="" data-max-date=""  data-alt-format="H:i" data-date-format="H:i:S" data-inline="false" data-no-calendar="true" data-mode="single" /> 
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="material-icons">access_time</i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="data_termino">Data Termino <span class="text-danger">*</span></label>
                                        <div id="ctrl-data_termino-holder" class="input-group "> 
                                            <input id="ctrl-data_termino" class="form-control datepicker  datepicker"  required="" value="<?php echo get_value('data_termino') ?>" type="datetime" name="data_termino" placeholder="Clique para selecionar" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="d/m/Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="hora_termino">Hora Termino <span class="text-danger">*</span></label>
                                        <div id="ctrl-hora_termino-holder" class="input-group "> 
                                            <input id="ctrl-hora_termino" class="form-control datepicker  datepicker"  required="" value="<?php echo get_value('hora_termino') ?>" type="time" name="hora_termino" placeholder="Clique para selecionar" data-enable-time="true" data-min-date="" data-max-date=""  data-alt-format="H:i" data-date-format="H:i:S" data-inline="false" data-no-calendar="true" data-mode="single" /> 
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="material-icons">access_time</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="observacoes">Observações </label>
                                    <div id="ctrl-observacoes-holder" class=" "> 
                                        <textarea placeholder="Caso haja observações utilize esse campo para registrá-las" id="ctrl-observacoes"  rows="5" name="observacoes" class=" form-control"><?php echo get_value('observacoes') ?></textarea>
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
