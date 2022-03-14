<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaremeHonoraire extends Model
{
    protected $fillable = ['id', 'montant_a','montant_b', 'minimum','maximum','sur_a','sur_b'];
    protected $table = 'bareme_honoraire';

}
