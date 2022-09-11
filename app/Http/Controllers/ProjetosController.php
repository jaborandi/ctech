<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjetosAddRequest;
use App\Http\Requests\ProjetosEditRequest;
use App\Models\Projetos;
use Illuminate\Http\Request;
use Exception;
class ProjetosController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.projetos.list";
		$query = Projetos::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Projetos::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "projetos.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->projetos_categoria){
			$vals = $request->projetos_categoria;
			$query->whereIn("projetos.categoria", $vals);
		}
		$records = $query->paginate($limit, Projetos::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Projetos::query();
		$record = $query->findOrFail($rec_id, Projetos::viewFields());
		return $this->renderView("pages.projetos.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.projetos.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ProjetosAddRequest $request){
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
		$modeldata['inserido_por'] = auth()->user()->name;
		
		//save Projetos record
		$record = Projetos::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("projetos", "Registro adicionado com sucesso");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ProjetosEditRequest $request, $rec_id = null){
		$query = Projetos::query();
		$record = $query->findOrFail($rec_id, Projetos::editFields());
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
			return $this->redirect("projetos", "Registro atualizado com sucesso");
		}
		return $this->renderView("pages.projetos.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Projetos::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Registro excluído com sucesso");
	}
}
