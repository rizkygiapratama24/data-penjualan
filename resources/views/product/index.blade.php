@extends('layouts.master')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@stop

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <button type="button" class="btn btn-sm btn-primary float-right" onclick="form_product('tambah')">
                        <i class="fas fa-plus"></i>
                        Tambah Product
                    </button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-body">
                    <table id="tabel-product" class="table table-sm table-bordered w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>AKSI</th>
                                <th>KODE PRODUK</th>
                                <th>NAMA PRODUK</th>
                                <th>HARGA PRODUK</th>
                                <th>SPESIFIKASI PRODUK</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        var table_produk;
        $(function() {
            table_produk = $('#tabel-produk').DataTable({
                processing: true,
                serverSide: true,
                searchable: true,
                ajax: {
                    url: "{{ route('product.show_product') }}"
                },
                columns: [
                    
                ]
            })
        });
    </script>
@stop
