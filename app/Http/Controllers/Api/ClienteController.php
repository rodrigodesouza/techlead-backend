<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // Autenticação: Usado para SPA Authentication com Sactum
        if (Auth::guard('cliente')->attempt($credentials)) {
            $cliente        = Auth::guard('cliente')->user();
            $token          = $cliente->createToken($cliente->email);
            $cliente->token = $token->plainTextToken;

            return $cliente;
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);

        // return response()->json([
        //     'message' => [trans('auth.failed')],
        //     'error' => true,
        // ], 422);
    }

    public function signup(ClienteRequest $request)
    {
        $input = $request->all();

        try {
            $input['password']  = bcrypt($input['password']);
            $cliente            = Cliente::create($input);
            Auth::guard('cliente')->loginUsingId($cliente);

            $token          = $cliente->createToken($cliente->email);
            $cliente->token = $token->plainTextToken;

            return $cliente;

        } catch (\Exception $e) {
            // if (env('APP_DEBUG')) {
            //     throw $e;
            // }
            return response([
                'message'=> 'Erro ao tentar cadastrar!'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout();

        return response(['error' => false, 'message' => 'logout realizado!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
