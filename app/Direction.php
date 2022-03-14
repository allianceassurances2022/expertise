<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
	protected $table = 'directions';

	protected $fillable = [
		'code', 'libelle', 'pere','statut','type'
	];

/*
|relation
*/
	



/*
    |------------------------------------------------------------------------------------
    | Attributes  Get 
    |------------------------------------------------------------------------------------
    */
    /*
    | return 
    */
   

/*
|
*/

public static function fils( int $agence_id)
	{
		$agence = Direction::find($agence_id);
		if (isset($agence->code))
		return Direction::where('pere','=',$agence->code)->get()->pluck('id')->toArray();
		else return null;
	}	

// // return Array of id agence pere avec agence_id include 
// public static function fils_all_(int $agence_id)
// 	{
// 		$data[] = $agence_id;
// 		for ($i=0; ($i < count($data) ); $i++) { 
// 			// dd( Direction::fils($data[$i])->pluck('id')->toArray() );
// 			if ($data[$i] != null){
// 				$d = Direction::select('id')->where('pere' , Direction::where('id' , $data[$i])->get()->first()->code )
// 											->where('statut',1)->get()->pluck('id');
// 				if (count($d) != 0) { $data[] = $d->toArray(); }
// 			}
// 			$data = array_flatten($data);
			
		
// 		}
// 		//dd($data);
// 		 return $data;
// 	}	


// return Array of id agence pere avec agence_id include Optimis
public static function fils_all(int $agence_id)
	{
		$data[] = $agence_id;
		for ($i=0; ($i < count($data) ); $i++) { 
			// dd( Direction::fils($data[$i])->pluck('id')->toArray() );
			if ($data[$i] != null){
				$d = Direction::select('id')->whereIn('pere' , Direction::whereIn('id' , array_slice($data,$i) )->get()->pluck('code') )
											->where('statut',1)->get()->pluck('id');
				$i = count($data) - 1;
				if (count($d) != 0) { $data[] = $d->toArray(); }
			}
			$data = array_flatten($data);
			
		
		}
		//dd($data);
		 return $data;
	}	



// return Array of id agence pere avec agence_id include 
// trow Exception si l'agence/Pere est inactif 
public static function pere_all(int $agence_id)
	{
		// $agence = $agence_id; 
	
		$data[] = $agence_id;
		// array_push($data, $agence);
		// dd(count($data));
		// dd( Direction::fils($data[0]) );

		for ($i=0; ($i < count($data) ); $i++) { 
			// dd( Direction::fils($data[$i])->pluck('id')->toArray() );
			if ($data[$i] != null){
				if ( empty(Direction::where('id' , $data[$i])->where('statut',1)->get()->first() ) )  {throw new \Exception('Non autorisé, Votre Agence ou DR est désactivé !');}
				$d = Direction::select('id')->where('code' , Direction::where('id' , $data[$i])
											->where('statut',1)->get()->first()->pere )->get()->first(); 
				if ($d != null) { $data[] = $d->toArray(); }

			} 	
			$data = array_flatten($data);
			//dd($data);
		}	
	
			// if () {throw new Exception('Non autorisé, Votre Agence ou DR est désactivé !');}
			

		//dd($data);
		 return $data;
	}	



public function get_fils( $id)
    {

    	$code = Direction::select('id','code','libelle')->where('id','=',$id)->get()->first()->toArray();
        $fils=Direction::select('id','code','libelle')->where('pere','=',$code['code'])->get()->toArray();
        // dd($fils);
        $fils2=$fils;
        foreach ($fils2 as $key => $value) {
            $petit_fils=Direction::select('id','code','libelle')->where('pere','=',$value['code'])->get()->toArray();
            $fils=array_merge($fils, $petit_fils);
        }
       return $fils;
    }

    public function get_pere( $id)
    {
    	$code = Direction::select('id','code','libelle')->where('id','=',$id)->get()->first()->toArray();
        $peres=Direction::select('id','code','libelle','pere')->where('code','=',$code['code'])->get()->toArray();
        $peres2=$peres;
        // dd($peres);
        foreach ($peres2 as $key => $value) {
            $grand_pere=Direction::select('id','code','libelle','pere')->where('code','=',$value['pere'])->get()->toArray();
            $peres=array_merge($peres, $grand_pere);
        }
        return $peres;
    }



}


