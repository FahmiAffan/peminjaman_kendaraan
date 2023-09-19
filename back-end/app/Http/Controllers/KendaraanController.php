<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Kendaraan::all();
        return response()->json($data);
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
        //
        $data = Kendaraan::create(
            [
                "nama_kendaraan" => $request->nama_kendaraan,
                "jenis_angkutan_kendaraan" => $request->jenis_angkutan_kendaraan,
                "kilometer_kendaraan" => $request->kilometer_kendaraan,
                "pemilik_kendaraan" => $request->pemilik_kendaraan,
            ]
        );
        return response()->json($data);
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
        //
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
        //
        $data = Kendaraan::where("id_kendaraan", "=", $id)->update([
            "nama_kendaraan" => $request->nama_kendaraan,
            "jenis_angkutan_kendaraan" => $request->jenis_angkutan_kendaraan,
            "kilometer_kendaraan" => $request->kilometer_kendaraan,
            "pemilik_kendaraan" => $request->pemilik_kendaraan,
        ]);
        return response()->json(
            [
                "data" => $data,
                "id" => $id,
                "success" => true
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Kendaraan::where("id_kendaraan", "=", $id)->get();
        if ($data) {
            Kendaraan::where("id_kendaraan", "=", $id)->delete();
        }
        return response()->json("Data Berhasil Dihapus");
    }
}
