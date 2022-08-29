<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Agenda_FablabAddRequest;
use App\Http\Requests\Agenda_FablabEditRequest;
use App\Models\Agenda_Fablab;
use Illuminate\Http\Request;
use Exception;
class Agenda_FablabController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.agenda_fablab.list";
		$query = Agenda_Fablab::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Agenda_Fablab::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "agenda_fablab.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Agenda_Fablab::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Agenda_Fablab::query();
		$record = $query->findOrFail($rec_id, Agenda_Fablab::viewFields());
		return $this->renderView("pages.agenda_fablab.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.agenda_fablab.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Agenda_FablabAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Agenda_Fablab record
		$record = Agenda_Fablab::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("agenda_fablab", "Registro adicionado com sucesso");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Agenda_FablabEditRequest $request, $rec_id = null){
		$query = Agenda_Fablab::query();
		$record = $query->findOrFail($rec_id, Agenda_Fablab::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("agenda_fablab", "Registro atualizado com sucesso");
		}
		return $this->renderView("pages.agenda_fablab.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Agenda_Fablab::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Registro excluído com sucesso");
	}
}
