<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddressBook;

class AddressBookController extends Controller
{
	public function saveAddress(Request $request){
    $validation = \Validator::make($request->all(), [
            'user_id'      => 'required',
            'name'      => 'required',
            'house_name'      => 'required',
            'place'      => 'required',
            'amount'      => 'required',
        ]);
        if($validation->passes()){
            $places = new AddressBook();
            $places->user_id = $request->user_id;
            $places->book_number = $request->book_number;
            $places->name = $request->name;
            $places->house_name = $request->house_name;
            $places->place = $request->place;
            $places->amount = $request->amount;
            $places->save();
            echo "Success";

        }else{
            echo "false";

        }
    }
    public function getAddress(){
        $address = AddressBook::with('places');
                            //$address = $address->get();
                            //echo "string";die();
       /* if(isset($request->search_term) && $request->search_term != ''){
            $address = $address->where('schedule_name', 'like', '%'.$request->search_term.'%'); 
        }*/
        
        $per_page = 5;
        /*if(isset($request->per_page) && $request->per_page != ''){
            $per_page = $request->per_page; 
        }*/
        $address = $address->paginate($per_page);

        if ( !($address->isEmpty()) ) {
            $response = array(
                'success' => true,
                'code' => 200,
                'message' => "Address returned successfully",
                'data' => $address
            );
        }else{
            $response = array(
                'success' => false,
                'code' => 422,
                'message' => "No Address found",
                'data' => ''
            );
        }
        return response($response, 200);
    }
}
