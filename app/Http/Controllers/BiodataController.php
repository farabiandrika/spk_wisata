<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $rules = [
                'email' => 'nullable|string|max:255',
                'name' => 'string|nullable|max:255',
                'tanggal_lahir' => 'nullable|date',
                'tempat_lahir' => 'nullable|string|max:255',
                'jenis_kelamin' => 'required|string|max:255',
                'username' => 'string|required|max:255|min:8|unique:users,username,'.$user->id,
            ];

            if ($request->password != null) {
                if (Hash::check($request->old_passowrd, $user->password)) {
                    return response()->json([
                        'message' => 'Failed To Update',
                        'data' => ['Old Password Not Match'],
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                }

                $request->request->add(['password' => $request->password]);
                $rules['password'] = 'string|max:255|confirmed';
            }

            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Failed To Update',
                    'data' => $validator->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
    
            $user = $user->update($validator->validated());
    
            $response = [
                'message' => 'Biodata Updated',
                'data' => $user
            ];
            
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed '.$e,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
