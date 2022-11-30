<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserPostRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use JeroenDesloovere\VCard\VCard;

class AuthController extends Controller
{
    public function registerUser(UserPostRequest $request)
    {
        $user = User::create([
            'full_name' => $request->full_name,
            'user_name' => $request->user_name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
        return response()->json($user);
    }
    public function userLogin()
    {
        if (request('email')) {
            $creds = [
                'email'  => request('email'),
                'password'  => request('password'),
            ];
        } else {
            $creds = [
                'user_name'  => request('user_name'),
                'password'  => request('password'),
            ];
        }
        if (Auth::attempt($creds)) {
            $user = Auth::user();
            $accessToken = $user->createToken('token')->accessToken;
            return response()->json(['Success' => true, 'accessToken' => $accessToken]);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function userDetails($user_name)
    {
        $userDetails = User::where('user_name', '=', $user_name)->first();
        if($userDetails){
            if($userDetails->data){
                return response()->json($userDetails->data);
            }
            return response()->json($userDetails);
        }
        return response()->json("User not found", 404);
    }
    public function updateUser(UserPostRequest $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        $user->full_name = $request->full_name;
        $user->user_name = $request->user_name;
        $user->email     = $request->email;
        $user->data      = $data;
        $user->save();
        return response()->json($user->data);
    }

    public function downloadVCF(Request $request){

        $vcard = new VCard();

    $vcard->addName($request->name);
    $vcard->addCompany($request->company);
    $vcard->addJobtitle($request->jobtitle);
    $vcard->addEmail($request->email);
    $vcard->addPhoneNumber($request->phone , 'WORK');
    $vcard->addAddress($request->address);
    
    return $vcard->download();


    }
}
