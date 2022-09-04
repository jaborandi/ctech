@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("atividades/add");
    $can_edit = $user->can("atividades/edit");
    $can_view = $user->can("atividades/view");
    $can_delete = $user->can("atividades/delete");
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
                        Detalhes da atividade
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
                                        <strong><?php echo $data['titulo']; ?></strong>
                                        <span class="font-weight-light text-muted "><?php echo $data['descricao']; ?></span>
                                        <strong>Disciplina: </strong> <?php echo $data['disciplina']; ?><br>
                                        <strong>Duração estimada: </strong><?php echo $data['duracao']; ?> minutos<br>
                                        <strong>Tags: </strong><?php 
                                            $dados = $data['tags'];
                                            $matriz = explode(',',$dados);
                                            foreach($matriz as $valores){
                                            echo'<span class="badge badge-pill badge-warning">'. $valores .'</span>  ';
                                            }
                                        ?>
                                        <div class="border-top td-arquivos p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Arquivos</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['arquivos'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--PageComponentEnd-->
                                        <div class="d-flex q-col-gutter-xs justify-btween">
                                            <?php if($can_edit){ ?>
                                            <a class="mx-1 btn btn-sm btn-success has-tooltip "   title="Editar" href="<?php print_link("atividades/edit/$rec_id"); ?>">
                                            <i class="material-icons">edit</i> Editar
                                        </a>
                                        <?php } ?>
                                        <?php if($can_delete){ ?>
                                        <a class="mx-1 btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="modal" title="Editar" href="<?php print_link("atividades/delete/$rec_id"); ?>">
                                        <i class="material-icons">clear</i> Apagar
                                    </a>
                                    <?php } ?>
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
