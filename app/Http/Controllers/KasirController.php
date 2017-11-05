<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kasir;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $kasir = Kasir::paginate(2);
        return view('kasir.index',compact('kasir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kasir = Kasir::all();
        return view('kasir.create',compact('kasir'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'nama' => 'required',
        'alamat' => 'required',
        'telepon' => 'required',
        'status' => 'required',

    ]);
        $kasir = new Kasir;
        $kasir->nama = $request->nama;
        $kasir->alamat = $request->alamat;
        $kasir->telepon = $request->telepon;
        $kasir->status = $request->status;
        
        $kasir->save();
        return redirect('kasir');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kasir = Kasir::find($id);
        return view('kasir.view',compact('kasir'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kasir = Kasir::find($id);
        return view('kasir.edit',compact('kasir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'nama' => 'required',
        'alamat' => 'required',
        'telepon' => 'required',
        'status' => 'required',

    ]);
        $kasir = Kasir::find($id);
        $kasir->nama = $request->nama;
        $kasir->alamat = $request->alamat;
        $kasir->telepon = $request->telepon;
        $kasir->status = $request->status;
        
        $kasir->save();
        return redirect('kasir');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kasir = Kasir::find($id);
        $kasir->delete();

        return redirect('kasir');
    }
    public function search(Request $request)
    {
        $keyword = $request['keyword'];
        // $branch = Branch::where('branchName','LIKE',"%{$keyword}%")->paginate(30);

        // $dokter = Dokter::whereHas('poliklinik', function($query) use($keyword) {
        // $query->where('namaplk', 'LIKE', "%{$keyword}%");
        // })->orWhere('kodedkt','LIKE',"%{$keyword}%")->orWhere('namadkt','LIKE',"%{$keyword}%")->orWhere('alamatdkt','LIKE',"%{$keyword}%")->orWhere('spesialis','LIKE',"%{$keyword}%")->paginate(2);

        $kasir = Kasir::where('nama','LIKE',"%{$keyword}%")
        ->orWhere('alamat','LIKE',"%{$keyword}%")
        ->orWhere('telepon','LIKE',"%{$keyword}%")
        ->orWhere('status','LIKE',"%{$keyword}%")
        ->paginate(2);

        return view('kasir.index',compact(['kasir']));
    }

}
