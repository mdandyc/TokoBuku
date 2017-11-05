<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;

class BukuController extends Controller
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
        $buku = Buku::paginate(2);
        return view('buku.index',compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buku = Buku::all();
        return view('buku.create',compact('buku'));
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
        'judul' => 'required',
        'isbn' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun' => 'required',
        'stok' => 'required',
        'harga_pokok' => 'required',
        'harga_jual' => 'required',
        'ppn' => 'required',
        'diskon' => 'required',

    ]);
        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->isbn = $request->isbn;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun = $request->tahun;
        $buku->stok = $request->stok;
        $buku->harga_pokok = $request->harga_pokok;
        $buku->harga_jual = $request->harga_jual;
        $buku->ppn = $request->ppn;
        $buku->diskon = $request->diskon;
        
        $buku->save();
        return redirect('buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::find($id);
        return view('buku.view',compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('buku.edit',compact('buku'));
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
        'judul' => 'required',
        'isbn' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun' => 'required',
        'stok' => 'required',
        'harga_pokok' => 'required',
        'harga_jual' => 'required',
        'ppn' => 'required',
        'diskon' => 'required',

    ]);
        $buku = Buku::find($id);
        $buku->judul = $request->judul;
        $buku->isbn = $request->isbn;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun = $request->tahun;
        $buku->stok = $request->stok;
        $buku->harga_pokok = $request->harga_pokok;
        $buku->harga_jual = $request->harga_jual;
        $buku->ppn = $request->ppn;
        $buku->diskon = $request->diskon;
        
        $buku->save();
        return redirect('buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('buku');
    }
    public function search(Request $request)
    {
        $keyword = $request['keyword'];
        // $branch = Branch::where('branchName','LIKE',"%{$keyword}%")->paginate(30);

        // $pasok = Pasok::whereHas('distributor', function($query) use($keyword) {
        // $query->where('nama_distributor', 'LIKE', "%{$keyword}%");
        // })
        // ->orwhereHas('buku', function($query) use($keyword) {
        // $query->where('judul', 'LIKE', "%{$keyword}%");
        // })
        // ->orWhere('jumlah','LIKE',"%{$keyword}%")
        // ->orWhere('tanggal','LIKE',"%{$keyword}%")
        // ->paginate(2);

        $buku = Buku::where('judul','LIKE',"%{$keyword}%")
        ->orWhere('isbn','LIKE',"%{$keyword}%")
        ->orWhere('penulis','LIKE',"%{$keyword}%")
        ->orWhere('penerbit','LIKE',"%{$keyword}%")
        ->orWhere('tahun','LIKE',"%{$keyword}%")
        ->orWhere('stok','LIKE',"%{$keyword}%")
        ->orWhere('harga_pokok','LIKE',"%{$keyword}%")
        ->orWhere('harga_jual','LIKE',"%{$keyword}%")
        ->orWhere('ppn','LIKE',"%{$keyword}%")
        ->orWhere('diskon','LIKE',"%{$keyword}%")
        ->paginate(2);

        return view('buku.index',compact(['buku']));
    }
}
