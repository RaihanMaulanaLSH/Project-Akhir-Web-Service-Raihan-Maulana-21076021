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

          

          <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Masukkan User Baru</h4>
                  <p class="card-description">
                    buat user baru
                  </p>
                  <form class="forms-sample" action="{{ route('modify.user', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="exampleInputName1">Nama</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputName1" placeholder="EnterName" value="{{ $data->name }}">
                        @error('nama')
                            <small>{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="{{ $data->email }}">
                        @error('email')
                            <small>{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                        @error('password')
                            <small>{{$message}}</small>
                        @enderror
                    </div>
                    <input type="hidden" name="role" value="{{ $data->role }}">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('user.index') }}" class="btn btn-light">Cancel</a>
                </form>
                
                </div>
              </div>
            </div>
        
           

            <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
        <!-- partial -->
      </div>
@endsection 