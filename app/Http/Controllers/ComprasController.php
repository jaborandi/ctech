<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComprasAddRequest;
use App\Http\Requests\ComprasEditRequest;
use App\Models\Compras;
use Illuminate\Http\Request;
use Exception;
class ComprasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.compras.list";
		$query = Compras::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Compras::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "compras.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->compras_status){
			$vals = $request->compras_status;
			$query->whereIn("compras.status", $vals);
		}
		if($request->compras_urgencia){
			$vals = $request->compras_urgencia;
			$query->whereIn("compras.urgencia", $vals);
		}
		if($request->compras_data){
			$vals = explode("-to-",$request->compras_data);
			$fromDate = $vals[0] ?? null;
			$toDate = $vals[1] ?? null;
			if($fromDate && $toDate){
				$query->whereRaw("compras.data BETWEEN ? AND ?", [$fromDate, $toDate]);
			}
			elseif($fromDate){
				$query->whereRaw("compras.data >= ?", [$fromDate]);
			}
			elseif($toDate){
				$query->whereRaw("compras.data <= ?", [$toDate]);
			}
		}
		$records = $query->paginate($limit, Compras::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Compras::query();
		$record = $query->findOrFail($rec_id, Compras::viewFields());
		return $this->renderView("pages.compras.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.compras.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ComprasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['adicionado_por'] = auth()->user()->name;
		
		//save Compras record
		$record = Compras::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("compras", "Registro adicionado com sucesso");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ComprasEditRequest $request, $rec_id = null){
		$query = Compras::query();
		$record = $query->findOrFail($rec_id, Compras::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("compras", "Registro atualizado com sucesso");
		}
		return $this->renderView("pages.compras.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Compras::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Registro excluído com sucesso");
	}
}
