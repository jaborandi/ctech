@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Compras";
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
                        Compras
                    </div>
                </div>
                <div class="col-md-auto " >
                    <a  class="btn btn-primary btn-block" href="<?php print_link("compras/add") ?>" >
                    <i class="material-icons">add</i>                               
                    Adicionar novo 
                </a>
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
                                                        <label class="font-weight-bold p-2">Filtrar por Status</label>
                                                        <div class="">
                                                            <?php
                                                                $options = Menu::status();
                                                                if(!empty($options)){
                                                                foreach($options as $option){
                                                                $value = $option['value'];
                                                                $label = $option['label'];
                                                                //check if current option is checked option
                                                                $checked = Html::get_field_checked('compras_status', $value);
                                                            ?>
                                                            <label class="form-check option-btn">
                                                            <input class="form-check-input" value="<?php echo $value ?>" <?php echo $checked ?> type="checkbox" name="compras_status[]" />
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
                                                        <label class="font-weight-bold p-2">Filtrar por data</label>
                                                        <div class="">
                                                            <input class="form-control datepicker"  value="<?php echo get_value('compras_data') ?>" type="datetime"  name="compras_data" placeholder="Defina um intervalo" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range"  />
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
                <div class="filter-tags mb-2">
                    <?php
                        Html::filter_tag('compras_status', 'Status', Menu::status());
                    ?>
                    <?php
                        Html::filter_tag_date('compras_data', 'Data', 'jS F, Y');
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
                                        $nav_link = add_query_params(array('orderby' => 'status' ));
                                    ?>
                                    <a class="dropdown-item <?php echo is_active_link('orderby', 'status'); ?>" href="<?php print_link($nav_link) ?>">
                                    Status
                                </a>
                                <?php 
                                    $nav_link = add_query_params(array('orderby' => 'urgencia' ));
                                ?>
                                <a class="dropdown-item <?php echo is_active_link('orderby', 'urgencia'); ?>" href="<?php print_link($nav_link) ?>">
                                Urgencia
                            </a>
                            <?php 
                                $nav_link = add_query_params(array('orderby' => 'valor' ));
                            ?>
                            <a class="dropdown-item <?php echo is_active_link('orderby', 'valor'); ?>" href="<?php print_link($nav_link) ?>">
                            Valor
                        </a>
                        <?php 
                            $nav_link = add_query_params(array('orderby' => 'data' ));
                        ?>
                        <a class="dropdown-item <?php echo is_active_link('orderby', 'data'); ?>" href="<?php print_link($nav_link) ?>">
                        Data
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
<div  class=" page-content" >
    <div id="compras-list-records">
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
                    <?php Html::page_bread_crumb("/compras/", $field_name, $field_value); ?>
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
                                <strong><?php echo $data['objeto']; ?></strong>
                                <br><i class="material-icons ">timelapse</i> <?php echo $data['status']; ?>
                                <br><br><?php if($data['link_referencia'] != '' AND $data['link_referencia'] != null){ ?>
                                <a href="<?php echo $data['link_referencia']; ?>" target="_blank">Link de Referência</a>
                                <?php } ?>
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown" >
                                        <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                        <i class="material-icons">menu</i> 
                                        </button>
                                        <ul class="dropdown-menu">
                                            <a class="dropdown-item page-modal"   href="<?php print_link("compras/view/$rec_id"); ?>">
                                            <i class="material-icons">visibility</i> Ver
                                        </a>
                                        <a class="dropdown-item page-modal"   href="<?php print_link("compras/edit/$rec_id"); ?>">
                                        <i class="material-icons">edit</i> Atualizar
                                    </a>
                                </ul>
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
