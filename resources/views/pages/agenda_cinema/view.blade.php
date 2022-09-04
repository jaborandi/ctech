@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("agenda_cinema/add");
    $can_edit = $user->can("agenda_cinema/edit");
    $can_view = $user->can("agenda_cinema/view");
    $can_delete = $user->can("agenda_cinema/delete");
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
                        Detalhes da agenda
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
                                        <h3 class='text-center'><?php echo $data['titulo']; ?></h3><br>
                                        <p class="font-weight-light text-center"><?php echo $data['observacoes']; ?></p>
                                        <?php if($data['confirmacao'] == '#6c757d'){ ?>
                                        <p class='text-center' style='color: #6c757d'>AGUARDANDO CONFIRMAÇÃO</p>
                                        <?php } else if($data['confirmacao'] == '#28a745'){?>
                                        <p class='text-center' style='color: #28a745'>CONFIRMADO</p>
                                        <?php } else { ?>
                                        <p class='text-center' style='color: #dc3545'>CANCELADO</p>
                                        <?php } ?>
                                        <p class='text-center'><i class="material-icons ">today</i>Agendado para o dia <strong><?php echo format_date( $data['data_inicio'] , 'd/m/Y'); ?> às <?php echo format_date( $data['hora_inicio'] , 'H:i'); ?> horas</strong></p>
                                        <!--PageComponentEnd-->
                                        <div class="d-flex q-col-gutter-xs justify-btween">
                                            <div class="dropdown" >
                                                <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                <i class="material-icons">menu</i> 
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if($can_edit){ ?>
                                                    <a class="dropdown-item page-modal"   href="<?php print_link("agenda_cinema/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Editar
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="dropdown-item record-delete-btn" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="modal" href="<?php print_link("agenda_cinema/delete/$rec_id"); ?>">
                                                <i class="material-icons">clear</i> Apagar
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
