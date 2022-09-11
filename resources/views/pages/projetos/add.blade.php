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
                        <form id="projetos-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('projetos.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="titulo">Titulo </label>
                                        <div id="ctrl-titulo-holder" class=" "> 
                                            <input id="ctrl-titulo"  value="<?php echo get_value('titulo') ?>" type="text" placeholder="Ex: Troféus para campeonato de futsal"  name="titulo"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="categoria">Categoria </label>
                                        <div id="ctrl-categoria-holder" class=" "> 
                                            <select  id="ctrl-categoria" name="categoria"  placeholder="Selecione um valor ..."    class="selectize" >
                                            <option value="">Selecione um valor ...</option>
                                            <?php 
                                                $options = $comp_model->categoria_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('categoria', $value);
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
                                    <label class="control-label" for="descricao">Descrição </label>
                                    <div id="ctrl-descricao-holder" class=" "> 
                                        <textarea placeholder="Entrar Descrição" id="ctrl-descricao"  rows="5" name="descricao" class="htmleditor form-control"><?php echo get_value('descricao') ?></textarea>
                                        <!--<div class="invalid-feedback animated bounceIn text-center">Por favor insira o texto</div>-->
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="imagem">Imagem </label>
                                    <div id="ctrl-imagem-holder" class=" "> 
                                        <div class="dropzone " input="#ctrl-imagem" fieldname="imagem" uploadurl="{{ url('fileuploader/upload/imagem') }}"    data-multiple="false" dropmsg="Escolha arquivos ou solte-os aqui"    btntext="procurar" extensions=".jpg,.png,.gif,.jpeg,.webp,.jpeg,.svg" filesize="10" maximum="1">
                                            <input name="imagem" id="ctrl-imagem" class="dropzone-input form-control" value="<?php echo get_value('imagem') ?>" type="text"  />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Por favor, escolha um arquivo</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="arquivos">Arquivos </label>
                                    <div id="ctrl-arquivos-holder" class=" "> 
                                        <div class="dropzone " input="#ctrl-arquivos" fieldname="arquivos" uploadurl="{{ url('fileuploader/upload/arquivos') }}"    data-multiple="true" dropmsg="Escolha arquivos ou solte-os aqui"    btntext="procurar" extensions=".jpg,.png,.gif,.jpeg,.docx,.doc,.xls,.xlsx,.xml,.csv,.pdf,.xps,.zip,.gzip,.rar,.7z,.mp3,.mp4,.webm,.wav,.avi,.mpg,.mpeg,.ai,.psd,.svg,.eps" filesize="100" maximum="200">
                                            <input name="arquivos" id="ctrl-arquivos" class="dropzone-input form-control" value="<?php echo get_value('arquivos') ?>" type="text"  />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Por favor, escolha um arquivo</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
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
