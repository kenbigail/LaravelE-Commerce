@extends('layouts.template')

@section('title')
Detail {{$data->nama_toko}}
@endsection



@section('content')
{{-- Area Detail Pemilik Toko --}}



<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Detail Toko</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama Pemilik</th>
                            <td width="5%"> : </td>
                            <td>{{$data->user->name}}</td>
                        </tr>
                        <tr>
                            <th width="30%">Kategori Toko</th>
                            <td width="5%"> : </td>
                            <td>{{$data->kategori_toko}}</td>
                        </tr>
                        <tr>
                            <th width="30%">Deskripsi Toko</th>
                            <td width="5%"> : </td>
                            <td>{!!$data->desc_toko!!}</td>
                        </tr>
                        <tr>
                            <th width="30%">Hari Buka</th>
                            <td width="5%"> : </td>
                            <td>{{$data->hari_buka}}</td>
                        </tr>
                        <tr>
                            <th width="30%">Jam Buka</th>
                            <td width="5%"> : </td>
                            <td>{{$data->jam_buka}}</td>
                        </tr>
                        <tr>
                            <th width="30%">Jam Tutup</th>
                            <td width="5%"> : </td>
                            <td>{{$data->jam_libur}}</td>
                        </tr>
                        <tr>
                            <th width="30%">Status Toko</th>
                            <td width="5%"> : </td>
                            @if($data->aktif == 1)
                                <td>
                                    <span class="badge badge-success">Aktif</span>
                                </td>
                                @else 
                                <td>
                                    <span class="badge badge-danger">Tidak aktif</span>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th width="30%">Icon Toko</th>
                            <td width="5%"> : </td>
                            <td colspan="3" class="text-center m-3">
                                <img width="300px" src="{{asset('storage/img/toko/' . $data->icon_toko)}}" alt="">
                            </td>
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
                <form action="{{route('toko.update',$data->id)}}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                    {{-- <div class="form-group">
                        <label for="">Nama Penjual</label>
                        <select name="id_user" class="form-control">
                            @foreach ($user as $item)
                            @if ($item->level == 'penjual')
                            <option>Pilih Nama Pemilik</option>
                              <option value="{{$data->id}}">{{$data->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_toko" value="{{$data->nama_toko}}" required
                        class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kategori Toko</label>
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
                        <label>Deskripsi Toko</label>
                        <textarea value="{!!$data->desc_toko!!}" name="desc_toko" id="summernote"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Icon</label>
                        <input type="file" name="icon_toko" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Hari Buka : </label>
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection