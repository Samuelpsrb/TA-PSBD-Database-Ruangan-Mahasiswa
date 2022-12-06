<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DB::select('select * from pembeli where is_delete is NULL');
        return view('mahasiswa.index')
            ->with('pembeli', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("mahasiswa.create");
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

            'Nama' => 'required',
            'MetodeBayar' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named
        DB::insert(
            'INSERT INTO pembeli(Nama,MetodeBayar) VALUES
        (:Nama, :MetodeBayar)',
            [
                'Nama' => $request->Nama,
                'MetodeBayar' => $request->MetodeBayar,
            ]
        );
        return redirect()->route('mahasiswa.index')->with('success', 'Data Admin berhasil disimpan');
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
        return view('mahasiswa.edit')->with([
            "pembeli" => Pembeli::find($id),
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

            'Nama' => 'required',
            'MetodeBayar' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named
        DB::update('UPDATE pembeli SET Nama = :Nama, MetodeBayar = :MetodeBayar where id=:id',
            [
                'id' => $id,
                'Nama' => $request->Nama,
                'MetodeBayar' => $request->MetodeBayar,
            ]
        );
        return redirect()->route('mahasiswa.index')->with('success', 'Data Admin berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembeli = Pembeli::find($id);
        $pembeli->delete();

        return back()->with("Success", "Data Berhasil di Hapus.");
    }

    public function soft($id)
    {
        DB::update('UPDATE pembeli SET is_delete = 1 WHERE id = :id', ['id' => $id]);

        return redirect()->route('pembeli.index')->with('success', 'Data Barang berhasil dihapus');
    }
}
