@extends('layout.main')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Update Data Peminjaman</h3>
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
                    <h4 class="card-title">Masukkan Data Peminjaman Baru</h4>
                    <p class="card-description">Peminjaman Baru</p>
                    <form class="forms-sample" action="{{ route('modify.peminjaman', $data->id_peminjaman) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        {{-- <div class="form-group">
                            <input type="hidden" name="id_peminjaman" value="{{ $generatedIdPeminjaman }}">
                        </div> --}}
                        <input type="hidden" name="id_peminjaman" value="{{ $id_peminjaman }}">
                        <div class="form-group">
                            <label for="peminjam">Peminjam</label>
                            <select name="id_peminjam" class="form-control" id="peminjam">
                                <option value="" selected disabled>Pilih Peminjam</option>
                                @foreach($dataPeminjam as $peminjam)
                                    <option value="{{ $peminjam->id }}" {{ $data->id_peminjam == $peminjam->id ? 'selected' : '' }}>
                                        {{ $peminjam->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="judul_komik">Judul Komik yang Dipinjam</label>
                            <select name="id_komik" class="form-control" id="id_komik">
                                <option value="" selected disabled>Pilih Judul Komik</option>
                                @foreach($dataKomik as $komik)
                                    <option value="{{ $komik->id_komik }}" {{ $data->id_komik == $komik->id_komik ? 'selected' : '' }}>
                                        {{ $komik->judul_comic }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="" selected disabled>Status</option>
                                <option value="Dipinjam" {{ $data->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Dikembalikan" {{ $data->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                            </select>
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
