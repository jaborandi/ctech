<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * tags_option_list Model Action
     * @return array
     */
	function tags_option_list(){
		$sqltext = "SELECT  DISTINCT tags AS value,tags AS label FROM atividades ORDER BY tags ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * permission_id_option_list Model Action
     * @return array
     */
	function permission_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM permissions";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * role_id_option_list Model Action
     * @return array
     */
	function role_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM roles";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * categoria_option_list Model Action
     * @return array
     */
	function categoria_option_list(){
		$sqltext = "SELECT  DISTINCT categoria AS value,categoria AS label FROM projetos ORDER BY categoria ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * usuarios_option_list Model Action
     * @return array
     */
	function usuarios_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM users ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_name_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('name', $value)->value('name');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * getcount_afazer Model Action
     * @return int
     */
	function getcount_afazer(){
		$sqltext = "SELECT COUNT(*) AS num FROM tarefas WHERE status='AGUARDANDO' and usuarios =".auth()->user()->id;
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_fazendo Model Action
     * @return int
     */
	function getcount_fazendo(){
		$sqltext = "SELECT COUNT(*) AS num FROM tarefas WHERE status='EM PROGRESSO' and usuarios =".auth()->user()->id;
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_feitas Model Action
     * @return int
     */
	function getcount_feitas(){
		$sqltext = "SELECT COUNT(*) AS num FROM tarefas WHERE status='CONCLUÍDA' and usuarios =".auth()->user()->id;
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
}
