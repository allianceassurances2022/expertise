<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declaration_file extends Model
{
    protected $fillable = ['id', 'ods_id','description', 'file'];
    protected $table = 'declaration_file';
}
