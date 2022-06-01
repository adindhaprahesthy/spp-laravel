<?php

namespace App\Http\Controllers;

use App\Models\petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    //create data 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'     => 'required',
            'password'     => 'required',
            'nama_petugas' => 'required',
            'level'        => 'required'

        ]);

        if($validator -> fails()){
            return Response() -> json($validator -> errors());
        }

        $store = petugas::create([
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'nama_petugas' => $request->nama_petugas,
            'level'        => $request->level

        ]);

        $data = petugas::where('nama_petugas', '=', $request->nama_petugas)->get();
        if($store){
            return Response() -> json([
                'status' => 1,
                'message' => 'Succes menambahkan data baru!',
                'data' => $data
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
        return petugas::all();
    }

    public function detail($id){
        if(DB::table('petugas')->where('id_petugas', $id)->exists()){
            $detail_petugas = DB::table('petugas')
            ->select('petugas.*')
            ->where('id_petugas', $id)
            ->get();
            return Response()->json($detail_petugas);
        }else {
            return Response()-> json(['message' => 'Tidak dapat menemukan data']);
        }
    }
    

    //update data 
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),
        [
            'username'     => 'required',
            'password'     => 'required',
            'nama_petugas' => 'required',
            'level'        => 'required'
        ]);

        if($validator -> fails()){
            return Response() -> json($validator -> errors());
        }

        $update = DB::table('petugas')
        ->where('id_petugas', '=', $id)
        ->update([
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'nama_petugas' => $request->nama_petugas,
            'level'        => $request->level
        ]);

        $data=petugas::where('id_petugas', '=', $id)->get();
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
        $delete = DB::table('petugas')
        ->where('id_petugas', '=', $id)
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