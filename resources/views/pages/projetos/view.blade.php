@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("projetos/add");
    $can_edit = $user->can("projetos/edit");
    $can_view = $user->can("projetos/view");
    $can_delete = $user->can("projetos/delete");
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
                        Detalhes do projeto
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
                                        <?php 
                                            Html :: page_img($data['imagem'],200,200, "", "", 1); 
                                        ?>
                                        <strong><?php echo $data['titulo']; ?></strong>
                                        <?php echo $data['descricao']; ?>
                                        <br><br><h5>Dados Adicionais</h5>
                                        <strong>Categoria: </strong><?php echo $data['categoria']; ?><br>
                                        <strong>Inserido por: </strong><?php echo $data['inserido_por']; ?><br>
                                        <strong>Inserido em: </strong><?php echo $data['inserido_em']; ?><br>
                                        <strong>Atualizado em: </strong><?php echo $data['atualizado_em']; ?>
                                        <div class="border-top td-arquivos p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Arquivos</div>
                                                    <div class="font-weight-bold"><?php Html :: page_link_file($data['arquivos']); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--PageComponentEnd-->
                                        <div class="d-flex q-col-gutter-xs justify-btween">
                                            <div class="dropdown" >
                                                <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                <i class="material-icons">menu</i> 
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if($can_edit){ ?>
                                                    <a class="dropdown-item "   href="<?php print_link("projetos/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="dropdown-item record-delete-btn" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="modal" href="<?php print_link("projetos/delete/$rec_id"); ?>">
                                                <i class="material-icons">clear</i> Delete
                                            </a>
                                            <?php } ?>
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
