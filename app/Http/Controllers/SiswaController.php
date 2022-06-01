<?php

namespace App\Http\Controllers;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[                                                                                                                                                          
            'nis'=>'required',
            'nama'=>'required',
            'id_kelas'=>'required',
            'alamat'=>'required',
            'no_tlp'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save = siswa::create([
            'nis'         =>$request->nis,
            'nama'        =>$request->nama,
            'id_kelas'    =>$request->id_kelas,
            'alamat'    =>$request->alamat,
            'no_tlp'      =>$request->no_tlp
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

        public function show()
        {
            $data_siswa = siswa::join('kelas', 'kelas.id_kelas', 'siswa.nisn')->get();
            return Response()->json($data_siswa);
        }
        
        public function detail($id)
        {
            if(siswa::where('nisn', $id)->exists()){
                $data_siswa = siswa::join('kelas', 'kelas.id_kelas', 'siswa.id_kelas') ->where('siswa.nisn', '=', $id)->get();
                return Response()->json($data_siswa);
            }
            else{
                return Response()->json(['message' => 'Tidak ditemukan']);
            }
        }

    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [   
            'nis'=>'required',
            'nama'=>'required',
            'id_kelas'=>'required',
            'alamat'=>'required',
            'no_tlp' =>'required'          
        ]); 

        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 

        $ubah = siswa::where('nisn', $id)->update([             
            'nis' =>$request->nis,
            'nama' =>$request->nama,
            'id_kelas' =>$request->id_kelas,
            'alamat' =>$request->alamat,
            'no_tlp' =>$request->no_tlp
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
        $hapus = siswa::where('nisn', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
        }

        else {
            return Response()->json(['status' => 0]);
        }
    }
    
}
