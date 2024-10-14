<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Untuk menampilkan banyak data
        return view('landing-page');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Untuk menampilkan form tambah data
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Untuk menyimpan data baru
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Untuk menampilkan hanya satu data
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Untuk menampilkan form edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Untuk mengubah data ke database
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // untuk menghapus data
    }
}
