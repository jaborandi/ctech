@inject('comp_model', 'App\Models\ComponentsData')
<?php
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
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
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
                    <a  class="btn btn-primary btn-block" href="<?php print_link("tarefas/add") ?>" >
                    <i class="material-icons">add</i>                               
                    Adicionar novo 
                </a>
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
                    <div id="tarefas-atribuidas-records">
                        <div class="row">
                            <div class="col">
                                <?php
                                    if($total_records){
                                ?>
                                <div id="page-main-content">
                                    <?php Html::page_bread_crumb("/tarefas/atribuidas", $field_name, $field_value); ?>
                                    <div class="row gutter-lg page-data">
                                        <!--record-->
                                        <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                            $counter++;
                                        ?>
                                        <!--PageComponentStart-->
                                        <div class="col-sm-4 col-md-3">
                                            <div class="card-4 mb-3">
                                                <div class="row gutter-sm">
                                                    <div class="col">
                                                        field
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="dropdown" >
                                                                <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                                <i class="material-icons">menu</i> 
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <a class="dropdown-item "   href="<?php print_link("tarefas/view/$rec_id"); ?>">
                                                                    <i class="material-icons">visibility</i> View
                                                                </a>
                                                                <a class="dropdown-item "   href="<?php print_link("tarefas/edit/$rec_id"); ?>">
                                                                <i class="material-icons">edit</i> Edit
                                                            </a>
                                                            <a class="dropdown-item record-delete-btn" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="modal" href="<?php print_link("tarefas/delete/$rec_id"); ?>">
                                                            <i class="material-icons">clear</i> Delete
                                                        </a>
                                                    </ul>
                                                </div>
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
