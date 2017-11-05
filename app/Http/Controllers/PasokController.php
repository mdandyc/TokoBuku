<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasok;
use App\Distributor;
use App\Buku;

class PasokController extends Controller
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
        $pasok = Pasok::paginate(2);
        return view('pasok.index',compact('pasok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pasok = Pasok::all();
        $distributor = Distributor::all();
        $buku = Buku::all();
        return view('pasok.create',compact(['pasok'],['distributor'],['buku']));
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
        'distributor_id' => 'required',
        'buku_id' => 'required',
        'jumlah' => 'required',
        'tanggal' => 'required',

    ]);
        $pasok = new Pasok;
        $pasok->distributor_id = $request->distributor_id;
        $pasok->buku_id = $request->buku_id;
        $pasok->jumlah = $request->jumlah;
        $pasok->tanggal = $request->tanggal;
        
        $pasok->save();
        return redirect('pasok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasok = Pasok::find($id);
        return view('pasok.view',compact('pasok'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasok = Pasok::find($id);
        $distributor = Distributor::all();
        $buku = Buku::all();
        return view('pasok.edit',compact(['pasok'],['distributor'],['buku']));
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
        'distributor_id' => 'required',
        'buku_id' => 'required',
        'jumlah' => 'required',
        'tanggal' => 'required',

    ]);
        $pasok = Pasok::find($id);
        $pasok->distributor_id = $request->distributor_id;
        $pasok->buku_id = $request->buku_id;
        $pasok->jumlah = $request->jumlah;
        $pasok->tanggal = $request->tanggal;
        
        $pasok->save();
        return redirect('pasok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasok = Pasok::find($id);
        $pasok->delete();
        return redirect('pasok');
    }
    public function search(Request $request)
    {
        $keyword = $request['keyword'];
        // $branch = Branch::where('branchName','LIKE',"%{$keyword}%")->paginate(30);

        $pasok = Pasok::whereHas('distributor', function($query) use($keyword) {
        $query->where('nama_distributor', 'LIKE', "%{$keyword}%");
        })
        ->orwhereHas('buku', function($query) use($keyword) {
        $query->where('judul', 'LIKE', "%{$keyword}%");
        })
        ->orWhere('jumlah','LIKE',"%{$keyword}%")
        ->orWhere('tanggal','LIKE',"%{$keyword}%")
        ->paginate(2);

        // $pasok = Kasir::where('nama','LIKE',"%{$keyword}%")
        // ->orWhere('alamat','LIKE',"%{$keyword}%")
        // ->orWhere('telepon','LIKE',"%{$keyword}%")
        // ->orWhere('status','LIKE',"%{$keyword}%")
        // ->paginate(2);

        return view('pasok.index',compact(['pasok']));
    }
}
