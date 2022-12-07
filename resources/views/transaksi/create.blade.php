<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RooM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Data Peminjaman</h1>
        <a href="{{ route("transaksi.index")}}" class="btn btn-primary mb-3">Data Peminjaman</a>
        @if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route("transaksi.store")}}" method="POST">
                    @csrf
                    <div>
                        <label for="NamaMahasiswa" class="form-label">Nama Mahasiswa</label> <br>
                        <select id="department" style="width:500px; height:35px; border:1px solid #666; border-radius:5px;" name="id_mahasiswa">
                            <option selected style="text-align:center" disabled>-- Pilih Nama Mahasiswa --</option>
                            @foreach($mahasiswa as $m)
                              <option value="{{ $m->id }}">{{ $m->Nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="NamaPetugas" class="form-label">Nama Petugas</label> <br>
                        <select id="department" style="width:500px; height:35px; border:1px solid #666; border-radius:3px;" name="id_petugas">
                            <option selected style="text-align:center" disabled>-- Pilih Nama Petugas --</option>
                            @foreach($petugas as $p)
                              <option value="{{ $p->id }}">{{ $p->NamaPetugas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="Ruangan" class="form-label">Ruangan</label> <br>
                        <select id="department" style="width:500px; height:35px; border:1px solid #666; border-radius:3px;" name="id_ruangan">
                            <option selected style="text-align:center" disabled>-- Pilih Ruangan --</option>
                            @foreach($ruangan as $r)
                              <option value="{{ $r->id }}">{{ $r->NamaRuangan }}</option>
                            @endforeach
                        </select>
                    </div>

                      <div class="mb-3">
                        <label for="LamaPeminjaman" class="form-label">Lama Peminjaman</label>
                        <input type="number" class="form-control" name="lama_peminjaman" id="LamaPeminjaman">
                      </div>

                      <div class="mb-3">
                        <label for="TanggalPeminjaman" class="form-label">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" name="tanggal_peminjaman" id="TanggalPeminjaman">
                      </div>
                    
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                  </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>