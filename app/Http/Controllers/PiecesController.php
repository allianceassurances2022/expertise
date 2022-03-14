<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Piece;
use App\CategoriePiece;
use App\ods;
use App\AutreFournituresChoc;

class PiecesController extends Controller
{
    public function __construct()
	{
        $this->middleware('auth');
    	$this->breadcrumb_lis_append(['title' => 'Piece' , 'url' => 'pieces.index' , 'id' => '']);
    }

    public function index()
    {
    	$this->breadcrumb_lis_append(['title' => 'Inventaire' , 'url' => 'pieces.index', 'id' => '' ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('pieces.index', compact('breadcrumb_lis'));
    }

    public function article($id)
    {
        $identifiant=$id;
        $categoriePieces=CategoriePiece::all();
        // $this->breadcrumb_lis_append(['title' => 'Ajout Article' , 'url' => 'pieces.article' ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('pieces.article', compact('breadcrumb_lis','categoriePieces','identifiant'));
    }

    public function categorie()
    {
        $this->breadcrumb_lis_append(['title' => 'Ajout Categorie' , 'url' => 'pieces.categorie', 'id' => '' ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('pieces.categorie', compact('breadcrumb_lis'));
    }

    public function storeArticle(Request $request)
    {
        $data = [
            'cat_pieces' => $request->categorie,
            'intitule' => $request->intitule,
            'description' => $request->description,
        ];
        Piece::create($data);

         return redirect()->route('pieces.index')
                          ->withSuccess("La Piece A Eté Ajoutée Avec Succès.");
    }

    public function storeCategorie(Request $request)
    {
        $data = [
            'libelle' => $request->libelle,
            'description' => $request->description,
        ];

        CategoriePiece::create($data);

         return redirect()->route('pieces.index')
                          ->withSuccess("La Categorie A Eté Ajoutée Avec Succès.");
    }


    public function listeTablePiece(Request $request)
    {
        $CategoriePiece = CategoriePiece::select( 'id', 'created_at', 'updated_at', 'libelle', 'Description', 'etat');
        return datatables()->of($CategoriePiece)->addColumn('Actions', function ($data) {
                if($data->etat=="0"){
                    $etat='<a href="#" class="voir-detail btn btn-sm btn-primary" title="activer" onclick="myFunctionAnnulerCat()"><i class="fa fa-thumbs-up"></i> </a> ';
                }
                else{
                    $etat='<a href="#" class="voir-detail btn btn-sm btn-danger" title="Desactiver" onclick="myFunctionAnnulerCat()"><i class="fa fa-thumbs-down"></i> </a> ';
                }
                return
                $etat.'<a href="'.route('pieces.categorie.edit',$data->id).'" class="voir-detail btn btn-sm btn-primary" title="Modifier" onclick="myFunction()"><i class="typcn typcn-edit"></i> </a> '.
                '<a href="'.route('pieces.article',$data->id).'" class="voir-detail btn btn-sm btn-primary" title="Ajouter Article" onclick="myFunction()"><i class="mdi mdi-plus"></i> </a> ';
        })->rawColumns(['Actions'])
        ->make(true);

    }

    public function articleTable(Request $request)
    {
        $Piece = Piece::select( 'id', 'created_at', 'updated_at', 'intitule', 'description','etat')->where('cat_pieces','=',$request->id);
        return datatables()->of($Piece)->addColumn('Actions', function ($data) {
                if($data->etat=="0"){
                    $etat='<a href="#" class="voir-detail btn btn-sm btn-primary" title="activer" onclick="myFunctionAnnulerArt()"><i class="fa fa-thumbs-up"></i> </a> ';
                }
                else{
                    $etat='<a href="#" class="voir-detail btn btn-sm btn-danger" title="Desactiver" onclick="myFunctionAnnulerArt()"><i class="fa fa-thumbs-down"></i> </a> ';
                }
                return
                $etat.'<a href="'.route('pieces.article.edit',$data->id).'" class="voir-detail btn btn-sm btn-primary" title="Modifier" onclick="myFunction()"><i class="typcn typcn-edit"></i> </a> ';
        })->rawColumns(['Actions'])
        ->make(true);
    }

    public function editArticle($id)
    {
       $categoriePieces=CategoriePiece::all();
       $article = Piece::findOrFail($id);
       $categorie_lib = CategoriePiece::findOrFail($article->cat_pieces);
       $this->breadcrumb_lis_append(['title' => 'Modifier Article' , 'url' => 'pieces.categorie', 'id' => '' ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('pieces.edit_article', compact('breadcrumb_lis','categoriePieces','article', 'categorie_lib'));
    }

    public function editCategorie($id)
    {
       $categorie = CategoriePiece::findOrFail($id);
       $this->breadcrumb_lis_append(['title' => 'Modifier Categorie' , 'url' => 'pieces.categorie', 'id' => '' ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('pieces.edit_categorie', compact('breadcrumb_lis','categorie'));
    }

    public function update_categorie(Request $request)
    {
        $x=CategoriePiece::where('id', $request->id)->limit(1)->update(array('libelle' => $request->libelle, 'Description' => $request->description));
        return redirect()->route('pieces.index')
            ->withSuccess("la categorie numero ".$request->id." a été modifiée");
    }


    public function update_article(Request $request)
    {
        $x=Piece::where('id', $request->id)->limit(1)->update(array('cat_pieces' => $request->categorie, 'intitule' => $request->intitule, 'description' => $request->description));
        return redirect()->route('pieces.index')
            ->withSuccess("l'article numero ".$request->id." a été modifié");
    }

    public function desactivercategorie(Request $request)
    {
        $categorie = CategoriePiece::findOrFail($request->id);

        if($categorie->etat=="0"){
            $x=CategoriePiece::where('id', $request->id)->limit(1)->update(array('etat' => 1));
            return redirect()->route('pieces.index')->withSuccess("la categorie numero ".$request->id." a été desactivée");
        }
        else{
            $x=CategoriePiece::where('id', $request->id)->limit(1)->update(array('etat' => 0));
            return redirect()->route('pieces.index')->withSuccess("la categorie numero ".$request->id." a été activée");
        }
    }

    public function desactiverarticle(Request $request)
    {
        $article = Piece::findOrFail($request->id);
        if($article->etat=="0"){
            $x=Piece::where('id', $request->id)->limit(1)->update(array('etat' => 1));
            return redirect()->route('pieces.index')
            ->withSuccess("l'article/produit numero ".$request->id." a été activé.");
        }
        else{
            $x=Piece::where('id', $request->id)->limit(1)->update(array('etat' => 0));
            return redirect()->route('pieces.index')
            ->withSuccess("l'article/produit numero ".$request->id." a été désactivé.");
        }
    }

    public function autres(){

        return view('pieces.autres');

    }

    public function autres_table(Request $request){
        $autres = AutreFournituresChoc::leftJoin('users','users.id','=','autre_fournitures_chocs.user_id')->select('libelle','users.nom as expert','autre_fournitures_chocs.created_at as date');
        return datatables()->of($autres)
                       ->make(true);

    }

}
