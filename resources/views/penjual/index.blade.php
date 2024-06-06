@extends('layouts.template')
@section('title')
Users
@endsection

@section('content')

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


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">Data Pemilik Toko</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-overlay">
                            Add Administration Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Email</th>
                            <th>Choices</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        @if ($item->level === 'penjual')
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">Choices</button>
                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{route('penjual.show', $item->id)}}">Details</a>
                                        <form action="{{route('penjual.destroy', $item->id)}}" method="post">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="dropdown-item" type="submit"
                                                onclick="return confirm('hapus data ini?')"">Delete</button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>Nama Customer</th>
                <th>Email</th>
                <th>Choices</th>
              </tr>
              </tfoot>
            </table>
          </div>
       </div>
        </div>
    </div>
    {{-- modal --}}
    <div class=" modal fade" id="modal-overlay">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Large Modal</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{route('penjual.store')}}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Nama Lengkap Penjual</label>
                                                                    <input type="text" name="name" required
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Alamat Email</label>
                                                                    <input type="text" name="email" required
                                                                        class="form-control">
                                                                    <input type="text" name="level" hidden
                                                                        value="penjual">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Kata Sandi</label>
                                                                    <input type="password" name="password" required
                                                                        class="form-control"
                                                                        placeholder="8 characters minimal">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
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
                                    @endsection
