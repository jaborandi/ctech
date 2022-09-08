@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Editar Atividades";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3" >
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto " >
                    <div class=" h5 font-weight-bold text-primary" >
                        Editar Atividades
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
                        <div class="row">
                            <div class="col">
                                <!--[form-start]-->
                                <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("atividades/edit/$rec_id"); ?>" method="post">
                                <!--[form-content-start]-->
                                @csrf
                                <div>
                                    <div class="form-group ">
                                        <label class="control-label" for="titulo">Titulo da atividade </label>
                                        <div id="ctrl-titulo-holder" class=" "> 
                                            <input id="ctrl-titulo"  value="<?php  echo $data['titulo']; ?>" type="text" placeholder="Ex: Dinâmica com dinossauros"  name="titulo"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="descricao">Descrição e planejamento da atividade </label>
                                        <div id="ctrl-descricao-holder" class=" "> 
                                            <textarea placeholder="Entrar Descrição e planejamento da atividade" id="ctrl-descricao"  rows="5" name="descricao" class="htmleditor form-control"><?php  echo $data['descricao']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Por favor insira o texto</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="imagem">Imagem principal </label>
                                        <div id="ctrl-imagem-holder" class=" "> 
                                            <div class="dropzone " input="#ctrl-imagem" fieldname="imagem" uploadurl="{{ url('fileuploader/upload/imagem') }}"    data-multiple="false" dropmsg="Selecione a imagem principal"    btntext="procurar" extensions=".jpg,.png,.gif,.jpeg,.gif,.webp,.svg" filesize="10" maximum="1">
                                                <input name="imagem" id="ctrl-imagem" class="dropzone-input form-control" value="<?php  echo $data['imagem']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Por favor, escolha um arquivo</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['imagem'], '#ctrl-imagem'); ?>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label class="control-label" for="disciplina">Disciplina relacionada principal </label>
                                            <div id="ctrl-disciplina-holder" class=" "> 
                                                <select  id="ctrl-disciplina" name="disciplina"  placeholder="Selecione um valor ..."    class="custom-select" >
                                                <option value="">Selecione um valor ...</option>
                                                <?php
                                                    $options = Menu::disciplina();
                                                    $field_value = $data['disciplina'];
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_record_selected($field_value, $value);
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>                                   
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label" for="duracao">Duração estimada </label>
                                            <div id="ctrl-duracao-holder" class=" "> 
                                                <input id="ctrl-duracao"  value="<?php  echo $data['duracao']; ?>" type="number" placeholder="Em minutos" step="any"  name="duracao"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="tags">Tags </label>
                                        <div id="ctrl-tags-holder" class=" "> 
                                            <select  id="ctrl-tags" name="tags[]"  placeholder="Comece a digitar para procurar" multiple   class="selectize" >
                                            <?php
                                                $selected_options = explode(",", $data['tags']);
                                                foreach($selected_options as $option){
                                            ?>
                                            <option selected><?php echo $option; ?></option>
                                            <?php
                                                }
                                            ?>
                                            <?php
                                                $options = $comp_model->tags_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = ( $value == $data['tags'] ? 'selected' : null );
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
                                    <div class="form-group ">
                                        <label class="control-label" for="arquivos">Arquivos </label>
                                        <div id="ctrl-arquivos-holder" class=" "> 
                                            <div class="dropzone " input="#ctrl-arquivos" fieldname="arquivos" uploadurl="{{ url('fileuploader/upload/arquivos') }}"    data-multiple="true" dropmsg="Escolha arquivos ou solte-os aqui"    btntext="procurar" extensions=".jpg,.png,.gif,.jpeg,.docx,.doc,.xls,.xlsx,.xml,.csv,.pdf,.xps,.zip,.gzip,.rar,.7z,.mp3,.mp4,.webm,.wav,.avi,.mpg,.mpeg,.ai,.psd,.svg,.eps" filesize="100" maximum="200">
                                                <input name="arquivos" id="ctrl-arquivos" class="dropzone-input form-control" value="<?php  echo $data['arquivos']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Por favor, escolha um arquivo</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['arquivos'], '#ctrl-arquivos'); ?>
                                    </div>
                                </div>
                                <div class="form-ajax-status"></div>
                                <!--[form-content-end]-->
                                <!--[form-button-start]-->
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit">
                                    Atualizar
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
