@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("users/add");
    $can_edit = $user->can("users/edit");
    $can_view = $user->can("users/view");
    $can_delete = $user->can("users/delete");
    $pageTitle = "Minha conta";
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
                        Minha conta
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
                        <div class="bg-primary m-2 mb-4">
                            <div class="profile">
                                <div class="avatar">
                                    <?php 
                                        $user_photo = $user->UserPhoto();
                                        if($user_photo){
                                        Html::page_img($user_photo, 100, 100, "small", "large"); 
                                        }
                                    ?>
                                </div>
                                <h1 class="title mt-4"><?php echo $data['name']; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mx-3 mb-3">
                                    <ul class="nav nav-pills flex-column text-left">
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageView" class="nav-link active">
                                                <i class="material-icons">account_box</i> detalhe da conta
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageEdit" class="nav-link">
                                                <i class="material-icons">edit</i> Editar conta
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageChangePassword" class="nav-link">
                                                <i class="material-icons">lock</i> Mudar senha
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <div class="tab-content">
                                        <div class="tab-pane show active fade" id="AccountPageView" role="tabpanel">
                                            <table class="table   ">
                                                <tbody class="page-data">
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
                                                    <div class="border-top td-phone p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> Phone</div>
                                                                <div class="font-weight-bold">
                                                                    <?php echo  $data['phone'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-email p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> Email</div>
                                                                <div class="font-weight-bold">
                                                                    <?php echo  $data['email'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-cor_postit p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> Cor Postit</div>
                                                                <div class="font-weight-bold">
                                                                    <?php echo  $data['cor_postit'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-cor_letra p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> Cor Letra</div>
                                                                <div class="font-weight-bold">
                                                                    <?php echo  $data['cor_letra'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tbody>    
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="AccountPageEdit" role="tabpanel">
                                            <div class=" reset-grids">
                                                <x-sub-page url="{{ url('account/edit') }}"></x-sub-page>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="AccountPageChangePassword" role="tabpanel">
                                            <div class=" reset-grids">
                                                @include("pages.account.changepassword")
                                            </div>
                                        </div>
                                    </div>
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
<!--custom page css--><!--pagecss-->
@endsection
@section('pagejs')
<!--custom page js--><!--pagejs-->
@endsection
