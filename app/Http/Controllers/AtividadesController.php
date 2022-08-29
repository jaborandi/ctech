<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AtividadesAddRequest;
use App\Http\Requests\AtividadesEditRequest;
use App\Models\Atividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class AtividadesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.atividades.list";
		$query = Atividades::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Atividades::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "atividades.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->atividades_disciplina){
			$val = $request->atividades_disciplina;
			$query->where(DB::raw("atividades.disciplina"), "=", $val);
		}
		if($request->atividades_duracao){
			$vals = explode("-", str_replace(" ", "", $request->atividades_duracao));
			$from = $vals[0] ?? null;
			$to = $vals[1] ?? null;
			if(is_numeric($from) && is_numeric($to)){
				$query->whereRaw("atividades.duracao BETWEEN ? AND ?", [$from, $to]);
			}
		}
		$records = $query->paginate($limit, Atividades::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Atividades::query();
		$record = $query->findOrFail($rec_id, Atividades::viewFields());
		return $this->renderView("pages.atividades.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.atividades.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(AtividadesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("imagem", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['imagem'], "imagem");
			$modeldata['imagem'] = $fileInfo['filepath'];
		}
		
		if( array_key_exists("arquivos", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['arquivos'], "arquivos");
			$modeldata['arquivos'] = $fileInfo['filepath'];
		}
		
		//save Atividades record
		$record = Atividades::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("atividades", "Registro adicionado com sucesso");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(AtividadesEditRequest $request, $rec_id = null){
		$query = Atividades::query();
		$record = $query->findOrFail($rec_id, Atividades::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("imagem", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['imagem'], "imagem");
			$modeldata['imagem'] = $fileInfo['filepath'];
		}
		
		if( array_key_exists("arquivos", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['arquivos'], "arquivos");
			$modeldata['arquivos'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("atividades", "Registro atualizado com sucesso");
		}
		return $this->renderView("pages.atividades.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Atividades::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Registro excluído com sucesso");
	}
}
