@section('title')
    Laporan Penjualan
@endsection

@extends('template.main')

<style>
    .d-none {
        display: none;
    }

    .text-right {
        align: left;
    }
</style>

@section('content')
<div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle"><strong>Report</strong> Penjualan Obat</h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="row" id="form-periode">
                        <div class="col-auto">
                            <div class="d-flex">
                                <div class="mb-3" style="margin-right: 1rem">
                                    <label for="" class="form-label">Tgl. Awal</label>
                                    <input type="text" class="form-control" id="tgl_awal" name="tgl_awal" placeholder="Masukkan Tgl. Awal" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Tgl. Akhir</label>
                                    <input type="text" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Masukkan Tgl. Akhir" autocomplete="off">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit"> Filter</button>
                        </div>
                    </form>

                    <div id="content" class="d-none">
                        <hr>
                        <button id="btn-excel" class="btn btn-success mb-3"> Export Excel</button>
                        {{-- <div class="title">
                            <h3>Laporan Penjualan Obat</h3>
                        </div> --}}
                        <table id="table" class="table table-bordered table-hover table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Transaksi</th>
                                    <th class="text-center">Tgl. Transaksi </th>
                                    <th class="text-center">Total Transaksi</th>
                                    <th class="text-center">PPN</th>
                                    <th class="text-center">Grandtotal</th>
                                    <th class="text-center">Kembalian</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    @include('report.laporan_penjualan.script')
@endsection