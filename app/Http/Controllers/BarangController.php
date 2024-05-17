<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Barang'
        );
        return view('barang.index', $data);
    }

    public function show_barang(Request $request)
    {
        if (isset($request->tanggal_start) && $request->tanggal_end != "") {
            $data = Barang::whereBetween('tanggal_transaksi', [$request->tanggal_start, $request->tanggal_end])->get();
        } else {
            $data = Barang::all();
        }
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function get_barang($id)
    {
        $data = Barang::find($id);
        return response()->json($data);
    }

    public function action(Request $request)
    {
        if ($request->action == 'simpan') {
            $barang = Barang::create([
                'nama_barang' => $request->nama_barang,
                'stok' => $request->stok,
                'jumlah_terjual' => $request->jumlah_terjual,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'jenis_barang' => $request->jenis_barang
            ]);
            $barang->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Data Barang Berhasil Disimpan'
            ]);
        } else {
            $barang = Barang::find($request->id);
            $barang->update([
                'nama_barang' => $request->nama_barang,
                'stok' => $request->stok,
                'jumlah_terjual' => $request->jumlah_terjual,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'jenis_barang' => $request->jenis_barang
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data Barang Berhasil Di Edit'
            ]);
        }
    }

    public function hapus_barang(Request $request) {
        $barang = Barang::find($request->id);
        $barang->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Barang Berhasil Dihapus'
        ]);
    }

    // INTERFACE API
    public function ambil_barang() {
        $barang = Barang::all();
        return [
            "status" => true,
            "data" => $barang
        ];
    }

    public function store(Request $request) {
        $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'jumlah_terjual' => $request->jumlah_terjual,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'jenis_barang' => $request->jenis_barang
        ]);
        return [
            "status" => 'Data Berhasil Disimpan',
            "data" => $barang
        ];
    }

    public function show($id) {
        $barang = Barang::find($id);
        return [
            "status" => true,
            "data" => $barang
        ];
    }

    public function update(Request $request, $id) {
        $barang = Barang::find($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'jumlah_terjual' => $request->jumlah_terjual,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'jenis_barang' => $request->jenis_barang
        ]);
        return [
            "status" => 'Data Berhasil Di Update',
            "data" => $barang
        ];
    }

    public function delete($id) {
        $barang = Barang::find($id);
        $barang->delete();
        return [
            "status" => 'Data Berhasil Dihapus',
            "data" => $barang
        ];
    }
}
