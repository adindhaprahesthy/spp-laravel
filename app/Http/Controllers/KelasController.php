<?php

namespace App\Http\Controllers;
use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class KelasController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_kelas'=>'required',
            'jurusan'=>'required',
            'angkatan'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save =kelas::create([
            'nama_kelas'=>$request->nama_kelas,
            'jurusan'=>$request->jurusan,
            'angkatan'=>$request->angkatan
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

    public function show()
    {
        return kelas::all();
    }

    public function detail($id)
    {
        if(kelas::where('id_kelas', $id)->exists()){
            $data_kelas= kelas::select('kelas.id_kelas', 'nama_kelas', 'jurusan', 'angkatan')->where('id_kelas', '=', $id)->get();
            return Response()->json($data_kelas);
        }
        else{
            return Response()->json(['message' => 'Tidak ditemukan']);
        }
    }

    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [   
            'nama_kelas'=>'required',
            'jurusan'=>'required',
            'angkatan'=>'required'
        ]); 

        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 

        $ubah = kelas::where('id_kelas', $id)->update([             
            'nama_kelas' =>$request->nama_kelas,
            'jurusan' =>$request->jurusan,
            'angkatan' =>$request->angkatan
              
        ]); 

        if($ubah) {             
            return Response()->json(['status' => 1]);         
        }         
        else {             
            return Response()->json(['status' => 0]);         
        }     
    }

    public function delete($id)
    {
        $hapus = kelas::where('id_kelas', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
        }

        else {
            return Response()->json(['status' => 0]);
        }
    }
}
