<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\TarefasAddRequest;
use App\Http\Requests\TarefasEditRequest;
use App\Models\Tarefas;
use Illuminate\Http\Request;
use Exception;
class TarefasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.tarefas.list";
		$query = Tarefas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Tarefas::search($query, $search); // search table records
		}
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("tarefas.id", "DESC");
		}
		$query->where("usuarios", "=" , auth()->user()->id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->tarefas_status){
			$vals = $request->tarefas_status;
			$query->whereIn("tarefas.status", $vals);
		}
		if($request->tarefas_fazer_ate){
			$vals = explode("-to-",$request->tarefas_fazer_ate);
			$fromDate = $vals[0] ?? null;
			$toDate = $vals[1] ?? null;
			if($fromDate && $toDate){
				$query->whereRaw("tarefas.fazer_ate BETWEEN ? AND ?", [$fromDate, $toDate]);
			}
			elseif($fromDate){
				$query->whereRaw("tarefas.fazer_ate >= ?", [$fromDate]);
			}
			elseif($toDate){
				$query->whereRaw("tarefas.fazer_ate <= ?", [$toDate]);
			}
		}
		$records = $query->paginate($limit, Tarefas::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Tarefas::query();
		$record = $query->findOrFail($rec_id, Tarefas::viewFields());
		return $this->renderView("pages.tarefas.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.tarefas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(TarefasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['inserido_por'] = auth()->user()->name;
		
		//save Tarefas record
		$record = Tarefas::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("tarefas", "Registro adicionado com sucesso");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(TarefasEditRequest $request, $rec_id = null){
		$query = Tarefas::query();
		$record = $query->findOrFail($rec_id, Tarefas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("tarefas", "Registro atualizado com sucesso");
		}
		return $this->renderView("pages.tarefas.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Tarefas::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Registro excluído com sucesso");
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function atribuidas(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.tarefas.atribuidas";
		$query = Tarefas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Tarefas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "tarefas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("inserido_por", "=" , auth()->user()->name);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->tarefas_status){
			$vals = $request->tarefas_status;
			$query->whereIn("tarefas.status", $vals);
		}
		if($request->tarefas_fazer_ate){
			$vals = explode("-to-",$request->tarefas_fazer_ate);
			$fromDate = $vals[0] ?? null;
			$toDate = $vals[1] ?? null;
			if($fromDate && $toDate){
				$query->whereRaw("tarefas.fazer_ate BETWEEN ? AND ?", [$fromDate, $toDate]);
			}
			elseif($fromDate){
				$query->whereRaw("tarefas.fazer_ate >= ?", [$fromDate]);
			}
			elseif($toDate){
				$query->whereRaw("tarefas.fazer_ate <= ?", [$toDate]);
			}
		}
		$records = $query->paginate($limit, Tarefas::atribuidasFields());
		return $this->renderView($view, compact("records"));
	}
}
