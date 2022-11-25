<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
  public function signup(CreateUser $request) {
    $validatedData = $request->validated();

    $user = new User([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      'password' => bcrypt($validatedData['password']),
    ]);
    $user->save();

    return response('success', 201);
  }

  public function login(Request $request) {
    $validationData = $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string'
    ]);

    if (!Auth::attempt($validationData)) {
      return response('授權失敗', 401);
    }

    $user = $request->user();
    $tokenResult = $user->createToken('Token');
    $tokenResult->token->save();
    return response(['token' => $tokenResult->accessToken]);
  }

  public function user(Request $request) {
    return response($request->user());
  }

  public function logout(Request $request) {
    $request->user()->token()->revoke();

    return response(['message' => '成功登出']);
  }
}
