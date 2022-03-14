<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Alert;
use App\MessageErreur;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Auth;
use App\experts_details;

class UtilisateurController extends Controller
{


public function __construct()
{
        $this->middleware('auth');
        $this->breadcrumb_lis_append(['title' => 'Utilisateur' , 'url' => 'utilisateur.index', 'id' => '' ]);
    }

    public function index()
    {
    	 $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('utilisateur.index', compact('breadcrumb_lis'));
    }

    public function index_table()
    {

            if(Auth::user()->previllege != "admin"){
            $users = User::select('username','email', 'nom', 'prenom', 'previllege', 'etat','id', 'created_at', 'updated_at')
                           ->where('previllege','!=','admin');
            }elseif(Auth::user()->previllege=="admin"){
             $users = User::select('username','email', 'nom', 'prenom', 'previllege', 'etat','id', 'created_at', 'updated_at');
            }



            return datatables()->of($users)
                ->editColumn('etat', function($data){
                    // return $agence->STATUT;
                    return $data->etat == '0' ? "<button class='btn btn-danger'><span class=' label label-danger'>Inactif</span> </button>"
                        :"<button  class='btn btn-primary'><span class='primary label label-default'>Actif</span> </button>" ;
                })
                ->addColumn('action', function ($data) {
                    $affectation_ag="";
                    // if($data->previllege==="expert"){
                    //     $affectation_ag='<a href="' . route('experts.expertAgence', $data->id) . '" class="btn btn-sm btn-success" title="Affectation/Reaffectation Agence"><i class="typcn typcn-home-outline"></i> </a>';
                    //
                    // }
                    // else
                     if ($data->previllege==="agence" || $data->previllege==="dr"){
                        $affectation_ag='<a href="' . route('user.affecteAgence', $data->id) . '" class="btn btn-sm btn-success" title="Affectation/Reaffectation Agence"><i class="typcn typcn-home-outline"></i> </a>';
                    }
                    if ($data->etat===1){

                    return $affectation_ag.'
        <a href="' . route('utilisateur.modifier', $data->id) . '" class="btn btn-sm btn-success" title="Modifier"><i class="typcn typcn-user-outline"></i> </a>
        <a href="' . route('utilisateur.role.edit', $data->id) . '" class="btn btn-sm btn-success" title="Role"><i class="typcn typcn-edit"></i></a>
        <button title="Activer/Desactiver" class="btn btn-sm btn-danger" onclick="desactiver(' .$data->id. ')"><i class="typcn typcn-thumbs-down"></i></button>
        ';

        }elseif ($data->etat===0) {
                    return $affectation_ag.'
        <a href="' . route('utilisateur.modifier', $data->id) . '" class="btn btn-sm btn-success" title="Modifier"><i class="typcn typcn-user-outline"></i></a>
        <a href="' . route('utilisateur.role.edit', $data->id) . '" class="btn btn-sm btn-success" title="Role"><i class="typcn typcn-edit"></i></a>
        <button title="Activer/Desactiver" class="btn btn-sm btn-success" onclick="activer(' .$data->id. ')"><i class="typcn typcn-thumbs-up"></i></button>

        ';
                    };

                })
                ->rawColumns(['etat','action'])
            ->make(true);

    }

    public function ajout()
    {   $breadcrumb_lis =  $this->breadcrumb_lis_append( ['title' => 'Ajouter' , 'url' => 'utilisateur.ajouter', 'id' => '' ]) ;

            if(Auth::user()->previllege != "admin"){
            $roles = Role::select('name')
                           ->where('name','!=','admin')
                           ->get();
            }elseif(Auth::user()->previllege=="admin"){
            $roles = Role::select('name')->get();
            }

            //dd($roles);

        //$roles = Role::select('name');
        return view('utilisateur.ajout', compact('breadcrumb_lis','roles'));
    }

    public function store(Request $request)
    {
        if (!request()->etat) {
            $request->merge(['etat' => 0]);
        }else{
            $request->merge(['etat' => 1]);
        }


        $rules = array(
            'username' => 'bail|required|string|max:190|unique:users,username',
            'nom'      => 'bail|required|string|max:190',
            'prenom'   => 'bail|required|string|max:190',
            'email'    => 'bail|required|string|max:190|unique:users,email',
            'password' => 'bail|required|string|min:6',
            'etat'     => 'nullable|in:true,false,1,0,on,off',
        );



        $data = [
            'username' => $request->username,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'etat' => $request->etat,
            'previllege' => $request->previllege,
            'password' => bcrypt($request->password),
        ];

        if($this->validate($request, $rules)){
            $user=User::create($data);
            $role=Role::where('name',$request->previllege)->first();
            $user->syncRoles($role);

            //Alert::message('L\'utilisateur a été ajouté');
            $message=MessageErreur::findOrFail(1);
            return redirect()->route('utilisateur.index')
                             ->withSuccess($message->libelle);

        }
        else{
            return redirect()->route('utilisateur.index')
                             ->withError("L'utilisateur n'a pas été ajouté, veuillez corriger les erreurs suivantes: ");
        }
    }

    public function edit($id)
    {
        $breadcrumb_lis =  $this->breadcrumb_lis_append( ['title' => 'Modifier' , 'url' => 'utilisateur.modifier', 'id' => '' ]) ;

        $user = User::findOrFail($id);

        if(Auth::user()->previllege != "admin"){
            $roles = Role::select('name')
                           ->where('name','!=','admin')
                           ->get();
            }elseif(Auth::user()->previllege=="admin"){
            $roles = Role::select('name')->get();
            }

        return view('utilisateur.modifier',compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        if (!request()->etat) {
            $request->merge(['etat' => 0]);
        }else{
            $request->merge(['etat' => 1]);
        }
        $rules = array(
            'nom'      => 'bail|required|string|max:190',
            'prenom'   => 'bail|required|string|max:190',
            'email'    => 'bail|required|string|max:190|unique:users,email,'.$id,
            'etat'     => 'nullable|in:true,false,1,0,on,off',
        );
        if ($request->password){
            $rules += ['password' => 'bail|required|string|min:6',];
        }
        $this->validate($request, $rules);


        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'etat' => $request->etat,
            'previllege' => $request->previllege,
        ];
        if ($request->password){
            $data += ['password' => bcrypt($request->password)];
        }
        $user=User::find($id)->update($data);
        $user=User::find($id);
        $role=Role::where('name',$request->previllege)->first();
        //dd($role);
        $user->syncRoles($role);

        $message=MessageErreur::findOrFail(1);
        return redirect()->route('utilisateur.index')
            ->withSuccess($message->libelle);
    }
    public function desactiver(Request $request)
    {
        $data = [
            'etat' => 0
        ];
        $user=User::find($request->id);
        $user->update($data);

        return response()->json(
            ['message' => 'l\'utilisateur '.$user->username.' a été désactivé'],200
        );
    }
    public function activer(Request $request)
    {
        $data = [
            'etat' => 1
        ];
        $user=User::find($request->id);
        $user->update($data);

        return response()->json(
            ['message' => 'l\'utilisateur '.$user->username.' a été activé'],200
        );
    }

    public function roleedit($id)
    {
        try {
            $user = User::findOrFail($id);
            // $roles = Role::All();
            $roles = $this->RoleListeForUser();
            $Permissions = Permission::all();
            $userRoles = $user->getRoleNames()->toArray();
            $userPermissions = array_column( $user->getAllPermissions()->toArray() ,'name');

            // dd($userRoles, $userPermissions);
            // $userRole = $userRole['items'];
            // dd($userRole);
            return view('utilisateur.permissionsUtilisateur', compact('user' , 'roles' , 'Permissions' , 'userRoles' , 'userPermissions' ));

        }
        catch (\Exception $e){
            return redirect()->route('utilisateur.index')
                ->withErrors($e->getMessage());
        }
    }


    /**
     * Update the specified User's Role/Permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roleupdate(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            // if ( $user->hasAnyRole(['admin']) && !$this->isAdminUser()  ){
            //     throw new \Exception("Non autorisé à éditer un utilisateur admin");

            // }
            // if (isset($request->role) && is_array($request->role)) {
            //     $role = Role::findByName('admin');
            //     if(in_array( $role->id, $request->role )  &&  !auth()->user()->hasAnyRole(['admin']) ){
            //         throw new \Exception('Vous n\'avez pas le pouvoir d\'attribuer ce rôle !');
            //     }
            // }
            $user->syncRoles(request()->role);  //
            $user->syncPermissions(request()->permissions);
            return redirect()->route('utilisateur.index')
                ->withSuccess("L'utilisateur a été modifié");
        }
        catch (\Exception $e){
            return redirect()->route('utilisateur.index')
                ->withErrors($e->getMessage());
        }
    }

    public function RoleListeForUser()
    {
        if (!auth()->user()->hasAnyRole(['admin']) ){  // get Roles liste without the Admin Role
            return Role::where('name','!=','admin')->get();
        }else{
            return Role::all();
        }
    }

    public function profil()
    {

        $user = User::findOrFail(auth()->user()->id);
        $expert="";
        if(auth()->user()->previllege == 'expert'){
            $expert= experts_details::findOrFail(auth()->user()->id);
        }
        return view('utilisateur.profil',compact('user','expert'));
    }

    public function update_profil(Request $request, $id)
    {
        $auto=0;
        $risque=0;
        $transport=0;
        $tva=0;
        if($request->password != $request->conf_password){
            Alert::warning('Avertissement', 'Une expertise en cours de validation existe!');
            return redirect()->route('utilisateur.profil');
        }

        $rules = array(
            'nom'      => 'bail|required|string|max:190',
            'prenom'   => 'bail|required|string|max:190',
            'email'    => 'bail|required|string|max:190|unique:users,email,'.$id,
        );
        if ($request->password){
            $rules += ['password' => 'bail|required|string|min:6',];
        }
        if (auth()->user()->previllege == 'expert'){
            $rules += ['num_tel1' => 'bail|required|string|max:190',];
            //$rules += ['num_tel2' => 'bail|required|string|max:190',];
        }
        $this->validate($request, $rules);

        if($request->auto)
            $auto=1;
        if($request->risque)
            $risque=1;
        if($request->transport)
            $transport=1;
        if($request->tva)
            $tva=1;


        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'profil_update' => 1,
        ];
        if ($request->password){
            $data += ['password' => bcrypt($request->password)];
        }
        if (auth()->user()->previllege == 'expert'){
            $data_expert = [
                'telephone_1' => $request->num_tel1,
                'telephone_2' => $request->num_tel2,
                'auto' => $auto,
                'risque_indu' => $risque,
                'transport' => $transport,
                'tva' => $tva,
                'adresse' => $request->adresse,
                'agerement_organisme' => $request->agerement_organisme,
                'agrement_date_obtention' => $request->agrement_date_obtention,
                'nif' => $request->nif,
                'rib' => $request->rib,
            ];
        }
        $user=User::find($id)->update($data);
        $user=User::find($id);

        if (auth()->user()->previllege == 'expert'){
            experts_details::find($id)->update($data_expert);
        }

        $message=MessageErreur::findOrFail(1);
        return redirect()->route('utilisateur.profil')
            ->withSuccess($message->libelle);
    }
}
