<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Agenda_CinemaAddRequest;
use App\Http\Requests\Agenda_CinemaEditRequest;
use App\Models\Agenda_Cinema;
use Illuminate\Http\Request;
use Exception;
class Agenda_CinemaController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.agenda_cinema.list";
		$query = Agenda_Cinema::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Agenda_Cinema::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "agenda_cinema.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Agenda_Cinema::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Agenda_Cinema::query();
		$record = $query->findOrFail($rec_id, Agenda_Cinema::viewFields());
		return $this->renderView("pages.agenda_cinema.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.agenda_cinema.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Agenda_CinemaAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Agenda_Cinema record
		$record = Agenda_Cinema::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("agenda_cinema", "Registro adicionado com sucesso");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Agenda_CinemaEditRequest $request, $rec_id = null){
		$query = Agenda_Cinema::query();
		$record = $query->findOrFail($rec_id, Agenda_Cinema::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("agenda_cinema", "Registro atualizado com sucesso");
		}
		return $this->renderView("pages.agenda_cinema.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Agenda_Cinema::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Registro excluído com sucesso");
	}
}
