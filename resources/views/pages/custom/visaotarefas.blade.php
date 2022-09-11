@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "VisaoTarefas";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 comp-grid" >
                    <div class=" "><br><br></div>
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
</div>
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
