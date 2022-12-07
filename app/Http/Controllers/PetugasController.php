<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DB::select('select * from petugas where is_delete is NULL');
        return view('petugas.index')
            ->with('petugas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("petugas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
        
        'NamaPetugas' => 'required',
        'NoHP' => 'required',
        'Alamat' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named
        DB::insert('INSERT INTO petugas(NamaPetugas,NoHP,Alamat) VALUES
        (:NamaPetugas, :NoHP, :Alamat)',
        [
        'NamaPetugas' => $request->NamaPetugas,
        'NoHP' => $request->NoHP,
        'Alamat' => $request->Alamat,
        ]
        );
        return redirect()->route('petugas.index')-> with('success', 'Data Admin berhasil disimpan');
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
        return view('petugas.edit')->with([
            "petugas" => Petugas::find($id),
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

            'NamaPetugas' => 'required',
            'NoHP' => 'required',
            'Alamat' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named
        DB::update('UPDATE petugas SET NamaPetugas = :NamaPetugas, NoHP = :NoHP, Alamat = :Alamat where id=:id',
            [
                'id' => $id,
                'NamaPetugas' => $request->NamaPetugas,
                'NoHP' => $request->NoHP,
                'Alamat' => $request->Alamat,
            ]
        );
        return redirect()->route('petugas.index')->with('success', 'Data Admin berhasil diubah');
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mahasiswa = Petugas::find($id);
        $mahasiswa -> delete();

        return back()->with("Success","Data Berhasil di Hapus.");
    }

    public function soft($id)
    {
        DB::update('UPDATE petugas SET is_delete = 1 WHERE id = :id', ['id' => $id]);

        return redirect()->route('petugas.index')->with('success', 'Data Barang berhasil dihapus');
    }
}