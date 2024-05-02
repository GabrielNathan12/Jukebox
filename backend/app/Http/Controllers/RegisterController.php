<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\RegisterNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $user = RegisterNewUser::create($request->all());

        return response()->json([
            'message' => 'Usuário registrado com sucesso!',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 201); 
    }
}
