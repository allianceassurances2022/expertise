<?php

namespace App\Http\Controllers;

use App\CategoriePiece;
use App\Piece;
use Illuminate\Http\Request;

class CategoriePiecesController extends Controller
{

public function __construct()
	{
        $this->middleware('auth');
    }

    public function getCategoriesOption()
    {
    	return CategoriePiece::select('id','libelle')->with('pieces')
    							->get()  ;
    }

    public function getpiecesOption()
    {
    	return Piece::select('id','intitule','cat_pieces')
    							->get()  ;
    }

}
