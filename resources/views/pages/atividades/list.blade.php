@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("atividades/add");
    $can_edit = $user->can("atividades/edit");
    $can_view = $user->can("atividades/view");
    $can_delete = $user->can("atividades/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Atividades";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto " >
                    <div class=" h5 font-weight-bold text-primary" >
                        Atividades
                    </div>
                </div>
                <div class="col-md-auto " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("atividades/add") ?>" >
                    <i class="material-icons">add</i>                               
                    Adicionar nova 
                </a>
                <?php } ?>
            </div>
            <div class="col-md-4 comp-grid" >
                <button data-toggle="modal" data-target="#Modal121Page1" class="btn btn-primary"><i class='material-icons '>perm_data_setting</i>  Filtrar dados</button>
                <div data-backdrop="true" class="modal fade" id="Modal121Page1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><i class='material-icons '>perm_data_setting</i>  Opções de filtragem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-0 reset-grids">
                                <div  class="mb-3 card-4" >
                                    <div class="container-fluid">
                                        <div class="row ">
                                            <div class="col-sm-12 comp-grid" >
                                                <form method="get" action="" class="form">
                                                    <div class="q-mb-sm q-pa-sm ">
                                                        <label class="font-weight-bold p-2">Filtrar por disciplina</label>
                                                        <div class="">
                                                            <?php
                                                                $options = Menu::atividades_disciplina();
                                                                if(!empty($options)){
                                                                foreach($options as $option){
                                                                $value = $option['value'];
                                                                $label = $option['label'];
                                                                //check if current option is checked option
                                                                $checked = Html::get_field_checked('atividades_disciplina', $value);
                                                            ?>
                                                            <label class="form-check">
                                                            <input class="form-check-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" name="atividades_disciplina"  />
                                                            <span class="form-check-label"><?php echo $label ?></span>
                                                            </label>
                                                            <?php
                                                                }
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class=" "><br><br></div>
                                                    <div class="q-mb-sm q-pa-sm ">
                                                        <label class="font-weight-bold p-2">Filtrar por duração</label>
                                                        <div class="">
                                                            <?php 
                                                                $to = 240;
                                                                $from =  0;
                                                                $range_field =  get_value('atividades_duracao');
                                                                if($range_field){
                                                                $range = explode('-', $range_field);
                                                                $from = $range[0];
                                                                $to = $range[1] ?? null;
                                                                }
                                                            ?>
                                                            <input class="ion-range" type="text" data-from="<?php echo $from ?>" data-to="<?php echo $to ?>" data-force_edge="true" data-prefix="" data-postfix="min"  name="atividades_duracao" data-step="10" data-type="double" data-min="0"   data-max="240"   data-grid="true" data-grid-snap="true" / > 
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class="form-group text-center">
                                                        <button class="btn btn-primary">Filtrar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 " >
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Busca por tags ou assuntos" />
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="material-icons">search</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 comp-grid" >
                <?php Html::display_page_errors($errors); ?>
                <div class="filter-tags mb-2">
                    <?php
                        Html::filter_tag('atividades_disciplina', 'Disciplina', Menu::atividades_disciplina());
                    ?>
                    <?php
                        Html::filter_tag('atividades_duracao', 'Duracao');
                    ?>
                </div>
                <div  class=" page-content" >
                    <div id="atividades-list-records">
                        <div class="row">
                            <div class="col">
                                <?php
                                    if($total_records){
                                ?>
                                <div id="page-main-content">
                                    <?php Html::page_bread_crumb("/atividades/", $field_name, $field_value); ?>
                                    <div class="row gutter-lg page-data">
                                        <!--record-->
                                        <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                            $counter++;
                                        ?>
                                        <!--PageComponentStart-->
                                        <div class="col-sm-4 col-md-3 text-center">
                                            <div class="card-4 mb-3">
                                                <a href="<?php print_link("atividades/view/$rec_id"); ?>" class="d-block card-link ">
                                                <h6 class="font-weight-bold pb-2"><?php echo ($data['titulo']); ?></h6>
                                                <img src="{{ getImgSizePath($data['imagem'], 'medium') }}" class="img-fluid" />
                                            </a>
                                            <div class="pt-2">
                                                <?php 
                                                    $dados = $data['tags'];
                                                    $matriz = explode(',',$dados);
                                                    foreach($matriz as $valores){
                                                    echo'<span class="badge badge-pill badge-warning">'. $valores .'</span>  ';
                                                    }
                                                ?>
                                            </div>
                                            <hr class="my-2" />
                                            <div class="d-flex justify-content-between">
                                                <small class="text-muted"><?php echo ($data['disciplina']); ?></small>
                                                <div class="d-flex justify-content-between">
                                                    <div class="dropdown" >
                                                        <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                        <i class="material-icons">menu</i> 
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <a class="dropdown-item "   href="<?php print_link("atividades/view/$rec_id"); ?>">
                                                            <i class="material-icons">visibility</i> View
                                                        </a>
                                                        <a class="dropdown-item "   href="<?php print_link("atividades/edit/$rec_id"); ?>">
                                                        <i class="material-icons">edit</i> Edit
                                                    </a>
                                                    <a class="dropdown-item record-delete-btn" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="modal" href="<?php print_link("atividades/delete/$rec_id"); ?>">
                                                    <i class="material-icons">clear</i> Delete
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--PageComponentEnd-->
                        <?php 
                            }
                        ?>
                        <!--endrecord-->
                    </div>
                    <div class="row gutter-lg search-data"></div>
                    <div>
                    </div>
                </div>
                <?php
                    if($show_footer){
                ?>
                <div class="">
                    <div class="row justify-content-center">    
                        <div class="col-md-auto">   
                        </div>
                        <div class="col">   
                            <?php
                                if($show_pagination == true){
                                $pager = new Pagination($total_records, $record_count);
                                $pager->show_page_count = false;
                                $pager->show_record_count = true;
                                $pager->show_page_limit =false;
                                $pager->limit = $limit;
                                $pager->show_page_number_list = true;
                                $pager->pager_link_range=5;
                                $pager->render();
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    }
                    else{
                ?>
                <div class="text-muted  animated bounce p-3">
                    <h4><i class="material-icons">block</i> Nenhum Registro Encontrado</h4>
                </div>
                <?php
                    }
                ?>
            </div>
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

</style><style>

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
<script>
	/*
	* Page Custom Javascript | Jquery codes
	*/

	//$(document).ready(function(){
	//	
	//});
</script>

@endsection
