<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Requests\Users\CreateUserValidator;
use App\Requests\Users\LoginUserValidator;
use App\Services\UserServices;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    public UserServices $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }
    public function register(CreateUserValidator $createUserValidator)
    {
        if (!empty($createUserValidator->getErrors())) {
            return response()->json($createUserValidator->getErrors(), 406);
        }
        $user = $this->userServices->createUser($createUserValidator->request()->all());
        $message['user'] = $user;
        $message['token'] = $user->createToken('MyApp')->plainTextToken;
        return $this->sendResponse($message);
    }

    public function login(LoginUserValidator $loginUserValidator)
    {
        if (!empty($loginUserValidator->getErrors())) {
            return response()->json($loginUserValidator->getErrors(), 406);
        }
        $request = $loginUserValidator->request();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'User logged in successfully.');

        } else {
            // return $this->sendError('Unauthorized.', ['error' => 'Unauthorized']);
            return $this->sendResponse('Unauthorized.', 'fail', 401);
        }

    }
}
