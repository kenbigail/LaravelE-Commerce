<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class UserController extends Controller
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
        $users = User::all();
        return view ('penjual.index', compact('users'));
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
            'name' => 'required|max:120|string',
            'level' => 'required',
            'email' => 'required|email|max:50',
            'password' => 'required|min:8|max:30'
        ]);

        if ($validasi->fails()) 
        {
            return back()->withErrors($validasi)->withInput();
        }

        User::create($input)->with('$success', "Data Successfully Added");
        return back();
        // if($request->input('password'))
        // {
        //     $input['password'] = $input['password'];
        // }
        // User::create($input);
        // return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('penjual.detail', compact('user'));
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
        $data = $request->all();
        $user = User::find($id);
        $validasi = Validator::make($data, [
            'name' => 'required|max:120|string',
            'level' => 'required',
            'email' => 'required|email|max:50|string',
            'password' => 'min:8|max:30'
        ]);

        if ($validasi->fails()) 
        {
            return back()->withErrors($validasi)->withInput();
        }
        if ($request->input('password'))
        {
            $data['password'] = $data['password'];
        }
        else
        {
            $data = Arr::except($data, [$password]);
        }
        $user->update($data);
        return redirect('/penjual');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return back();
    }
}

