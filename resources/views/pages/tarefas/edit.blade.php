@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Editar Tarefas";
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
                        Responder tarefa
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
                                <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("tarefas/edit/$rec_id"); ?>" method="post">
                                <!--[form-content-start]-->
                                @csrf
                                <div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="control-label" for="status">Status da tarefa </label>
                                            <div id="ctrl-status-holder" class=" "> 
                                                <?php
                                                    $options = Menu::status2();
                                                    $field_value = $data['status'];
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    //check if value is among checked options
                                                    $checked = Html::get_record_checked($field_value, $value);
                                                ?>
                                                <label class="custom-control custom-radio">
                                                <input class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="status" />
                                                <span class="custom-control-label"><?php echo $label ?></span>
                                                </label>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="feedback">Feedback </label>
                                        <div id="ctrl-feedback-holder" class=" "> 
                                            <textarea placeholder="Alguma consideração adicional sobre a conclusão dessa tarefa? (OPCIONAL)" id="ctrl-feedback"  rows="5" name="feedback" class=" form-control"><?php  echo $data['feedback']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Por favor insira o texto</div>-->
                                        </div>
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
