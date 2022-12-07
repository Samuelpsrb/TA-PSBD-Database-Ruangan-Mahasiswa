<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Mahasiswa;
use App\Models\Ruangan;
use App\Models\Petugas;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->search);
        if ($request->has("search") && $request->search !== null) {
            // $datas = DB::select('select mahasiswa.Nama, petugas.Namapetugas, ruangan.NamaPenerbit, 
            // ruangan.NamaRuangan, ruangan.Kapasitas from transaksi Inner join mahasiswa ON transaksi.id_mahasiswa=mahasiswa.id 
            // Inner Join petugas ON transaksi.id_petugas=petugas.id Inner Join ruangan ON transaksi.id_ruangan=ruangan.id 
            // where mahasiswa.nama = :search;',[
            //  "search"=>$request->search
            // ]);
            $datas = DB::select('select mahasiswa.*, ruangan.*, petugas.*, transaksi.* from transaksi Inner join mahasiswa ON transaksi.id_mahasiswa=mahasiswa.id 
            Inner Join petugas ON transaksi.id_petugas=petugas.id Inner Join ruangan ON transaksi.id_ruangan=ruangan.id 
            where mahasiswa.nama = :search;',[
             "search"=>$request->search
            ]);
            return view('transaksi.index')
            ->with('transaksi', $datas);   
        } elseif($request->search == null){
            $datas = DB::table('transaksi')
            ->join('ruangan', 'transaksi.id_ruangan', '=', 'ruangan.id')
            ->join('petugas', 'transaksi.id_petugas', '=', 'petugas.id')
            ->join('mahasiswa', 'transaksi.id_mahasiswa', '=', 'mahasiswa.id')
            ->get();
            // dd($data);
            return view('transaksi.index')
            ->with('transaksi', $datas);
        } else {
            $datas = DB::table('transaksi')
            ->join('ruangan', 'transaksi.id_ruangan', '=', 'ruangan.id')
            ->join('petugas', 'transaksi.id_petugas', '=', 'petugas.id')
            ->join('mahasiswa', 'transaksi.id_mahasiswa', '=', 'mahasiswa.id')
            ->get();
            // dd($data);
            return view('transaksi.index')
            ->with('transaksi', $datas);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::All();
        $ruangan = Ruangan::All();
        $petugas = Petugas::All();
        return view("transaksi.create", [
            'mahasiswa' => $mahasiswa,
            'ruangan' => $ruangan,
            'petugas' => $petugas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_mahasiswa' => 'required',
            'id_ruangan' => 'required',
            'id_petugas' => 'required',
            'lama_peminjaman' => 'required',
            'tanggal_peminjaman' => 'required',
        ]);

        // dd($validateData);

        Transaksi::create($validateData);
        return redirect()->route('transaksi.index')->with('success', 'Data Peminjaman berhasil disimpan');
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
        $mahasiswa = Mahasiswa::All();
        $ruangan = Ruangan::All();
        $petugas = Petugas::All();
        $transaksi = DB::table('transaksi')
        ->join('ruangan', 'transaksi.id_ruangan', '=', 'ruangan.id')
        ->join('petugas', 'transaksi.id_petugas', '=', 'petugas.id')
        ->join('mahasiswa', 'transaksi.id_mahasiswa', '=', 'mahasiswa.id')
        ->where('transaksi.id', $id)
        ->first();
        // dd($transaksi);
        return view("transaksi.edit", [
            'mahasiswa' => $mahasiswa,
            'ruangan' => $ruangan,
            'petugas' => $petugas,
            'transaksi' =>$transaksi,
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
        $validateData = $request->validate([
            'id_mahasiswa' => 'required',
            'id_ruangan' => 'required',
            'id_petugas' => 'required',
            'lama_peminjaman' => 'required',
            'tanggal_peminjaman' => 'required',
        ]);

        // dd($validateData);

        DB::table('transaksi')
        ->where('id', $id)
        ->update($validateData);
        return redirect()->route('transaksi.index')->with('success', 'Data Peminjaman berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('transaksi')->where('id', '=', $id)->delete();
        return redirect()->route('transaksi.index')->with('success', 'Data Peminjaman berhasil dihapus');
    }
}
