<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends BaseController
{
    /**
     * Login api
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'max:50', 'exists:users'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('API Token')->plainTextToken;
            $success['token_type'] = 'Bearer';
            $success['user'] = $user;

            return $this->sendResponse($success, 'User login successfully.');

        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Login detail is invalid']);
        }
    }

    /**
     * Logout api
     *
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return $this->sendResponse(null, 'You have been successfully logged out!');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string', 'max:16'],
            'password' => ['required', 'string', 'min:8', 'max:16'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                "password" => Hash::make($request->password),
            ]);
            return $this->sendResponse(null, 'Password Changed Successfully!');
        }

        return $this->sendError('ERROR', ['error' => 'Invalid Old Password'], 422);
    }

    /**
     * Profile api
     *
     * @return JsonResponse
     */
    public function profile()
    {
        $user = Auth::user();

        return $this->sendResponse($user, 'Success!');
    }
}
