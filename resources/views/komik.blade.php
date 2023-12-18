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
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Komik</h4>
                <p class="card-description">
                    <a href="{{ route ('komik.createkom') }}" class="btn btn-success btn-rounded btn-fw">Add komik</a>
                </p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID_Komik</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Pemilik</th>
                                <th>Sinopsis</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->id_komik }}</td>
                                    <td>{{ $d->judul_comic }}</td>
                                    <td>{{ $d->pengarang }}</td>
                                    <td>{{ $d->pemilikModel->name }}</td>
                                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ Str::limit($d->sinopsis, $limit = 100, $end = '...') }}
                                    </td>
                                    
                                    
                                    <td>
                                        <img src="{{ asset('skydash/images/' . basename($d->gambar_komik)) }}" alt="{{ $d->judul_comic }}" style="width: 100px; height: 100px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.komik', $d->id_komik) }}" class="btn btn-success"><i class="fas fa-sync-alt"></i>Update</a>
                                        <a href="{{ route('destroy.komik', $d->id_komik) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Hapus</a>
                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Raihan Maulana</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Pendidikan Teknik Informatika <i class="ti-heart text-danger ml-1"></i></span>
            </div>
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">UNP </span>
            </div>
        </footer>
        <!-- partial -->
    </div>
</div>
@endsection