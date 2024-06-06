@extends('layouts.template')
@section('title')
{{-- digunakan untuk menampilkan halaman sesuai content yang diperlukan --}}
Seller Dashboard
@endsection

@section('content')
@if (Auth::user()->level === 'admin')
<p>Anda adalah admin</p>
@else
{{-- jika profile belum diisi --}}
@if(!$data_profile)
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5> hey, <strong>{{Auth::user()->name}}</strong></h5>
    <p>Anda belum melengkapi profile, silahkan lengkapi profile</p>
    <p>
        <button type="button" class="btn btn-light text-dark" data-toggle="modal" data-target="#modal-profile-xl">
            Update Profile
        </button>
    </p>
</div>

{{-- errors --}}
@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> please fill the data as you should!</h5>
    <ul>
        @foreach ($errors->all() as $item)
        <li>{{$item}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class=" modal fade" id="modal-profile-xl">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Large Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('biodata.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="number" name="no_hp" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" required class="form-control">
                        <input type="text" name="id_user" hidden value="{{Auth::user()->id}}">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <select class="jenis_kelamin" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">FEMALE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">Profile Picture</label>
                        <input type="file" name="pp" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" cols="10" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                        changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@else
{{-- jika sudah melengkapi profile maka akan memunculkan berikut --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>This is your Data, {{Auth::user()->name}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-border-less">
                            @foreach($data_profile as $user)
                            <tr>
                                <th>Nama Lengkap</th>
                                {{-- <td>{{Auth::user()->name}}</td> --}}
                                <td>{{$user->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$user->user->email}}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>{{$user->user->level}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-border-less">
                            @foreach($data_profile as $user)
                            <tr>
                                <th>Nomor Hp</th>
                                {{-- <td>{{Auth::user()->name}}</td> --}}
                                <td>{{$user->no_hp}}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{$user->birth}}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{$user->gender}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif

@endsection
