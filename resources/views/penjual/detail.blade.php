@extends('layouts.template')

@section('title')
Detail {{$user->name}}
@endsection



@section('content')
{{-- Area Detail Pemilik Toko --}}



<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Detail User</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama User</th>
                            <td width="5%"> : </td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th width="30%">Email</th>
                            <td width="5%"> : </td>
                            <td>{{$user->email}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

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

        {{-- card edit --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('penjual.update',$user->id)}}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label for="">Nama Lengkap Penjual</label>
                        <input type="text" name="name" value="{{$user->name}}" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Email</label>
                        <input type="text" name="email" value="{{$user->email}}" class="form-control">
                        <input type="text" name="level" hidden value="penjual">
                    </div>
                    <div class="form-group">
                        <label for="">Kata Sandi</label>
                        <input type="password" name="password" class="form-control" placeholder="8 characters minimal">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
