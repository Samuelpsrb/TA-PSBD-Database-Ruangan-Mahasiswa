<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DB::select('select * from ruangan where is_delete is null');
        return view('ruangan.index')
            ->with('ruangan', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ruangan.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'NamaRuangan' => 'required',
            'Kapasitas' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named
        DB::insert(
            'INSERT INTO ruangan(NamaRuangan,Kapasitas) VALUES
        (:NamaRuangan, :Kapasitas)',
            [
                'NamaRuangan' => $request->NamaRuangan,
                'Kapasitas' => $request->Kapasitas,
            ]
        );
        return redirect()->route('ruangan.index')->with('success', 'Data Admin berhasil disimpan');
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
        return view('ruangan.edit')->with([
            "ruangan" => Ruangan::find($id),
        ]);
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
        $request->validate([

            'NamaRuangan' => 'required',
            'Kapasitas' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named
        DB::update('UPDATE ruangan SET NamaRuangan = :NamaRuangan, Kapasitas = :Kapasitas  where id=:id',
            [
                'id' => $id,
                'NamaRuangan' => $request->NamaRuangan,
                'Kapasitas' => $request->Kapasitas,
            ]
        );
        return redirect()->route('ruangan.index')->with('success', 'Data Admin berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mahasiswa = Ruangan::find($id);
        $mahasiswa->delete();

        return back()->with("Success", "Data Berhasil di Hapus.");
    }

    public function soft($id)
    {
        DB::update('UPDATE ruangan SET is_delete = 1 WHERE id = :id', ['id' => $id]);

        return redirect()->route('ruangan.index')->with('success', 'Data Barang berhasil dihapus');
    }
}
