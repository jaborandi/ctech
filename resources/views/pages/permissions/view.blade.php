@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("permissions/add");
    $can_edit = $user->can("permissions/edit");
    $can_view = $user->can("permissions/view");
    $can_delete = $user->can("permissions/delete");
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
                        Visão
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
                                        <div class="border-top td-id p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Id</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['id'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-name p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Name</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['name'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-guard_name p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Guard Name</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['guard_name'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-created_at p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Created At</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['created_at'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-updated_at p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Updated At</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['updated_at'] ; ?>
                                                    </div>
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
                                                    <a class="dropdown-item "   href="<?php print_link("permissions/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="dropdown-item record-delete-btn" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="modal" href="<?php print_link("permissions/delete/$rec_id"); ?>">
                                                <i class="material-icons">clear</i> Delete
                                            </a>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Table Body End -->
                        </div>
                        <!-- Detail Page Column -->
                        <?php if(!request()->has('subpage')){ ?>
                        <div class="col-12">
                            <div class="my-3 ">
                                @include("pages.permissions.detail-pages", ["masterRecordId" => $rec_id])
                            </div>
                        </div>
                        <?php } ?>
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
