<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjang = Keranjang::select('keranjangs.jumlah', 'keranjangs.total_harga', 'keranjangs.id', 'keranjangs.id_products', 'keranjangs.id_categories')
            ->join('products', 'keranjangs.id_products', '=', 'products.id')
            ->join('categories', 'products.id_categories', '=', 'categories.id')
            ->get();

        $categories = Categories::select('id', 'nama')->get();
        $products = Products::select('id', 'kode', 'nama', 'harga', 'is_ready', 'gambar')->get();

        foreach ($keranjang as $keranjangs) {
            $keranjangs->product = $products->find($keranjangs->id_products);
            $keranjangs->category = $categories->find($keranjangs->id_categories);
        }

        if (count($keranjang) > 0) {
            $result = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan',
                'keranjang' => $keranjang
            ];
        } else {
            $result = [
                'status' => 500,
                'pesan' => 'Gagal',
                'keranjang' => []
            ];
        }
        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'jumlah' => 'required|integer',
            'total_harga' => 'required|integer',
            'id_categories' => 'required|integer',
            'id_products' => 'required|integer',
        ]);

        $data = [
            'jumlah' => $request->input('jumlah'),
            'total_harga' => $request->input('total_harga'),
            'id_categories' => $request->input('id_categories'),
            'id_products' => $request->input('id_products'),
        ];

        $keranjang = Keranjang::create($data);

        if ($keranjang) {
            $result = [
                'status' => 200,
                'pesan' => 'Data berhasil ditambahkan',
                'keranjang' => $keranjang
            ];
        } else {
            $result = [
                'status' => 500,
                'pesan' => 'Gagal',
                'keranjang' => ''
            ];
        }
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Keranjang::find($id);
        if ($data) {
            $result = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan',
                'keranjang' => $data
            ];
        } else {
            $result = [
                'status' => 500,
                'pesan' => 'Gagal',
                'keranjang' => ''
            ];
        }
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keranjang $keranjang)
    {
        //
    }
}