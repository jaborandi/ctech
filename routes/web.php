<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



	Route::get('', 'IndexController@index')->name('index');
	Route::get('index/login', 'IndexController@login')->name('login');
	
	
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Agenda_Cinema Controller */	
	Route::get('agenda_cinema', 'Agenda_CinemaController@index')->name('agenda_cinema.index');
	Route::get('agenda_cinema/index', 'Agenda_CinemaController@index')->name('agenda_cinema.index');
	Route::get('agenda_cinema/index/{filter?}/{filtervalue?}', 'Agenda_CinemaController@index')->name('agenda_cinema.index');	
	Route::get('agenda_cinema/view/{rec_id}', 'Agenda_CinemaController@view')->name('agenda_cinema.view');	
	Route::get('agenda_cinema/add', 'Agenda_CinemaController@add')->name('agenda_cinema.add');
	Route::post('agenda_cinema/store', 'Agenda_CinemaController@store')->name('agenda_cinema.store');
		
	Route::any('agenda_cinema/edit/{rec_id}', 'Agenda_CinemaController@edit')->name('agenda_cinema.edit');	
	Route::get('agenda_cinema/delete/{rec_id}', 'Agenda_CinemaController@delete');

/* routes for Agenda_Fablab Controller */	
	Route::get('agenda_fablab', 'Agenda_FablabController@index')->name('agenda_fablab.index');
	Route::get('agenda_fablab/index', 'Agenda_FablabController@index')->name('agenda_fablab.index');
	Route::get('agenda_fablab/index/{filter?}/{filtervalue?}', 'Agenda_FablabController@index')->name('agenda_fablab.index');	
	Route::get('agenda_fablab/view/{rec_id}', 'Agenda_FablabController@view')->name('agenda_fablab.view');	
	Route::get('agenda_fablab/add', 'Agenda_FablabController@add')->name('agenda_fablab.add');
	Route::post('agenda_fablab/store', 'Agenda_FablabController@store')->name('agenda_fablab.store');
		
	Route::any('agenda_fablab/edit/{rec_id}', 'Agenda_FablabController@edit')->name('agenda_fablab.edit');	
	Route::get('agenda_fablab/delete/{rec_id}', 'Agenda_FablabController@delete');

/* routes for Atividades Controller */	
	Route::get('atividades', 'AtividadesController@index')->name('atividades.index');
	Route::get('atividades/index', 'AtividadesController@index')->name('atividades.index');
	Route::get('atividades/index/{filter?}/{filtervalue?}', 'AtividadesController@index')->name('atividades.index');	
	Route::get('atividades/view/{rec_id}', 'AtividadesController@view')->name('atividades.view');	
	Route::get('atividades/add', 'AtividadesController@add')->name('atividades.add');
	Route::post('atividades/store', 'AtividadesController@store')->name('atividades.store');
		
	Route::any('atividades/edit/{rec_id}', 'AtividadesController@edit')->name('atividades.edit');	
	Route::get('atividades/delete/{rec_id}', 'AtividadesController@delete');

/* routes for Compras Controller */	
	Route::get('compras', 'ComprasController@index')->name('compras.index');
	Route::get('compras/index', 'ComprasController@index')->name('compras.index');
	Route::get('compras/index/{filter?}/{filtervalue?}', 'ComprasController@index')->name('compras.index');	
	Route::get('compras/view/{rec_id}', 'ComprasController@view')->name('compras.view');	
	Route::get('compras/add', 'ComprasController@add')->name('compras.add');
	Route::post('compras/store', 'ComprasController@store')->name('compras.store');
		
	Route::any('compras/edit/{rec_id}', 'ComprasController@edit')->name('compras.edit');	
	Route::get('compras/delete/{rec_id}', 'ComprasController@delete');

/* routes for Tarefas Controller */	
	Route::get('tarefas', 'TarefasController@index')->name('tarefas.index');
	Route::get('tarefas/index', 'TarefasController@index')->name('tarefas.index');
	Route::get('tarefas/index/{filter?}/{filtervalue?}', 'TarefasController@index')->name('tarefas.index');	
	Route::get('tarefas/view/{rec_id}', 'TarefasController@view')->name('tarefas.view');	
	Route::get('tarefas/add', 'TarefasController@add')->name('tarefas.add');
	Route::post('tarefas/store', 'TarefasController@store')->name('tarefas.store');
		
	Route::any('tarefas/edit/{rec_id}', 'TarefasController@edit')->name('tarefas.edit');Route::any('tarefas/editfield/{rec_id}', 'TarefasController@editfield');	
	Route::get('tarefas/delete/{rec_id}', 'TarefasController@delete');	
	Route::get('tarefas/atribuidas', 'TarefasController@atribuidas');
	Route::get('tarefas/atribuidas/{filter?}/{filtervalue?}', 'TarefasController@atribuidas');

/* routes for Users Controller */	
	Route::get('users', 'UsersController@index')->name('users.index');
	Route::get('users/index', 'UsersController@index')->name('users.index');
	Route::get('users/index/{filter?}/{filtervalue?}', 'UsersController@index')->name('users.index');	
	Route::get('users/view/{rec_id}', 'UsersController@view')->name('users.view');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::get('users/add', 'UsersController@add')->name('users.add');
	Route::post('users/store', 'UsersController@store')->name('users.store');
		
	Route::any('users/edit/{rec_id}', 'UsersController@edit')->name('users.edit');	
	Route::get('users/delete/{rec_id}', 'UsersController@delete');
});


	
Route::get('componentsdata/tags_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->tags_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/usuarios_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->usuarios_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_name_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_name_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_email_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_tarefasaguardando',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_tarefasaguardando($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_tarefasemprogresso',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_tarefasemprogresso($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_tarefas_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_tarefas_2($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');