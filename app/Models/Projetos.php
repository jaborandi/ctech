<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Projetos extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'projetos';
	

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
		'titulo','categoria','descricao','imagem','arquivos','inserido_por','atualizado_por'
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
				titulo LIKE ?  OR 
				descricao LIKE ?  OR 
				arquivos LIKE ?  OR 
				inserido_por LIKE ?  OR 
				atualizado_por LIKE ?  OR 
				categoria LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"titulo",
			"descricao",
			"imagem",
			"arquivos",
			"inserido_por",
			"inserido_em",
			"atualizado_por",
			"atualizado_em",
			"categoria" 
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
			"titulo",
			"descricao",
			"imagem",
			"arquivos",
			"inserido_por",
			"inserido_em",
			"atualizado_por",
			"atualizado_em",
			"categoria" 
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
			"imagem",
			"titulo",
			"descricao",
			"inserido_por",
			"categoria",
			"inserido_em",
			"atualizado_por",
			"atualizado_em",
			"arquivos" 
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
			"imagem",
			"titulo",
			"descricao",
			"inserido_por",
			"categoria",
			"inserido_em",
			"atualizado_por",
			"atualizado_em",
			"arquivos" 
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
			"titulo",
			"categoria",
			"descricao",
			"imagem",
			"arquivos",
			"atualizado_por" 
		];
	}
}
