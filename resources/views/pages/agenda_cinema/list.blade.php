@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("agenda_cinema/add");
    $can_edit = $user->can("agenda_cinema/edit");
    $can_view = $user->can("agenda_cinema/view");
    $can_delete = $user->can("agenda_cinema/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Agenda Cinema";
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
                        Agenda Cinema
                    </div>
                </div>
                <div class="col-md-auto " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("agenda_cinema/add") ?>" >
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
                @include("pages.agenda_cinema-list-page-calendar")
                <div  class="d-none page-content" >
                    <div id="agenda_cinema-list-records">
                        <div class="row">
                            <div class="col">
                                <div id="page-main-content" class="table-responsive">
                                    <?php Html::page_bread_crumb("/agenda_cinema/", $field_name, $field_value); ?>
                                    <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header ">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                <span class="custom-control-label"></span>
                                                </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-id" > Id</th>
                                                <th class="td-titulo" > Titulo</th>
                                                <th class="td-observacoes" > Observacoes</th>
                                                <th class="td-confirmacao" > Confirmacao</th>
                                                <th class="td-data_inicio" > Data Inicio</th>
                                                <th class="td-hora_inicio" > Hora Inicio</th>
                                                <th class="td-data_termino" > Data Termino</th>
                                                <th class="td-hora_termino" > Hora Termino</th>
                                                <th class="td-inserido_por" > Inserido Por</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                            if($total_records){
                                        ?>
                                        <tbody class="page-data">
                                            <!--record-->
                                            <?php
                                                $counter = 0;
                                                foreach($records as $data){
                                                $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                                $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <td class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                    <span class="custom-control-label"></span>
                                                    </label>
                                                </td>
                                                <?php } ?>
                                                <!--PageComponentStart-->
                                                <td class="td-id">
                                                    <a href="<?php print_link("agenda_cinema/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                                </td>
                                                <td class="td-titulo">
                                                    <?php echo  $data['titulo'] ; ?>
                                                </td>
                                                <td class="td-observacoes">
                                                    <?php echo  $data['observacoes'] ; ?>
                                                </td>
                                                <td class="td-confirmacao">
                                                    <?php echo  $data['confirmacao'] ; ?>
                                                </td>
                                                <td class="td-data_inicio">
                                                    <span title="<?php echo human_datetime($data['data_inicio']); ?>" class="has-tooltip">
                                                    <?php echo relative_date($data['data_inicio']); ?>
                                                    </span>
                                                </td>
                                                <td class="td-hora_inicio">
                                                    <?php echo  $data['hora_inicio'] ; ?>
                                                </td>
                                                <td class="td-data_termino">
                                                    <span title="<?php echo human_datetime($data['data_termino']); ?>" class="has-tooltip">
                                                    <?php echo relative_date($data['data_termino']); ?>
                                                    </span>
                                                </td>
                                                <td class="td-hora_termino">
                                                    <?php echo  $data['hora_termino'] ; ?>
                                                </td>
                                                <td class="td-inserido_por">
                                                    <?php echo  $data['inserido_por'] ; ?>
                                                </td>
                                                <!--PageComponentEnd-->
                                                <td class="td-btn">
                                                    <div class="dropdown" >
                                                        <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                        <i class="material-icons">menu</i> 
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php if($can_view){ ?>
                                                            <a class="dropdown-item "   href="<?php print_link("agenda_cinema/view/$rec_id"); ?>">
                                                            <i class="material-icons">visibility</i> View
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="dropdown-item "   href="<?php print_link("agenda_cinema/edit/$rec_id"); ?>">
                                                        <i class="material-icons">edit</i> Edit
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_delete){ ?>
                                                    <a class="dropdown-item record-delete-btn" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="modal" href="<?php print_link("agenda_cinema/delete/$rec_id"); ?>">
                                                    <i class="material-icons">clear</i> Delete
                                                </a>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                ?>
                                <!--endrecord-->
                            </tbody>
                            <tbody class="search-data"></tbody>
                            <?php
                                }
                                else{
                            ?>
                            <tbody class="page-data">
                                <tr>
                                    <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                                        <i class="material-icons">block</i> Nenhum Registro Encontrado
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                    <?php
                        if($show_footer){
                    ?>
                    <div class="">
                        <div class="row justify-content-center">    
                            <div class="col-md-auto justify-content-center">    
                                <div class="p-3 d-flex justify-content-between">    
                                    <?php if($can_delete){ ?>
                                    <button data-prompt-msg="Tem certeza de que deseja excluir esses registros?
                                    " data-display-style="modal" data-url="<?php print_link("agenda_cinema/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                    <i class="material-icons">clear</i> Excluir selecionado
                                    </button>
                                    <?php } ?>
                                </div>
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
