<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;
use App\Models\Caja;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('Caja');
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if(isset($request->password)){
            if(!empty($request->password)){
                $user->password = Hash::make($request->password);
            }
        }
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->estado = 0;
        $user->save();

        return $user;
    }

    public function login(LoginFormRequest $request){
        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password], false))
        {
            $user_auth = Auth::user();
            $user = User::find($user_auth->id);
            
            if($user->Caja)
            {
                $user->caja = $user->Caja;
                return $user;
            } else {
                Caja::create([
                    'user_id'   => $user->id,
                    'estado'    => 1,
                ]);
                

                $user->load('Caja');

                return $user;
            }

        }else {
            return response()->json(['errors'=>['login'=>['Los datos no son validos']]]);
        }
    }
}
