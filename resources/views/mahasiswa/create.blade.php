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
        <h1 class="text-center mb-5">Data Mahasiswa</h1>
        <a href="{{ route("mahasiswa.index")}}" class="btn btn-primary mb-3">Data Mahasiswa</a>
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
                <form action="{{ route("mahasiswa.store")}}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="Nama" class="form-label">Nama</label>
                      <input type="text" class="form-control" name="Nama" id="Nama">
                    </div>

                    <div class="mb-3">
                        <label for="MetodeBayar" class="form-label">No. HP</label>
                        <input type="text" class="form-control" name="MetodeBayar" id="MetodeBayar">
                      </div>
                    
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                  </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>