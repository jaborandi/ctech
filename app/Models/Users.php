<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class Users extends Authenticatable 
{
	use Notifiable;
	use HasRoles;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'users';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ['name','password','image','phone','email','cor_postit','cor_letra'];
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id",
			"name",
			"image",
			"phone",
			"email",
			"cor_postit",
			"cor_letra" 
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
			"name",
			"image",
			"phone",
			"email",
			"cor_postit",
			"cor_letra" 
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
			"name",
			"phone",
			"email",
			"cor_postit",
			"cor_letra" 
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
			"name",
			"phone",
			"email",
			"cor_postit",
			"cor_letra" 
		];
	}
	

	/**
     * return accountedit page fields of the model.
     * 
     * @return array
     */
	public static function accounteditFields(){
		return [ 
			"id",
			"name",
			"image",
			"phone",
			"cor_postit",
			"cor_letra" 
		];
	}
	

	/**
     * return accountview page fields of the model.
     * 
     * @return array
     */
	public static function accountviewFields(){
		return [ 
			"id",
			"name",
			"phone",
			"email",
			"cor_postit",
			"cor_letra" 
		];
	}
	

	/**
     * return exportAccountview page fields of the model.
     * 
     * @return array
     */
	public static function exportAccountviewFields(){
		return [ 
			"id",
			"name",
			"phone",
			"email",
			"cor_postit",
			"cor_letra" 
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
			"name",
			"image",
			"phone",
			"cor_postit",
			"cor_letra" 
		];
	}
	

	/**
     * Get current user name
     * @return string
     */
	public function UserName(){
		return $this->name;
	}
	

	/**
     * Get current user id
     * @return string
     */
	public function UserId(){
		return $this->id;
	}
	public function UserEmail(){
		return $this->email;
	}
	public function UserPhoto(){
		return $this->image;
	}
	public function UserRole(){
		return $this->user_role_id;
	}
	

	/**
     * Send Password reset link to user email 
	 * @param string $token
     * @return string
     */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new \App\Notifications\ResetPassword($token));
	}
	public function canView($path)
	{
		$arrPaths = explode("/", strtolower($path));
		$page = $arrPaths[0] ?? "home";
		$action = $arrPaths[1] ?? "list";
		if($action == "index"){
			$action = "list";
		}
		return $this->can("$page/$action");
	}
}
