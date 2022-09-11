@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("tarefas/add");
    $can_edit = $user->can("tarefas/edit");
    $can_view = $user->can("tarefas/view");
    $can_delete = $user->can("tarefas/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Tarefas";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page ajax-page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto " >
                    <div class=" h5 font-weight-bold text-primary" >
                        Tarefas
                    </div>
                </div>
                <div class="col-md-auto " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("tarefas/add") ?>" >
                    <i class="material-icons">add</i>                               
                    Adicionar novo 
                </a>
                <?php } ?>
            </div>
            <div class="col-md-3 " >
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Pesquisa" />
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
                <div  class=" page-content" >
                    <div id="tarefas-kanban-records">
                        <div class="row">
                            <div class="col">
                                <?php
                                    if($total_records){
                                ?>
                                <div id="page-main-content">
                                    <div class="ajax-page-load-indicator" style="display:none">
                                        <div class="text-center d-flex justify-content-center load-indicator">
                                            <span class="loader mr-3"></span>
                                            <span class="font-weight-bold">Carregando...</span>
                                        </div>
                                    </div>
                                    <?php Html::page_bread_crumb("/tarefas/kanban", $field_name, $field_value); ?>
                                    <div class="row gutter-lg page-data">
                                        <!--record-->
                                        <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                            $counter++;
                                        ?>
                                        <!--PageComponentStart-->
                                        <div class="col-sm-4 col-md-12" >
                                            <div class="card-4 mb-3" style="background: <?php echo ($data['users_cor_postit']); ?> !important">
                                            <div class="row gutter-sm justify-content-between" >
                                                <div class="col-12">
                                                    <div class="font-weight-bold">
                                                        <a href="<?php print_link("tarefas/view/$rec_id"); ?>" class="d-block card-link page-modal" style="color: <?php echo ($data['users_cor_letra']); ?> !important">
                                                        <?php echo ($data['titulo']); ?>
                                                    </a>
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
                                        $pager->ajax_page = true;
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
