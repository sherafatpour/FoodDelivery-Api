<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {

        // $usr = new User();

        // if (Gate::forUser(auth()->user())->allows('view', $usr)) {
        // }
        // return response(['message' => 'Forbidden'], 403);

        // search user
        if ($request->has('name')) {

            $user = User::where('name', 'LIKE', '%' . $request['name'] . '%')->paginate();

            return $user;
        }

        // all user
        $user = User::paginate();

        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   App\Http\Requests\UserRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {

        $usr = new User();

        $user = User::create([
            "name" => $request['name'],
            "mobile" => $request['mobile'],
            "password" => bcrypt($request['password']),
            "user_role" => $request['user_role'],
            "user_status" => 1,
        ]);

        $token = $user->createToken('myAppToken')->plainTextToken;
        $response = [

            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        //get user
        $user = User::where('id', $user)->first();

        //check exist user
        if (!$user) {

            return Response(['message' => 'Not Found User'], 404);
        }

        //delete user
        $destroy = $user->delete();
        return Response(['message' => 'User Deleted'], 202);
    }


    /**
     * Logout User
     * 
     * 
     */

    public function logout()
    {

        auth()->user()->tokens()->delete();

        return ['message' => 'logged out'];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param   App\Http\Requests\UserLoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request)
    {

        //check mobile 
        $user = User::where('mobile', $request['mobile'])->first();

        //check password
        if (!$user || !Hash::check($request['password'], $user->password)) {

            return Response(['message' => 'Bad Credential'], 401);
        }

        $token = $user->createToken('myAppToken')->plainTextToken;
        $response = [

            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
