<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    //create data 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_petugas'        => 'required',
            'nisn'              => 'required',
            'tgl_bayar'         => 'required',
            'bulan_spp'         => 'required',
            'tahun_spp'         => 'required'

        ]);

        if($validator -> fails()){
            return Response() -> json($validator -> errors());
        }

        $store = pembayaran::create([

            'id_petugas'        => $request->id_petugas,
            'nisn'              => $request->nisn,
            'tgl_bayar'         => $request->tgl_bayar,
            'bulan_spp'         => $request->bulan_spp,
            'tahun_spp'         => $request->tahun_spp

        ]);

        $data = pembayaran::where('id_pembayaran', '=', $request->id_pembayaran)->get();
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
        return pembayaran::all();
    }

    public function detail($id){
        if(DB::table('pembayaran')->where('id_pembayaran', $id)->exists()){
            $detail_pembayaran = DB::table('pembayaran')
            ->select('pembayaran.*')
            ->where('id_pembayaran', $id)
            ->get();
            return Response()->json($detail_pembayaran);
        }else {
            return Response()-> json(['message' => 'Tidak dapat menemukan data']);
        }
    }
    

    //update data 
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),
        [
            'id_petugas'        => 'required',
            'nisn'              => 'required',
            'tgl_bayar'         => 'required',
            'bulan_spp'         => 'required',
            'tahun_spp'         => 'required'
        ]);

        if($validator -> fails()){
            return Response() -> json($validator -> errors());
        }

        $update = DB::table('pembayaran')
        ->where('id_pembayaran', '=', $id)
        ->update([
            'id_petugas'        => $request->id_petugas,
            'nisn'              => $request->nisn,
            'tgl_bayar'         => $request->tgl_bayar,
            'bulan_spp'         => $request->bulan_spp,
            'tahun_spp'         => $request->tahun_spp
        ]);

        $data=pembayaran::where('id_pembayaran', '=', $id)->get();
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
        $delete = DB::table('pembayaran')
        ->where('id_pembayaran', '=', $id)
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