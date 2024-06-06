@extends('layouts.template')
@section('title')
Toko
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
                            Add Store Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Kategori</th>
                            <th>Pemilik Toko</th>
                            <th>Deskripsi Toko</th>
                            <th>Hari Buka</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
                            <th>Status Toko</th>
                            <th>Gambar</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($toko as $item)
                        <tr>
                            <td>{{$item->nama_toko}}</td>
                            <td>{{$item->kategori_toko}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{!!$item->desc_toko!!}</td>
                            <td>{{$item->hari_buka}}</td>
                            <td>{{$item->jam_buka}}</td>
                            <td>{{$item->jam_libur}}</td>
                            @if($item->aktif == 1)
                                <td>
                                    <span class="badge badge-success">Aktif</span>
                                </td>
                                @else 
                                <td>
                                    <span class="badge badge-danger">Tidak aktif</span>
                                </td>
                            @endif
                            <td><img width="auto" height="150px" src="{{asset('storage/img/toko/' . $item->icon_toko)}}" alt=""></td>
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">Choices</button>
                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{route('toko.show', $item->id)}}">Details</a>
                                        <form action="{{route('toko.destroy', $item->id)}}" method="post">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="dropdown-item" type="submit"
                                                onclick="return confirm('hapus data ini?')"">Delete</button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>Nama Toko</th>
                <th>Kategori</th>
                <th>Pemilik Toko</th>
                <th>Deskripsi Toko</th>
                <th>Hari Buka</th>
                <th>Jam Buka</th>
                <th>Jam Tutup</th>
                <th>Status Toko</th>
                <th>Gambar</th>
                <th>Pilihan</th>
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
                                                        <form action="{{route('toko.store')}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Nama Toko</label>
                                                                    <input type="text" name="nama_toko" required
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama Pemilik</label>

                                                                    <select name="id_user" class="form-control">
                                                                        @foreach ($user as $item)
                                                                        @if ($item->level == 'penjual')
                                                                        <option>Pilih Nama Pemilik</option>
                                                                        
                                                                          <option value="{{$item->id}}">{{$item->name}}</option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                    
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Deskripsi Toko</label>
                                                                    <textarea name="desc_toko" id="summernote"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Category</label>
                                                                    <select name="kategori_toko" class="form-control">
                                                                        <option value="elektronik">Electronic</option>
                                                                        <option value="otomotif">Otomotif</option>
                                                                        <option value="sembako">Sembako</option>
                                                                        <option value="fashion">Fashion</option>
                                                                        <option value="makanan">Makanan</option>
                                                                        <option value="obat">Obat</option>
                                                                        <option value="aksesoris">Aksesoris</option>
                                                                        <option value="perabotan">Perabotan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="file">Icon</label>
                                                                    <input type="file" name="icon_toko" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Hari Buka : </label>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="senin" value="senin">
                                                                        <label for="senin" class="custom-control-label">Senin</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="selasa" value="selasa">
                                                                        <label for="selasa" class="custom-control-label">Selasa</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="rabu" value="rabu">
                                                                        <label for="rabu" class="custom-control-label">Rabu</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="kamis" value="kamis">
                                                                        <label for="kamis" class="custom-control-label">Kamis</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="jumat" value="jumat">
                                                                        <label for="jumat" class="custom-control-label">Jum'at</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="sabtu" value="sabtu">
                                                                        <label for="sabtu" class="custom-control-label">Sabtu</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="ahad" value="ahad">
                                                                        <label for="ahad" class="custom-control-label">Ahad</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-around">
                                                                    <div class="form-group col-md-6">
                                                                        <label>Jam Buka</label>
                                                                        <input type="time" class="form-control" name="jam_buka">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Jam Tutup</label>
                                                                        <input type="time" class="form-control" name="jam_libur">
                                                                    </div>                                                              
                                                                </div>
                                                                <div class="form-group">
                                                                    <select name="aktif" class="form-control">
                                                                        <option value="0">Non-Aktif</option>
                                                                        <option value="1">Aktif</option>
                                                                    </select>
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
