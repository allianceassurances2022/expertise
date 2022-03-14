<?php

namespace App;

use App\Piece;
use Illuminate\Database\Eloquent\Model;

class CategoriePiece extends Model
{
    protected $table = 'categoriespieces'; 
    protected $fillable = [
        'id',
        'libelle',
        'created_at',
        'updated_at',
        'description',
        'etat'
    ];

    /*
|relation
        hasMany($related, $foreignKey = null, $localKey = null)
*/
    public function pieces(){
        return $this->hasMany(Piece::class,  'cat_pieces','id');
    }
}
