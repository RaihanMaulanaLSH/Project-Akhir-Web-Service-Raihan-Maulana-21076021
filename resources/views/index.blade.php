@extends('layout.main')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Data User</h3>
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
                  <h4 class="card-title">User</h4>
                  <p class="card-description">
                  <a href="{{ route ('user.create') }}" class="btn btn-success btn-rounded btn-fw">Add User</a>

                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @foreach ($data as $d)
                        <tr>
                            <td>({{ $loop->iteration }})</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->role }}</td>
                            <td>
                                <a href="{{ route('edit.user', $d->id) }}" class="btn btn-primary"><i class="fas fa-pen"></i>Update</a>
                                <a href="{{ route('destroy.user', $d->id) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Hapus</a>
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
@endsection 