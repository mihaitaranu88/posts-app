<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return User::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return User|\Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create((array) $request->except(['id']));

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return User|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->with('posts')->firstOrFail();

        return $user;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return User|\Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->except(['id']));

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();

        return response()->json(null, 204);
    }
}
