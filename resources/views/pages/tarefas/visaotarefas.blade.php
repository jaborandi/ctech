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
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 comp-grid" >
                    <div class=" "><br><br>
                        <meta http-equiv="refresh" content="5">
                        <style>
                        #topbar {
                        display:none !important;
                        }
                        #sidebar {
                        display:none !important;
                        }
                        .footer {
                        display:none !important;
                        }
                        #main-content{
                        position: relative !important;
                        }
                    </style></div>
                    <div class=" h5 font-weight-bold text-center" >
                        Tarefas do time nessa semana
                        <div class="text-muted text-small"> Clique nos cards para visualizar ou atualizar </div>
                    </div>
                    <hr />
                </div>
                <div class="col-4 card-4 m-2 comp-grid" >
                    <div class=" h5 font-weight-bold" >
                        A fazer
                    </div>
                    <hr />
                    <div class=" ">
                        <?php
                            $params = ['show_header' => false, 'show_footer' => false, 'orderby' => 'tarefas.id', 'ordertype' => 'ASC', 'limit' => 10]; //new query param
                            $query = array_merge(request()->query(), $params);
                            $queryParams = http_build_query($query);
                            $url = url("tarefas/kanban/tarefas.status/AGUARDANDO?$queryParams");
                        ?>
                        <div class="ajax-inline-page" data-url="{{ $url }}" >
                            <div class="ajax-page-load-indicator">
                                <div class="text-center d-flex justify-content-center load-indicator">
                                    <span class="loader mr-3"></span>
                                    <span class="font-weight-bold">Carregando...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 card-4 m-2 comp-grid" >
                    <div class=" h5 font-weight-bold" >
                        Fazendo
                    </div>
                    <hr />
                    <div class=" ">
                        <?php
                            $params = ['show_header' => false, 'show_footer' => false, 'orderby' => 'tarefas.id', 'ordertype' => 'ASC', 'limit' => 10]; //new query param
                            $query = array_merge(request()->query(), $params);
                            $queryParams = http_build_query($query);
                            $url = url("tarefas/kanban/tarefas.status/EM PROGRESSO?$queryParams");
                        ?>
                        <div class="ajax-inline-page" data-url="{{ $url }}" >
                            <div class="ajax-page-load-indicator">
                                <div class="text-center d-flex justify-content-center load-indicator">
                                    <span class="loader mr-3"></span>
                                    <span class="font-weight-bold">Carregando...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 card-4 m-2 comp-grid" >
                    <div class=" h5 font-weight-bold" >
                        Feito
                    </div>
                    <hr />
                    <div class=" ">
                        <?php
                            $params = ['show_header' => false, 'show_footer' => false, 'orderby' => 'tarefas.id', 'ordertype' => 'ASC', 'limit' => 10]; //new query param
                            $query = array_merge(request()->query(), $params);
                            $queryParams = http_build_query($query);
                            $url = url("tarefas/kanban/tarefas.status/CONCLUÍDA?$queryParams");
                        ?>
                        <div class="ajax-inline-page" data-url="{{ $url }}" >
                            <div class="ajax-page-load-indicator">
                                <div class="text-center d-flex justify-content-center load-indicator">
                                    <span class="loader mr-3"></span>
                                    <span class="font-weight-bold">Carregando...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid" >
                    <?php Html::display_page_errors($errors); ?>
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
