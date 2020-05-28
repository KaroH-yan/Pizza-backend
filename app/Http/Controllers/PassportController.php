<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PassportController extends Controller
{

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {


        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken($user->email)->accessToken;
            return response()->json([
                'message' => 'Success',
                'token' => $token
            ], 200);

        } else {
            return response()->json(['message' => 'The given data was invalid.'], 422);
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}
