<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::orderBy('Nim', 'desc')->paginate(5);
        
        return view('mahasiswa.index', compact('mahasiswas'));
        with('i', (request()->input('page',1)-1)*5);
    }

    public function search(Request $request)
    {
        
        $mahasiswas = Mahasiswa::where('Nama','Like','%'.$request->input('search').'%')->paginate(5);

        return view('mahasiswa.index', compact('mahasiswas'));
        with('i', (request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim'=>'required',
            'Nama'=>'required',
            'Kelas'=>'required',
            'Jurusan'=>'required',
            'No_Handphone'=>'required',
            'Email'=>'required',
            'Tanggal_Lahir'=>'required',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswa.edit', compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $Nim)
    {
        $request->validate([
            'Nim'=>'required',
            'Nama'=>'required',
            'Kelas'=>'required',
            'Jurusan'=>'required',
            'No_Handphone'=>'required',
            'Email'=>'required',
            'Tanggal_Lahir'=>'required',
        ]);

        // Mahasiswa::where('Nim', $Nim)->update($request);
        // // Mahasiswa::create($request->all());
        Mahasiswa::find($Nim)->update($request->all());

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Nim)
    {
        Mahasiswa::find($Nim)->delete();
        return redirect()
        ->route('mahasiswa.index')
        ->with ('deleted', 'Mahasiswa Berhasil Dihapus');
    }
}
