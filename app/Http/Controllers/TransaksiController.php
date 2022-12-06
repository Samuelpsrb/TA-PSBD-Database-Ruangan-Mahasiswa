<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Pembeli;
use App\Models\Buku;
use App\Models\Kasir;

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
            // $datas = DB::select('select pembeli.Nama, kasir.NamaKasir, buku.NamaPenerbit, 
            // buku.Judul, buku.Harga from transaksi Inner join pembeli ON transaksi.id_pembeli=pembeli.id 
            // Inner Join kasir ON transaksi.id_kasir=kasir.id Inner Join buku ON transaksi.id_buku=buku.id 
            // where pembeli.nama = :search;',[
            //  "search"=>$request->search
            // ]);
            $datas = DB::select('select pembeli.*, buku.*, kasir.*, transaksi.* from transaksi Inner join pembeli ON transaksi.id_pembeli=pembeli.id 
            Inner Join kasir ON transaksi.id_kasir=kasir.id Inner Join buku ON transaksi.id_buku=buku.id 
            where pembeli.nama = :search;',[
             "search"=>$request->search
            ]);
            return view('transaksi.index')
            ->with('transaksi', $datas);   
        } elseif($request->search == null){
            $datas = DB::table('transaksi')
            ->join('buku', 'transaksi.id_buku', '=', 'buku.id')
            ->join('kasir', 'transaksi.id_kasir', '=', 'kasir.id')
            ->join('pembeli', 'transaksi.id_pembeli', '=', 'pembeli.id')
            ->get();
            // dd($data);
            return view('transaksi.index')
            ->with('transaksi', $datas);
        } else {
            $datas = DB::table('transaksi')
            ->join('buku', 'transaksi.id_buku', '=', 'buku.id')
            ->join('kasir', 'transaksi.id_kasir', '=', 'kasir.id')
            ->join('pembeli', 'transaksi.id_pembeli', '=', 'pembeli.id')
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
        $mahasiswa = Pembeli::All();
        $ruangan = Buku::All();
        $petugas = Kasir::All();
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
            'id_pembeli' => 'required',
            'id_buku' => 'required',
            'id_kasir' => 'required',
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
        $mahasiswa = Pembeli::All();
        $ruangan = Buku::All();
        $petugas = Kasir::All();
        $transaksi = DB::table('transaksi')
        ->join('buku', 'transaksi.id_buku', '=', 'buku.id')
        ->join('kasir', 'transaksi.id_kasir', '=', 'kasir.id')
        ->join('pembeli', 'transaksi.id_pembeli', '=', 'pembeli.id')
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
            'id_pembeli' => 'required',
            'id_buku' => 'required',
            'id_kasir' => 'required',
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
