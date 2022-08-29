<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Agenda_Cinema extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'agenda_cinema';
	

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
		'confirmacao','titulo','data_inicio','hora_inicio','data_termino','hora_termino','observacoes'
	];
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				titulo LIKE ?  OR 
				observacoes LIKE ?  OR 
				confirmacao LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%"
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
			"observacoes",
			"confirmacao",
			"data_inicio",
			"hora_inicio",
			"data_termino",
			"hora_termino" 
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
			"observacoes",
			"confirmacao",
			"data_inicio",
			"hora_inicio",
			"data_termino",
			"hora_termino" 
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
			"observacoes",
			"confirmacao",
			"data_inicio",
			"hora_inicio",
			"data_termino",
			"hora_termino" 
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
			"observacoes",
			"confirmacao",
			"data_inicio",
			"hora_inicio",
			"data_termino",
			"hora_termino" 
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
			"confirmacao",
			"titulo",
			"data_inicio",
			"hora_inicio",
			"data_termino",
			"hora_termino",
			"observacoes" 
		];
	}
}
