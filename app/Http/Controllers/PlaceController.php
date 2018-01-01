<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserPlaces;

class PlaceController extends Controller
{
	public function savePlace(Request $request){
	$validation = \Validator::make($request->all(), [
            'place_name'       => 'required|min:3',
            'user_id'      => 'required',
        ]);
        if($validation->passes()){
            $places = new UserPlaces();
            $places->user_id = $request->user_id;
            $places->place_name = $request->place_name;
            $places->save();
            echo "Success";

        }else{
            echo "false";

        }
    }
    public function getPlace(){

        $places = new UserPlaces();        
        $per_page = 5;
        $places = $places->paginate($per_page);

        if ( !($places->isEmpty()) ) {
            $response = array(
                'success' => true,
                'code' => 200,
                'message' => "Places returned successfully",
                'data' => $places
            );
        }else{
            $response = array(
                'success' => false,
                'code' => 422,
                'message' => "No Place found",
                'data' => ''
            );
        }
        return response($response, 200);
    }
}
