<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $validasi = Validator::make($data, [
            'nomor_hp' => 'required|min:10',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'pp' => 'required|mimes:png,jpg,jpeg,heic',
            'alamat' => 'required'
        ]);

        if($request->hasFile('pp'))
        {
            $folder = 'public/images/profile'; //arah dan folder penyimpanan
            $gambar = $request->file('pp'); //mengambil data dari request foto_profile
            $nama_gambar = $gambar->getClientOriginalName(); //mengambil nama asli dari file
            $path = $request->file('pp')->storeAs($folder, $nama_gambar); //mengirim gambar ke folder
            $data['pp'] = $nama_gambar; //memberikan nama yang dikirim ke database
        }

        // if ($validasi->fails()) 
        // {
        //     return back()->withErrors($validasi)->withInput();
        // }

        // User::create($input)->with('$success', "Data Successfully Added");
        Profile::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
