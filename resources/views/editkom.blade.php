@extends('layout.main')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Data Komik</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Komik Baru</h4>
                    <p class="card-description">Edit Komik Baru</p>
                    <form class="forms-sample" action="{{ route('modify.komik', $data->id_komik) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleInputName1">Judul Komik</label>
                            <input type="text" name="judul_comic" value="{{ $data ? $data->judul_comic : old('judul_comic') }}" class="form-control" id="exampleInputjudul_comic" placeholder="Masukkan Judul komik">

                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Pengarang</label>
                            <input type="text" name="pengarang" value="{{ $data ? $data->pengarang : old('pengarang') }}" class="form-control" id="exampleInputpengarang"
                                placeholder="Masukkan Nama Pengarang" value="{{ old('pengarang') }}">
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Pemilik Komik</label>
                            <input type="text" name="pemilik" value="{{ $data ? $data->pemilik : old('pemilik') }}"class="form-control" id="exampleInputPemilik"
                                placeholder="Masukkan Nama Pemilik" value="{{ old('pemilik') }}">
                            
                        </div>

                        <div class="form-group">
                            <label for="exampleInputsinopsis">Sinopsis</label>
                            <textarea name="sinopsis" class="form-control" id="exampleInputsinopsis" placeholder="Masukkan Sinopsis">{{ old('sinopsis') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Masukkan Gambar</label>
                            <input type="file" name="img" value="{{ $data ? $data->gambar_komik : old('gambar_komik') }}"class="file-upload-default" id="img">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" readonly
                                    placeholder="Masukkan Gambar">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button"
                                        onclick="$('#img').click()">Upload</button>
                                </span>
                            </div>
                        </div>
                        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
    </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Memicu klik pada input file ketika tombol "Upload" ditekan
        $(document).ready(function () {
            $('.file-upload-browse').on('click', function () {
                $('#img').click();
            });

            // Menampilkan nama file yang dipilih di dalam input teks
            $('#img').on('change', function () {
                var fileName = $(this).val().split('\\').pop();
                $('.file-upload-info').val(fileName);
            });
        });
    </script>
</div>
