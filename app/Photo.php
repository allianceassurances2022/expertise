<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['id', 'expertise_id','titre', 'file'];
    protected $table = 'photos';

}
