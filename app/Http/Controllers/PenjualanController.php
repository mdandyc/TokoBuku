<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Buku;
use App\Kasir;

class PenjualanController extends Controller
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
        $penjualan = Penjualan::paginate(2);
        return view('penjualan.index',compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjualan = Penjualan::all();
        $buku = Buku::all();
        $kasir = Kasir::all();
        return view('penjualan.create',compact('penjualan','buku','kasir'));
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
        'buku_id' => 'required',
        'kasir_id' => 'required',
        'jumlah' => 'required',
        'total' => 'required',
        'tanggal' => 'required',

    ]);
        $penjualan = new Penjualan;
        $penjualan->buku_id = $request->buku_id;
        $penjualan->kasir_id = $request->kasir_id;
        $penjualan->jumlah = $request->jumlah;
        $penjualan->total = $request->total;
        $penjualan->tanggal = $request->tanggal;
        
        $penjualan->save();
        return redirect('penjualan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penjualan = Penjualan::find($id);
        return view('penjualan.view',compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penjualan = Penjualan::find($id);
        $buku = Buku::all();
        $kasir = Kasir::all();
        return view('penjualan.edit',compact('penjualan','buku','kasir'));
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
        'buku_id' => 'required',
        'kasir_id' => 'required',
        'jumlah' => 'required',
        'total' => 'required',
        'tanggal' => 'required',

    ]);
        $penjualan = Penjualan::find($id);
        $penjualan->buku_id = $request->buku_id;
        $penjualan->kasir_id = $request->kasir_id;
        $penjualan->jumlah = $request->jumlah;
        $penjualan->total = $request->total;
        $penjualan->tanggal = $request->tanggal;
        
        $penjualan->save();
        return redirect('penjualan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);
        $penjualan->delete();
        return redirect('penjualan');

    }
    public function search(Request $request)
    {
        $keyword = $request['keyword'];
        // $branch = Branch::where('branchName','LIKE',"%{$keyword}%")->paginate(30);

        $penjualan = Penjualan::whereHas('buku', function($query) use($keyword) {
        $query->where('judul', 'LIKE', "%{$keyword}%");
        })
        ->orwhereHas('kasir', function($query) use($keyword) {
        $query->where('nama', 'LIKE', "%{$keyword}%");
        })
        ->orWhere('jumlah','LIKE',"%{$keyword}%")
        ->orWhere('total','LIKE',"%{$keyword}%")
        ->orWhere('tanggal','LIKE',"%{$keyword}%")
        ->paginate(2);

        // $buku = Buku::where('judul','LIKE',"%{$keyword}%")
        // ->orWhere('isbn','LIKE',"%{$keyword}%")
        // ->orWhere('penulis','LIKE',"%{$keyword}%")
        // ->orWhere('penerbit','LIKE',"%{$keyword}%")
        // ->orWhere('tahun','LIKE',"%{$keyword}%")
        // ->orWhere('stok','LIKE',"%{$keyword}%")
        // ->orWhere('harga_pokok','LIKE',"%{$keyword}%")
        // ->orWhere('harga_jual','LIKE',"%{$keyword}%")
        // ->orWhere('ppn','LIKE',"%{$keyword}%")
        // ->orWhere('diskon','LIKE',"%{$keyword}%")
        // ->paginate(2);

        return view('penjualan.index',compact(['penjualan']));
    }
}
