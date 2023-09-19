<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Pemesanan::all();
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
        $data = Pemesanan::create(
            [
                "driver" => $request->driver,
                "persetujuan_admin" => $request->persetujuan_admin,
                "persetujuan_pihak" => $request->persetujuan_pihak,
                "id_user" => $request->id_user,
                "id_kendaraan" => $request->id_kendaraan
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
        $data = Pemesanan::where("id_kendaraan", "=", $id)->update([
            "driver" => $request->driver,
            "persetujuan_admin" => $request->persetujuan_admin,
            "persetujuan_pihak" => $request->persetujuan_pihak,
            "id_user" => $request->id_user,
            "id_kendaraan" => $request->id_kendaraan
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
        $data = Pemesanan::where("id_pemesanan", "=", $id)->get();
        if ($data) {
            Pemesanan::where("id_pemesanan", "=", $id)->delete();
        }
        return response()->json("Data Berhasil Dihapus");
    }
}
