<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">
            {{ __('TABEL PEMINJAMAN') }}
        </h2>
    </x-slot>

<div class="container mt-5">
    <form class = "row mt-3 ml-3 justify-content-center "action="/transaksi" method="get">
        <h2 class="text-center mb-1">Search Here</h2>
        <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
        <input class="w-50" type="text" name="search"/>
        <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
    </form>
    <a href="{{ route("transaksi.create")}}" class="btn btn-primary btn-sm ml-1">Tambah Data</a>
    <div class="card mt-3">
        <div class="card-body">
            <table class="table">
                <thead>
                <th>ID_Peminjaman</th>
                <th>Mahasiswa</th>
                <th>Petugas</th>
                <th>Ruangan</th>
                <th>Lama Peminjaman</th>
                <th>Tanggal Peminjaman</th>
                <th>Aksi</th>
                
                </thead>
                <tbody>
                    @foreach ($transaksi as $no => $hasil)
                    <tr>
                    <td>{{$hasil->id}}</td>
                    <td>{{$hasil->Nama}}</td>
                    <td>{{$hasil->NamaPetugas}}</td>
                    <td>{{$hasil->NamaRuangan}}</td>
                    <td>{{$hasil->lama_peminjaman}} hari</td>
                    <td>{{$hasil->tanggal_peminjaman}}</td>
                    <td>
                        <a href="{{ route("transaksi.edit", $hasil->id)}}"  class="btn btn-success btn-sm">Edit</a>
                        <!-- Button trigger modal -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $hasil->id }}">
                        Hapus
                    </button>
                    <!-- <form class = "mt-1 form-inline" method="POST" action="{{ route('ruangan.soft', $hasil->id) }}">
                        @csrf
                            <button onclick="return confirm('{{ __('Are you sure you want to destroy?') }}')" type="submit" class="btn btn-warning">Hapus Bentar</button>
                    </form> -->
                    

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $hasil->id}}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('transaksi.destroy', $hasil->id) }}">
                                    @csrf
                                    @method("delete")
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary bg-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button  class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

</x-app-layout>