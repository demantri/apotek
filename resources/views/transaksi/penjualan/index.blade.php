@section('title')
    Masterdata Obat
@endsection

@extends('template.main')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle"><strong>Transaksi</strong> Penjualan Obat</h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <button class="btn btn-primary mb-3" id="btn-tambah">Tambah Data</button> --}}
                    <a href="{{ url('transaksi/penjualan-obat/add') }}" class="btn btn-primary mb-3">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Tgl Transaksi</th>
                                    <th>Total Transaksi</th>
                                    <th>Tipe Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    @include('transaksi.penjualan.script')
@endsection