@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "Escola";
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
                        Bem vindo ao sistema do CTECH
                        <div class="text-muted text-small"> Use o menu abaixo para navegar entre as possibilidades </div>
                    </div>
                    <hr />
                </div>
                <div class="col-sm-6 comp-grid" >
                    <a  class="btn btn-primary btn-block" href="<?php print_link("agenda_cinema/index") ?>" >
                    Agenda do cinema 
                </a>
            </div>
            <div class="col-sm-6 comp-grid" >
                <a  class="btn btn-primary btn-block" href="<?php print_link("agenda_fablab/index") ?>" >
                Agenda do fablab 
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
