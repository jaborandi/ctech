@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "Home";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="card-4 bg-light mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid" >
                    <div class=" h5 font-weight-bold" >
                        Estatísticas
                        <div class="text-muted text-small"> Em construção </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-4 comp-grid" >
                    <?php $rec_count = $comp_model->getcount_tarefasaguardando();  ?>
                    <a class="animated zoomIn record-count "  href='<?php print_link("tarefas?tarefas_status%5B%5D=AGUARDANDO&tarefas_fazer_ate=") ?>' style="background:#FFCC00;
                    color:white;">
                    <div class="row gutter-sm">
                        <div class="col-auto" style="opacity: 1;">
                            <i class="material-icons" style="color:white">access_alarm</i>
                        </div>
                        <div class="col">
                            <div class="flex-column justify-content align-center">
                                <div class="title">Tarefas Aguardando</div>
                                <small class=""></small>
                            </div>
                            <h4 class="value"><?php echo $rec_count; ?></h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 comp-grid" >
                <?php $rec_count = $comp_model->getcount_tarefasemprogresso();  ?>
                <a class="animated zoomIn record-count "  href='<?php print_link("tarefas?tarefas_status%5B%5D=EM+PROGRESSO&tarefas_fazer_ate=") ?>' style="background:#82B1FF;
                color:white;">
                <div class="row gutter-sm">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons" style="color:white">assignment</i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">Tarefas em Progresso</div>
                            <small class=""></small>
                        </div>
                        <h4 class="value"><?php echo $rec_count; ?></h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-4 comp-grid" >
            <?php $rec_count = $comp_model->getcount_tarefas_2();  ?>
            <a class="animated zoomIn record-count "  href='<?php print_link("tarefas?tarefas_status%5B%5D=CONCLUÍDA&tarefas_fazer_ate=") ?>' style="background: #4caf50;
            color: white;">
            <div class="row gutter-sm">
                <div class="col-auto" style="opacity: 1;">
                    <i class="material-icons" style="color:white">check_circle</i>
                </div>
                <div class="col">
                    <div class="flex-column justify-content align-center">
                        <div class="title">Tarefas Concluídas</div>
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
