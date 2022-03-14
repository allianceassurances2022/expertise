<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	protected $breadcrumb_lis =[['title' => 'Dashboard' , 'url' => 'dashboard' , 'id' => '' ]] ;
	public function breadcrumb_lis(){
		return $this->breadcrumb_lis;
	}

	public function breadcrumb_lis_append($array){
		$this->breadcrumb_lis[]= $array;
		 return $this->breadcrumb_lis;
	}
}
