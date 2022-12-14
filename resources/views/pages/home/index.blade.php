@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "Home";
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
                            $url = url("tarefas/kanban/tarefas.status/CONCLU??DA?$queryParams");
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
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 comp-grid" >
                    <div class=" "><br><br></div>
                    <div class=" h5 font-weight-bold text-center" >
                        Resumo das minhas tarefas
                        <div class="text-muted text-small"> Todas as tarefas atribu??das a mim </div>
                    </div>
                    <hr />
                </div>
                <div class="col-3 comp-grid" >
                    <?php $rec_count = $comp_model->getcount_afazer();  ?>
                    <a class="animated zoomIn record-count "  href='<?php print_link("tarefas?tarefas_status%5B%5D=AGUARDANDO&tarefas_fazer_ate=") ?>' style="background:#FFCC00;
                    color:white;">
                    <div class="row gutter-sm">
                        <div class="col-auto" style="opacity: 1;">
                            <i class="material-icons" style="color:white">access_alarm</i>
                        </div>
                        <div class="col">
                            <div class="flex-column justify-content align-center">
                                <div class="title">A fazer</div>
                                <small class=""></small>
                            </div>
                            <h4 class="value"><?php echo $rec_count; ?></h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 comp-grid" >
                <?php $rec_count = $comp_model->getcount_fazendo();  ?>
                <a class="animated zoomIn record-count "  href='<?php print_link("tarefas?tarefas_status%5B%5D=EM+PROGRESSO&tarefas_fazer_ate=") ?>' style="background:#82B1FF;
                color:white;">
                <div class="row gutter-sm">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons" style="color:white">assignment</i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">Fazendo</div>
                            <small class=""></small>
                        </div>
                        <h4 class="value"><?php echo $rec_count; ?></h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3 comp-grid" >
            <?php $rec_count = $comp_model->getcount_feitas();  ?>
            <a class="animated zoomIn record-count "  href='<?php print_link("tarefas?tarefas_status%5B%5D=CONCLU??DA&tarefas_fazer_ate=") ?>' style="background: #4caf50;
            color: white;">
            <div class="row gutter-sm">
                <div class="col-auto" style="opacity: 1;">
                    <i class="material-icons" style="color:white">check_circle</i>
                </div>
                <div class="col">
                    <div class="flex-column justify-content align-center">
                        <div class="title">Feitas</div>
                        <small class=""></small>
                    </div>
                    <h4 class="value"><?php echo $rec_count; ?></h4>
                </div>
            </div>
        </a>
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
