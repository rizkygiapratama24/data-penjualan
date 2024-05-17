@extends('layouts.master')

@section('header')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('content')
    <div class="content-data">

        <div class="card mb-3">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row mb-0">
                        <label for="filter_tanggal" class="col-sm-2 text-sm mb-0">Filter Tanggal</label>
                        <div class="col-sm-4">
                            <input type="date" name="tanggal_start" id="tanggal_start" class="form-control form-control-sm">
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
                <button type="button" class="btn btn-sm btn-primary float-right" onclick="form_barang('tambah')">Tambah
                    Barang</button>
            </div>
            <div class="card-body">
                <table id="tabel-barang" class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA BARANG</th>
                            <th>STOK</th>
                            <th>JUMLAH TERJUAL</th>
                            <th>TANGGAL TRANSAKSI</th>
                            <th>JENIS BARANG</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal-Barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="form-barang" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nama_barang" class="form-label text-sm">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="nama_barang"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="stok" class="form-label text-sm">Stok</label>
                                    <input type="text" name="stok" id="stok"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="jumlah_terjual" class="form-label text-sm">Jumlah Terjual</label>
                                    <input type="text" name="jumlah_terjual" id="jumlah_terjual"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="tanggal_transaksi" class="form-label text-sm">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="jenis_barang" class="form-label text-sm">Jenis Barang</label>
                                    <select name="jenis_barang" id="jenis_barang" class="form-control form-control-sm">
                                        <option value="">-- PILIH JENIS BARANG --</option>
                                        <option value="Konsumsi">Konsumsi</option>
                                        <option value="Pembersih">Pembersih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" onclick="close_action()">Close</button>
                        <button type="button" class="btn btn-sm btn-primary btn-simpan"
                            onclick="action_barang('simpan')">Simpan</button>
                        <button type="button" class="btn btn-sm btn-primary btn-update d-none"
                            onclick="action_barang('update')">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var table_barang;
        $(function() {
            table_barang = $('#tabel-barang').DataTable({
                processing: true,
                serverSide: true,
                searchable: true,
                ajax: {
                    url: "{{ route('barang.show_barang') }}",
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
                    data: "nama_barang"
                }, {
                    data: "stok"
                }, {
                    data: "jumlah_terjual"
                }, {
                    data: "tanggal_transaksi"
                }, {
                    data: "jenis_barang"
                }, {
                    data: "id",
                    render: function(data) {
                        return `
                            <button type='button' class='btn btn-sm btn-warning' onclick='form_barang("update", ${data})'> Edit </button>
                            <button type='button' class='btn btn-sm btn-danger' onclick='hapus_barang(${data})'> Hapus </button>
                        `;
                    }
                }]
            });

            $('#btn-filter').click(function() {
                table_barang.draw();
            });
        });

        function form_barang(action, id) {
            $('#exampleModal-Barang').modal('show');
            if (action == 'tambah') {
                $('#form-barang')[0].reset();
                $('#id').val("");
                $('.btn-simpan').removeClass('d-none');
                $('.btn-update').addClass('d-none');
                $('.modal-title').html('Tambah Barang');
            } else {
                $('.btn-simpan').addClass('d-none');
                $('.btn-update').removeClass('d-none');
                $('.modal-title').html('Edit Barang');
                get_barang(id);
            }
        }

        function get_barang(id) {
            $.ajax({
                url: '/barang/get_barang/' + id,
                method: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    $('#id').val(id);
                    $('#nama_barang').val(data.nama_barang);
                    $('#stok').val(data.stok);
                    $('#jumlah_terjual').val(data.jumlah_terjual);
                    $('#tanggal_transaksi').val(data.tanggal_transaksi);
                    $('#jenis_barang').val(data.jenis_barang);
                }
            });
        }

        function action_barang(action) {
            var id = $('#id').val();
            var nama_barang = $('#nama_barang').val();
            var stok = $('#stok').val();
            var jumlah_terjual = $('#jumlah_terjual').val();
            var tanggal_transaksi = $('#tanggal_transaksi').val();
            var jenis_barang = $('#jenis_barang').val();
            var token = $('[name="_token"]').val();

            $.ajax({
                url: '{{ route('barang.action') }}',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    "id": id,
                    "nama_barang": nama_barang,
                    "stok": stok,
                    "jumlah_terjual": jumlah_terjual,
                    "tanggal_transaksi": tanggal_transaksi,
                    "jenis_barang": jenis_barang,
                    "action": action,
                    "_token": token
                },
                success: function(data) {
                    if (data.status == 'success') {
                        $('#exampleModal-Barang').modal('hide');
                        $('#form-barang')[0].reset();
                        table_barang.draw();
                        toastr.success(data.message, 'Sukses');
                    }
                }
            })
        }

        function close_action() {
            $('#exampleModal-Barang').modal('hide');
            $('#id').val("");
            $('#form-barang')[0].reset();
        }

        function hapus_barang(id) {
            if (confirm('Yakin Ingin Dihapus ?')) {
                $.ajax({
                    url: "{{ route('barang.hapus_barang') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(data) {
                        if (data.status == "success") {
                            table_barang.draw();
                            toastr.success(data.message, 'Sukses');
                        }
                    }
                })
            }
        }
    </script>
@stop
