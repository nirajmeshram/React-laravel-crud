<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt(12345678);
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        if ($user->save()) {
            return response()->json(['status' => 'success', 'message' => 'User saved Successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong. Please try again later']);
        }
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
        try {
            $user = User::findOrFail($id);
            return response()->json(['status' => 'success', 'user' => $user]);
        } catch (Exception $e) {
            info($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Something went wrong. Please try again later']);
        }
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
        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
            return response()->json(['status' => 'success', 'message' =>'User updated successfully.']);
        } catch (Exception $e) {
            info($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (Exception $e) {
            info($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Something went wrong. Please try again later']);
        }
    }
}
