@extends('layouts.master')

@section('header')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')
    <div class="content-data">

        <div class="card mb-3">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row mb-0">
                        <label for="filter_tanggal" class="col-sm-2 text-sm mb-0">Filter Tanggal</label>
                        <div class="col-sm-4">
                            <input type="date" name="tanggal_start" id="tanggal_start"
                                class="form-control form-control-sm">
                        </div>
                        <span>-</span>
                        <div class="col-sm-4">
                            <input type="date" name="tanggal_end" id="tanggal_end" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-sm btn-primary" id="btn-filter">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title float-left mb-0">{{ $title }}</h5>
                <a href="/" class="btn btn-sm btn-primary float-right">Kembali Ke Data Barang</a>
            </div>
            <div class="card-body">
                <table id="tabel-transaksi" class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>JENIS BARANG</th>
                            <th>JUMLAH TERJUAL TERTINGGI</th>
                            <th>JUMLAH TERJUAL TERENDAH</th>
                            <th>TANGGAL TRANSAKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var table_transaksi;
        $(function() {
            table_transaksi = $('#tabel-transaksi').DataTable({
                processing: true,
                serverSide: true,
                searchable: true,
                ajax: {
                    url: "{{ route('transaksi.show_transaksi') }}",
                    data: function(d) {
                        d.tanggal_start =  $('#tanggal_start').val();
                        d.tanggal_end = $('#tanggal_end').val();
                    }
                },
                columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                }, {
                    data: "jenis_barang"
                }, {
                    data: "jumlah_terbanyak"
                }, {
                    data: "jumlah_terendah"
                }, {
                    data: "tanggal_transaksi"
                }]
            });

            $('#btn-filter').click(function() {
                table_transaksi.draw();
            });
        });
    </script>
@stop
