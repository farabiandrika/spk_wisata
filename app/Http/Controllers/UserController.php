<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = User::where('role','user')->orderBy('created_at')->get();
            
            return DataTables::of($user)
                ->addIndexColumn()
                ->make(true);
        } catch (QueryException $err) {
            return response()->json([
                'message' => 'Failed '.$err->errorInfo,
            ]);
        }
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
        try {
            $request->request->add(['role' => 'siswa']);
            $validator = Validator::make($request->all(), [
                'email' => 'nullable|string|max:255',
                'jurusan' => 'string|nullable|max:255',
                'kelas' => 'string|nullable|max:255',
                'name' => 'string|nullable|max:255',
                'nis' => 'numeric|nullable',
                'password' => 'required|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'tempat_lahir' => 'nullable|string|max:255',
                'username' => 'string|required|max:255|unique:users,username|min:8',
                'role' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Failed To Create',
                    'data' => $validator->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $user = User::create($validator->validated());

            $response = [
                'message' => 'Siswa Created',
                'data' => $user
            ];
            
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed '.$e,
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::where('id',$id)->where('role','siswa')->first();

            $response = [
                'message' => 'Siswa Obtained',
                'data' => $user
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed '.$e->errorInfo,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
            $rules = [
                'email' => 'nullable|string|max:255',
                'jurusan' => 'string|nullable|max:255',
                'kelas' => 'string|nullable|max:255',
                'name' => 'string|nullable|max:255',
                'nis' => 'numeric|nullable',
                'tanggal_lahir' => 'nullable|date',
                'tempat_lahir' => 'nullable|string|max:255',
                'username' => 'string|required|max:255|min:8|unique:users,username,'.$id,
            ];

            if ($request->password != null) {
                $request->request->add(['password' => $request->password]);
                $rules['password'] = 'string|max:255';
            }

            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Failed To Update',
                    'data' => $validator->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
    
            $user = User::find($id)->update($validator->validated());
    
            $response = [
                'message' => 'Siswa Updated',
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
    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            $response = [
                'message' => 'Siswa Deleted',
            ];
            return response()->json($response, Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed '.$e->errorInfo,
            ]);
        }
    }
}
