<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class TransaksiController extends Controller
{
    public function index() {
        $data = array(
            'title' => 'Data Transaksi'
        );
        return view('transaksi.index', $data);
    }

    public function show_transaksi(Request $request) {
        if (isset($request->tanggal_start) && $request->tanggal_end != "") {
            $data = DB::table('barang')
            ->select(DB::raw('jenis_barang, max(jumlah_terjual) as jumlah_terbanyak, min(jumlah_terjual) as jumlah_terendah, tanggal_transaksi'))
            ->whereBetween('tanggal_transaksi', [$request->tanggal_start, $request->tanggal_end])
            ->groupByRaw('jenis_barang')
            ->get();
        } else {
            $data = DB::table('barang')
            ->select(DB::raw('jenis_barang, max(jumlah_terjual) as jumlah_terbanyak, min(jumlah_terjual) as jumlah_terendah, tanggal_transaksi'))
            ->groupByRaw('jenis_barang')
            ->get();
        }
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function transaksi_barang() {
        $data = DB::table('barang')
        ->select(DB::raw('jenis_barang, max(jumlah_terjual) as jumlah_terbanyak, min(jumlah_terjual) as jumlah_terendah, tanggal_transaksi'))
        ->groupByRaw('jenis_barang')
        ->get();
        return [
            "status" => true,
            "data" => $data
        ];
    }
}
