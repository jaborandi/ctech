<?php
use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
	private $permissionsByRole = [
			
		'administrador' => [
			'home/list', 'users/list', 'users/view', 'users/add', 'users/store', 'users/edit', 'users/delete', 'users/importdata', 'account/list', 'account/edit', 'atividades/list', 'atividades/view', 'atividades/add', 'atividades/store', 'atividades/edit', 'atividades/delete', 'agenda_fablab/list', 'agenda_fablab/view', 'agenda_fablab/add', 'agenda_fablab/store', 'agenda_fablab/edit', 'agenda_fablab/delete', 'agenda_cinema/list', 'agenda_cinema/view', 'agenda_cinema/add', 'agenda_cinema/store', 'agenda_cinema/edit', 'agenda_cinema/delete', 'compras/list', 'compras/view', 'compras/add', 'compras/store', 'compras/edit', 'compras/delete', 'tarefas/list', 'tarefas/view', 'tarefas/add', 'tarefas/store', 'tarefas/edit', 'tarefas/delete', 'tarefas/atribuidas', 'roles/list', 'roles/view', 'roles/add', 'roles/store', 'roles/edit', 'roles/delete', 'permissions/list', 'permissions/view', 'permissions/add', 'permissions/store', 'permissions/edit', 'permissions/delete', 'model_has_roles/list', 'model_has_roles/view', 'model_has_roles/add', 'model_has_roles/store', 'model_has_roles/edit', 'model_has_roles/delete', 'model_has_permissions/list', 'model_has_permissions/view', 'model_has_permissions/add', 'model_has_permissions/store', 'model_has_permissions/edit', 'model_has_permissions/delete', 'role_has_permissions/list', 'role_has_permissions/view', 'role_has_permissions/add', 'role_has_permissions/store', 'role_has_permissions/edit', 'role_has_permissions/delete'
		], 
		'colaborador' => [
			'home/list', 'account/list', 'account/edit', 'atividades/list', 'atividades/view', 'atividades/add', 'atividades/store', 'atividades/edit', 'atividades/delete', 'agenda_fablab/list', 'agenda_fablab/view', 'agenda_fablab/add', 'agenda_fablab/store', 'agenda_fablab/edit', 'agenda_fablab/delete', 'agenda_cinema/list', 'agenda_cinema/view', 'agenda_cinema/add', 'agenda_cinema/store', 'agenda_cinema/edit', 'agenda_cinema/delete', 'compras/list', 'compras/view', 'compras/add', 'compras/store', 'compras/edit', 'compras/delete', 'tarefas/list', 'tarefas/view', 'tarefas/add', 'tarefas/store', 'tarefas/edit', 'tarefas/delete', 'tarefas/atribuidas'
		], 
		'escola' => [
			'home/list', 'agenda_cinema/list', 'agenda_cinema/view', 'agenda_cinema/add', 'agenda_cinema/store', 'agenda_cinema/edit', 'agenda_cinema/delete', 'agenda_cinema/importdata', 'agenda_fablab/list', 'agenda_fablab/view', 'agenda_fablab/add', 'agenda_fablab/store', 'agenda_fablab/edit', 'agenda_fablab/delete', 'agenda_fablab/importdata', 'account/list', 'account/edit'
		]
	];
    public function run()
    {
        $tableNames = config('permission.table_names');

		Schema::disableForeignKeyConstraints();
		
		DB::table($tableNames['role_has_permissions'])->truncate();
		DB::table($tableNames['permissions'])->truncate();
        DB::table($tableNames['roles'])->truncate();
        
		Schema::enableForeignKeyConstraints();
		
		app()['cache']->forget('spatie.permission.cache');
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

		$this->syncPermissions();
		$this->syncRoles();
		$this->syncUsersRole('colaborador');
    }
	function syncRoles(){
		foreach ($this->permissionsByRole as $rolename => $permissions) {
			$role = Role::create(['name' => $rolename]);
			$role->givePermissionTo($permissions);
		}
	}

	function syncPermissions(){
		$permissions = [];

		foreach ($this->permissionsByRole as $rolename => $rolePermissions) {
			$permissions = array_merge($permissions, $rolePermissions);
		}

		$insertData = [];
		foreach($permissions as $name){
			$insertData[] = ['name'=>$name, 'guard_name' => 'web'];
		}
		Permission::insert($insertData);
	}

	function syncUsersRole($role){
		$users = Users::all();
		foreach($users as $user){
			$user->syncRoles($role);
		}
	}
}
