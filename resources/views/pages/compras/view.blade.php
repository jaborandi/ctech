@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Visão";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3" >
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto " >
                    <div class=" h5 font-weight-bold text-primary" >
                        Pedido de compra
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid" >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class=" page-content" >
                        <?php
                            $counter = 0;
                            if($data){
                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class="">
                            <div class="row">
                                <div class="col">
                                    <!-- Table Body Start -->
                                    <div class="page-data">
                                        <!--PageComponentStart-->
                                        <div class="border-top td-status p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="material-icons ">timelapse</i></div>
                                                <div class="col">
                                                    <div class="text-muted"> Status</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['status'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <strong style="padding-left:20px;padding-right:20px;"><?php echo $data['objeto']; ?></strong>
                                        <p class="font-weight-light" style="padding-left:20px;padding-right:20px;"><?php echo $data['observacoes']; ?></p>
                                        <div class="border-top td-data p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Data</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo format_date( $data['data'] , 'd/m/Y'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($data['link_referencia'] != '' AND $data['link_referencia'] != null){ ?>
                                        <a href="<?php echo $data['link_referencia']; ?>" target="_blank">Link de Referência</a>
                                        <?php } ?>
                                        <br><strong>Requisitado por: </strong><?php echo $data['adicionado_por']; ?><br>
                                        <!--PageComponentEnd-->
                                        <div class="d-flex q-col-gutter-xs justify-btween">
                                            <div class="dropdown" >
                                                <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                <i class="material-icons">menu</i> 
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a class="dropdown-item "   href="<?php print_link("compras/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <a class="dropdown-item record-delete-btn" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="modal" href="<?php print_link("compras/delete/$rec_id"); ?>">
                                                <i class="material-icons">clear</i> Delete
                                            </a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Table Body End -->
                        </div>
                    </div>
                </div>
                <?php
                    }
                    else{
                ?>
                <!-- Empty Record Message -->
                <div class="text-muted p-3">
                    <i class="material-icons">block</i> Nenhum Registro Encontrado
                </div>
                <?php
                    }
                ?>
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
