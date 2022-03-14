<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\MessageErreur;

class RolesPermissionsController extends Controller
{
    //

public function __construct()
{
    $this->middleware('auth');
    $this->breadcrumb_lis_append(['title' => 'Roles & Permissions' , 'url' => 'roles', 'id' => '']);
    }    

    public function roles()
    {
        $breadcrumb_lis =  $this->breadcrumb_lis_append( ['title' => 'Roles' , 'url' => 'roles', 'id' => '' ]) ;
        return view('roles_permissions.roles', compact('breadcrumb_lis'));
    }

    public function index_table()
    {

        $roles = Role::select('name','id');


        return datatables()->of($roles)
            ->addColumn('action', function ($data) {
                    return '<a href="' . route('role.edit', $data->id) . '" class="badge badge-primary waves-effect waves-light" title="Voir">
                                                <i class="fa fa-eye"></i></a>';

            })
            ->make(true);
    }

    public function index_table_permissions()
    {
        $permissions = Permission::select('libelle','id');

        return datatables()->of($permissions)
            ->make(true);


    }

    public function roleAdd()
    {
        $permissions = Permission::All();
        return view('roles_permissions.ajout_role', compact('permissions'));
    }

    public function roleAddStore(Request $request)
    {
        try{

            $request->validate([
                'name'          => 'bail|required|sometimes|min:3',
                'permission'    => 'bail|required|array',
                'permission.*'  => 'bail|distinct|numeric'
            ]);
            //return $request ;
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permission);

            return redirect()->route('roles')
                ->withSuccess("Le Rôle ". $role->name ." a été Ajouter");
        }catch(\Exception $e){
            return redirect()->route('role.create')->withErrors(['erreurs' =>  $e->getMessage() ]);
        }
    }


    public function permissions()
    {
        $breadcrumb_lis =  $this->breadcrumb_lis_append( ['title' => 'Permissions' , 'url' => 'permissions', 'id' => '' ]) ;
        return view('roles_permissions.permissions', compact('breadcrumb_lis'));
    }

    public function permissionsUtilisateur($utilisateur)
    {
        $breadcrumb_lis =  $this->breadcrumb_lis_append( ['title' => 'Permissions' , 'url' => 'permissions' , 'id' => '']) ;
        return view('utilisateur.permissionsUtilisateur', compact('breadcrumb_lis', 'utilisateur'));
    }

    public function roleDetailEdit($id)
    {
        try{

            $role = Role::findById($id);
            $rolePermissionsId = $role->permissions()->get()->pluck('id')->toArray();
            $permissions = Permission::all();
            return view('roles_permissions.edit_role', compact('role' ,'rolePermissionsId','permissions' ) );
        }catch(\Exception $e){
            return redirect()->route('roles')->withErrors(['erreurs' =>  $e->getMessage() ]);
        }
    }

    public function roleEditStore(Request $request)
    {
        try{

            $request->validate([
                'id'            => 'bail|required|numeric',
                'name'          => ['bail','required','string'],
                'permission'    => 'bail|required|array',
                'permission.*'  => 'bail|distinct|numeric'
            ]);

            $role = Role::findById($request->id);

            $role->syncPermissions($request->permission);

            return redirect()->route('roles')
                ->withSuccess("Le Rôle ". $role->name ." a été modifié");
        }catch(\Exception $e){
            return redirect()->route('roles')->withErrors(['erreurs' =>  $e->getMessage() ]);
        }
    }

}

