<?php

namespace App\Http\Controllers;

use App\Models\spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SppController extends Controller
{
    //create data 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'angkatan'  => 'required',
            'tahun'      => 'required',
            'nominal'    => 'required'

        ]);

        if($validator -> fails()){
            return Response() -> json($validator -> errors());
        }

        $store = spp::create([
            'angkatan'  => $request->angkatan,
            'tahun'      => $request->tahun,
            'nominal'    => $request->nominal

        ]);

        $data = spp::where('id_spp', '=', $request->id_spp)->get();
        if($store){
            return Response() -> json([
                'status' => 1,
                'message' => 'Succes menambahkan data baru!',
            ]);
        } else 
        {   
            return Response()->json([
                'status' => 0,
                'message' => 'Gagal menambahkan data baru!'
            ]);
        }
    }
    

    // show data 
    public function show(){
        return spp::all();
    }

    public function detail($id){
        if(DB::table('spp')->where('id_spp', $id)->exists()){
            $detail_spp = DB::table('spp')
            ->select('spp.*')
            ->where('id_spp', $id)
            ->get();
            return Response()->json($detail_spp);
        }else {
            return Response()-> json(['message' => 'Tidak dapat menemukan data']);
        }
    }
    

    //update data 
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),
        [
            'angkatan'      => 'required',
            'tahun'         => 'required',
            'nominal'       => 'required'
        ]);

        if($validator -> fails()){
            return Response() -> json($validator -> errors());
        }

        $update = DB::table('spp')
        ->where('id_spp', '=', $id)
        ->update([
            'angkatan'     => $request->angkatan,
            'tahun'        => $request->tahun,
            'nominal'      => $request->nominal
        ]);

        $data=spp::where('id_spp', '=', $id)->get();
        if($update){
            return Response() -> json([
                'status' => 1,
                'message' => 'Success menambahkan data!',
                'data' => $data  
            ]);
        } else {
            return Response() -> json([
                'status' => 0,
                'message' => 'Gagal menambahkan data!'
            ]);
        }
    }
    

    //delete data 
    public function delete($id){
        $delete = DB::table('spp')
        ->where('id_spp', '=', $id)
        ->delete();

        if($delete){
            return Response() -> json([
                'status' => 1,
                'message' => 'Succes hapus data!'
        ]);
        } else {
            return Response() -> json([
                'status' => 0,
                'message' => 'Gagal hapus data!'
        ]);
        }

    }
   
}