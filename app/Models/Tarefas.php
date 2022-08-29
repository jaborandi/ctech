<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Tarefas extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'tarefas';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'status','prioridade','titulo','fazer_ate','usuarios','descricao','inserido_por','atualizado_por','feedback'
	];
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = true;
	const CREATED_AT = 'inserido_em'; 
	const UPDATED_AT = 'atualizado_em'; 
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				status LIKE ?  OR 
				titulo LIKE ?  OR 
				prioridade LIKE ?  OR 
				descricao LIKE ?  OR 
				usuarios LIKE ?  OR 
				inserido_por LIKE ?  OR 
				atualizado_por LIKE ?  OR 
				feedback LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id",
			"status",
			"titulo",
			"fazer_ate",
			"prioridade",
			"descricao",
			"usuarios",
			"inserido_por",
			"inserido_em",
			"atualizado_por",
			"atualizado_em",
			"feedback" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id",
			"status",
			"titulo",
			"fazer_ate",
			"prioridade",
			"descricao",
			"usuarios",
			"inserido_por",
			"inserido_em",
			"atualizado_por",
			"atualizado_em",
			"feedback" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"titulo",
			"descricao",
			"prioridade",
			"fazer_ate",
			"usuarios",
			"status",
			"inserido_por",
			"inserido_em",
			"atualizado_em",
			"feedback" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"titulo",
			"descricao",
			"prioridade",
			"fazer_ate",
			"usuarios",
			"status",
			"inserido_por",
			"inserido_em",
			"atualizado_em",
			"feedback" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id",
			"status",
			"atualizado_por",
			"feedback" 
		];
	}
	

	/**
     * return atribuidas page fields of the model.
     * 
     * @return array
     */
	public static function atribuidasFields(){
		return [ 
			"id",
			"status",
			"titulo",
			"fazer_ate",
			"prioridade",
			"descricao",
			"usuarios",
			"inserido_por",
			"inserido_em",
			"atualizado_por",
			"atualizado_em",
			"feedback" 
		];
	}
	

	/**
     * return exportAtribuidas page fields of the model.
     * 
     * @return array
     */
	public static function exportAtribuidasFields(){
		return [ 
			"id",
			"status",
			"titulo",
			"fazer_ate",
			"prioridade",
			"descricao",
			"usuarios",
			"inserido_por",
			"inserido_em",
			"atualizado_por",
			"atualizado_em",
			"feedback" 
		];
	}
}
