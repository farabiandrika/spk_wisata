<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $kriteria = Kriteria::all();
            
            return DataTables::of($kriteria)
                ->addIndexColumn()
                ->addColumn('keterangan', function($row) {
                    return $row->benefit == 1 ? 'Benefit' : 'Cost';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-id='.$row->id.'>Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id='.$row->id.'>Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
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
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255',
                'bobot' => 'required',
                'benefit' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Failed To Create',
                    'data' => $validator->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            
            $validator1 = Validator::make($request->all(), [
                'nama_sub_kriteria' => 'required|max:255',
                'nama_sub_kriteria.*' => 'required|max:255',
                'keterangan' => 'required|max:255',
                'keterangan.*' => 'required|max:255',
            ]);
            
            if ($validator1->fails()) {
                return response()->json([
                    'message' => 'Failed To Create',
                    'data' => $validator1->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $kriteria = Kriteria::create($validator->validated());

            self::generateKriteria();

            for ($i=0; $i < count($request->nama_sub_kriteria); $i++) { 
                $sub = [
                    'nama' => $request->nama_sub_kriteria[$i],
                    'keterangan' => $request->keterangan[$i],
                    'nilai' => $request->nilai[$i],
                    'kriteria_id' => $kriteria->id,
                ];

                $subKriteria = SubKriteria::create($sub);
            }

            $response = [
                'message' => 'Kriteria Created Created',
                'data' => $kriteria
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
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $kriteria = Kriteria::where('id',$id)->with('subKriterias')->first();
            $response = [
                'message' => 'Kriteria Obtained',
                'data' => $kriteria
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
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'nama' => 'required|string|max:255',
                'bobot' => 'required',
                'benefit' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Failed To Update',
                    'data' => $validator->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $validator1 = Validator::make($request->all(), [
                'nama_sub_kriteria' => 'required|max:255',
                'nama_sub_kriteria.*' => 'required|max:255',
                'keterangan' => 'required|max:255',
                'keterangan.*' => 'required|max:255',
            ]);
            
            if ($validator1->fails()) {
                return response()->json([
                    'message' => 'Failed To Update',
                    'data' => $validator1->errors(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
    
            $kriteria = Kriteria::find($id)->update($validator->validated());
    
            self::generateKriteria();

            SubKriteria::where('kriteria_id', $id)->delete();

            for ($i=0; $i < count($request->nama_sub_kriteria); $i++) { 
                $subKriteria = [
                    'nama' => $request->nama_sub_kriteria[$i],
                    'keterangan' => $request->keterangan[$i],
                    'nilai' => $request->nilai[$i],
                    'kriteria_id' => $id,
                ];

                SubKriteria::create($subKriteria);
            }

            $response = [
                'message' => 'Kriteria Updated',
                'data' => $kriteria
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
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Kriteria::find($id)->delete();
            self::generateKriteria();
            $response = [
                'message' => 'Kriteria Deleted',
            ];
            return response()->json($response, Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed '.$e->errorInfo,
            ]);
        }
    }

    private static function generateKriteria() {
        $kriterias = Kriteria::all();
        
        // Normalisasi Kriteria
        $normalisasiKriteria = self::normalisasiKriteria($kriterias);

        foreach ($kriterias as $key => $kriteria) {
            $kriteria->ternormalisasi = $normalisasiKriteria[$key];
            $kriteria->save();
        }
    }

    private static function normalisasiKriteria($kriterias) {
        $data = [];
        $totalBobot = 0;
        foreach ($kriterias as $key => $kriteria) {
            $totalBobot += $kriteria->bobot;
        }

        foreach ($kriterias as $key => $kriteria) {
            $data[$key] = round($kriteria->bobot/$totalBobot,3);
        }

        return $data;
    }
}
