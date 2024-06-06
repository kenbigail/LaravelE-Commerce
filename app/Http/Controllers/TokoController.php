<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TokoController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toko = Toko::all();
        $user = User::all();
        return view ('toko.index', compact('toko', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validasi = Validator::make($input, [
            'nama_toko' => 'required|min:5|max:128|string',
            'desc_toko' => 'required',
            'kategori_toko' => 'required',
            'icon_toko' => 'required|mimes:png,jpg,jpeg,heic',
            'hari_buka' => 'required',
            'jam_buka' => 'required',
            'jam_libur' => 'required'
        ]);

        if ($validasi->fails()) 
        {
            return back()->withErrors($validasi)->withInput();
        }

        if($request->hasFile('icon_toko'))
        {
            $folder = 'public/img/toko';
            $gambar = $request->file('icon_toko');
            $nama_gambar = $gambar->getClientOriginalName();
            $path = $request->file('icon_toko')->storeAs($folder, $nama_gambar);
            $input['icon_toko'] = $nama_gambar;
        }

        // konversi nilai array ke dalam string
        $hari = implode(',', $request->input('hari_buka'));
        $input['hari_buka'] = $hari;
        
        Toko::create($input);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Toko::find($id);
        return view('toko.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $update = $request->all();
        $toko = Toko::find($id);
        $validasi = Validator::make($update, [
            'nama_toko' => 'min:5|max:128|string',
            'desc_toko' => 'required',
            'kategori_toko' => 'required',
            'hari_buka' => 'required',
            'jam_buka' => 'required',
            'jam_libur' => 'required'
        ]);

        if ($validasi->fails()) 
        {
            return back()->withErrors($validasi)->withInput();
        }
        if($request->hasFile('icon_toko'))
        {
            $folder = 'public/img/toko';
            $gambar = $request->file('icon_toko');
            $nama_gambar = $gambar->getClientOriginalName();
            $path = $request->file('icon_toko')->storeAs($folder, $nama_gambar);
            $input['icon_toko'] = $nama_gambar;
        }

        // konversi nilai array ke dalam string
        $hari = implode(',', $request->input('hari_buka'));
        $update['hari_buka'] = $hari;

        $toko->update($update);
        return redirect('/toko');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Toko::find($id);
        $data->delete();
        return back();
    }
}
