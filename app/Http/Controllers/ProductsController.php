<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // opsi kalau mau pakai dari model
        // $products = Products::join();

        $products = Products::select('products.*', 'categories.nama as categoryNama')
            ->join('categories', 'products.id_categories', '=', 'categories.id')
            ->get();
        $categories = Categories::select('id', 'nama')->get();

        foreach ($products as $product) {
            $product->category = $categories->find($product->id_categories);
        }
        if (count($products) > 0) {
            $result = [
                'status' => 200,
                'pesan' => 'Data berhasil ditampilkan',
                'products' => $products
            ];
        } else {
            $result = [
                'status' => 500,
                'pesan' => 'Gagal',
                'products' => ''
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
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required|integer',
            'gambar' => 'required',
            'id_categories' => 'required|integer',
        ]);

        $gambar = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move('upload', $gambar);

        $data = [
            'kode' => $request->input('kode'),
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'is_ready' => $request->input('is_ready'),
            'gambar' => url('upload/' . $gambar),
            'id_categories' => $request->input('id_categories'),
        ];

        $products = Products::create($data);

        if ($products) {
            $result = [
                'status' => 200,
                'message' => 'Data berhasil ditambahkan',
                'data' => $products
            ];
        } else {
            $result = [
                'status' => 500,
                'message' => 'Data gagal ditambahkan',
                'data' => ''
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
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}