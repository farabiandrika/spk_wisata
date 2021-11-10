<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifKriteria;
use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $alternatif = Alternatif::all();
            
            return DataTables::of($alternatif)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-id='.$row->id.'>Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id='.$row->id.'>Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (QueryException $err) {
            return response()->json([
                'message' => 'Failed '.$err,
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
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Failed To Create',
                    'data' => $validator->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $imageName = Str::slug($request->nama).'_'.time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('upload/images'), $imageName);

            $alternatif = Alternatif::create(array_merge($validator->validated(), ['gambar' => $imageName]));

            $response = [
                'message' => 'Alternatif Created',
                'data' => $alternatif
            ];

            $kriterias = Kriteria::all();

            foreach ($kriterias as $key => $kriteria) {
                AlternatifKriteria::create([
                    'kriteria_id' => $kriteria->id,
                    'alternatif_id' => $alternatif->id,
                    'nilai' => $request[$kriteria->id],
                ]);
            }
            
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
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $alternatif = Alternatif::where('id', $id)->with('alternatifKriterias')->first();
            $kriterias = Kriteria::with('subKriterias')->get();

            $response = [
                'message' => 'Alternatif Obtained',
                'data' => $alternatif,
                'kriterias' => $kriterias,
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
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternatif $alternatif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alternatif $alternatif)
    {
        try {
            $rules = [
                'nama' => 'required|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Failed To Update',
                    'data' => $validator->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            AlternatifKriteria::where('alternatif_id', $alternatif->id)->delete();
            
            $kriterias = Kriteria::all();

            foreach ($kriterias as $key => $kriteria) {
                AlternatifKriteria::create([
                    'kriteria_id' => $kriteria->id,
                    'alternatif_id' => $alternatif->id,
                    'nilai' => $request[$kriteria->id],
                ]);
            }
    
            $alternatif = $alternatif->update($validator->validated());
    
            $response = [
                'message' => 'Alternatif Updated',
                'data' => $alternatif
            ];
            
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed '.$e,
            ]);
        }
    }
    
    public function updateV2(Request $request, $id)
    {
        try {
            $rules = [
                'nama' => 'required|string|max:255',
            ];

            $alternatif = Alternatif::findOrFail($id);

            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Failed To Update',
                    'data' => $validator->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            AlternatifKriteria::where('alternatif_id', $alternatif->id)->delete();
            
            $kriterias = Kriteria::all();

            foreach ($kriterias as $key => $kriteria) {
                AlternatifKriteria::create([
                    'kriteria_id' => $kriteria->id,
                    'alternatif_id' => $alternatif->id,
                    'nilai' => $request[$kriteria->id],
                ]);
            }
    
            if ($request->gambar) {
                unlink(public_path('upload/images/'.$alternatif->gambar));

                $imageName = Str::slug($request->nama).'_'.time().'.'.$request->gambar->extension();  
                $request->gambar->move(public_path('upload/images'), $imageName);
                $alternatif->update(['gambar' => $imageName]);
            }

            $alternatif = $alternatif->update($validator->validated());
    
            $response = [
                'message' => 'Alternatif Updated',
                'data' => $alternatif
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
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternatif $alternatif)
    {
        try {
            unlink(public_path('upload/images/'.$alternatif->gambar));

            $alternatif->delete();

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
