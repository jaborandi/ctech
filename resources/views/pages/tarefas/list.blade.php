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
            <div class="col-md-3 comp-grid" >
                <form method="get" action="" class="form">
                    <div class="q-mb-sm q-pa-sm ">
                        <label class="font-weight-bold p-2">Filtrar por Status</label>
                        <div class="">
                            <?php
                                $options = Menu::status2();
                                if(!empty($options)){
                                foreach($options as $option){
                                $value = $option['value'];
                                $label = $option['label'];
                                //check if current option is checked option
                                $checked = Html::get_field_checked('tarefas_status', $value);
                            ?>
                            <label class="custom-control custom-checkbox option-btn">
                            <input class="custom-control-input" value="<?php echo $value ?>" <?php echo $checked ?> type="checkbox" name="tarefas_status[]" />
                            <span class="custom-control-label"><?php echo $label ?></span>
                            </label>
                            <?php
                                }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="q-mb-sm q-pa-sm ">
                        <label class="font-weight-bold p-2">Filtrar por data limite</label>
                        <div class="">
                            <input class="form-control datepicker"  value="<?php echo get_value('tarefas_fazer_ate') ?>" type="datetime"  name="tarefas_fazer_ate" placeholder="Clique para selecionar" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range"  />
                        </div>
                    </div>
                    <hr />
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Filtrar</button>
                    </div>
                </form>
            </div>
            <div class="col-md-9 comp-grid" >
                <?php Html::display_page_errors($errors); ?>
                <div class="filter-tags mb-2">
                    <?php
                        Html::filter_tag('tarefas_status', 'Status', Menu::status2());
                    ?>
                    <?php
                        Html::filter_tag_date('tarefas_fazer_ate', 'Fazer Ate', 'jS F, Y');
                    ?>
                </div>
                <div class="">
                    <div class="row gutter-sm">
                        <div class="col">
                            <div class="dropdown" >
                                <button class="btn btn-outline-primary btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">sort</i> Ordenar por
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php 
                                        $nav_link = add_query_params(array('orderby' => 'fazer_ate' ));
                                    ?>
                                    <a class="dropdown-item <?php echo is_active_link('orderby', 'fazer_ate'); ?>" href="<?php print_link($nav_link) ?>">
                                    Data limite
                                </a>
                                <?php 
                                    $nav_link = add_query_params(array('orderby' => 'prioridade' ));
                                ?>
                                <a class="dropdown-item <?php echo is_active_link('orderby', 'prioridade'); ?>" href="<?php print_link($nav_link) ?>">
                                Prioridade
                            </a>
                            <?php 
                                $nav_link = add_query_params(array('orderby' => 'inserido_em' ));
                            ?>
                            <a class="dropdown-item <?php echo is_active_link('orderby', 'inserido_em'); ?>" href="<?php print_link($nav_link) ?>">
                            Inserido Em
                        </a>
                        <?php 
                            $nav_link = add_query_params(array('orderby' => 'atualizado_em' ));
                        ?>
                        <a class="dropdown-item <?php echo is_active_link('orderby', 'atualizado_em'); ?>" href="<?php print_link($nav_link) ?>">
                        Atualizado Em
                    </a>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="btn-group btn-group-toggle">
                <?php 
                    $orderType = strtolower(get_value('ordertype'));
                ?>
                <a href="{{ add_query_params(['ordertype' => 'asc' ]) }}" class="btn btn-outline-primary btn-toggle <?php echo ($orderType == 'asc' ? 'active': null); ?>">
                Asc
            </a>
            <a href="{{ add_query_params(['ordertype' => 'desc' ]) }}" class="btn btn-outline-primary btn-toggle <?php echo ($orderType == 'desc' ? 'active': null); ?>">
            Desc
        </a>
    </div>
</div>
</div>
</div>
<div class=" "><br><br></div>
<div  class=" page-content" >
    <div id="tarefas-list-records">
        <div class="row">
            <div class="col">
                <?php
                    if($total_records){
                ?>
                <div id="page-main-content">
                    <?php Html::page_bread_crumb("/tarefas/", $field_name, $field_value); ?>
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
                                    <div class="col-2">
                                        <img width="" height="" src="{{ getImgSizePath($data['status'], 'medium') }}" class="img-fluid" />
                                    </div>
                                    <div class="col">
                                        <h6 class="text-primary text-bold">
                                        <?php echo ($data['titulo']); ?>
                                        </h6>
                                        <div class="text-muted"><?php echo str_truncate($data['descricao'], 100,'...'); ?></div>
                                        <small class="text-muted"><?php echo format_date($data['fazer_ate'], 'd/m/Y'); ?> </small>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex justify-content-between">
                                            <div class="dropdown" >
                                                <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                <i class="material-icons">menu</i> 
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a class="dropdown-item page-modal"   href="<?php print_link("tarefas/view/$rec_id"); ?>">
                                                    <i class="material-icons">visibility</i> Detalhes
                                                </a>
                                                <a class="dropdown-item page-modal"   href="<?php print_link("tarefas/edit/$rec_id"); ?>">
                                                <i class="material-icons">edit</i> Responder
                                            </a>
                                            <a class="dropdown-item record-delete-btn" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="modal" href="<?php print_link("tarefas/delete/$rec_id"); ?>">
                                            <i class="material-icons">clear</i> Excluir
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
