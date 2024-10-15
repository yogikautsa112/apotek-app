<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Request $request mengambil data dari form yang dikirim ke action terhubung dengan func ini
    public function index(Request $request)
    {
        // mengambil data medicines
        // mengambil semua data : NamaModel::all()
        // NamaModel sesuaikan dengan data apa yang mau dimunculkan
        // simplePaginate : membuat pagination dengan jumlah data 5 perhalaman
        // where('namaa_fild_migration', 'operator', 'value')
        // operator -> =, <, >, <=, >=, <>, LIKE
        $medicines = Medicine::where('name', 'LIKE', '%' . $request->search . "%")->orderBy("name", "ASC")->simplePaginate(5);
        // compact('medicines') berfungsi untuk mengirim data ke view
        return view('medicines.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('medicines.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'type' => 'required',
            'name' => 'required|min:5|max:15',
            'price' => 'required',
            'stock' => 'required'
        ], [
            'type.required' => 'Jenis obat harus diisi',
            'name.required' => 'Nama obat harus diisi',
            'name.min' => 'Nama obat minimal 5 karakter',
            'name.max' => 'Nama obat maksimal 15 karakter',
            'price.required' => 'Harga obat harus diisi',
            'stock.required' => 'Stok obat harus diisi',
        ]);

        $proses = Medicine::create([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if ($proses) {
            return redirect()->route('medicines')->with('success', 'Data obat berhasil disimpan!');
        } else {
            return redirect()->route('medicines.add')->with('failed', 'Data obat gagal disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // ambil data yang mau di edit sesuai dengan id {id}
        // where() : mencari berdasarkan id
        // first() : mengambil data pertama
        $medicine = Medicine::where('id', $id)->first();
        return view('medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'type' => 'required',   
            'name' => 'required|min:5|max:15',
            'price' => 'required',
            'stock' => 'required'
        ], [
            'type.required' => 'Jenis obat harus diisi',
            'name.required' => 'Nama obat harus diisi',
            'name.min' => 'Nama obat minimal 5 karakter',
            'name.max' => 'Nama obat maksimal 15 karakter',
            'price.required' => 'Harga obat harus diisi',
            'stock.required' => 'Stok obat harus diisi',
        ]);

        $medicineBefore = Medicine::where('id', $request->id)->first();
        if ((int)$request->stock < (int)$medicineBefore->stock) {
            return redirect()->back()->with('failed', 'Stok baru tidak boleh kurang dari stok yang sudah ada!');
        }

        $proses = $medicineBefore->update([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        if ($proses) {
            return redirect()->route('medicines')->with('success', 'Data obat berhasil diubah!');
        } else {
            return redirect()->route('medicines.edit', $request->id)->with('failed', 'Data obat gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $proces = Medicine::where('id', $id)->delete();
        if ($proces) {
            return redirect()->route('medicines')->with('success', 'Data obat berhasil dihapus!');
        } else {
            return redirect()->route('medicines')->with('failed', 'Data obat gagal dihapus!');
        }
    }

    public function stockEdit(Request $request, $id) {
        $medicine = Medicine::findOrFail($id);
        $medicine->stock = $request->input('stock');
        $medicine->save();

        return response()->json(['success' => 'Stok berhasil diupdate']);
    }
}