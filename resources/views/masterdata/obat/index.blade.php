@section('title')
    Masterdata Obat
@endsection

@extends('template.main')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle"><strong>Masterdata</strong> Obat</h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary mb-3" id="btn-tambah">Tambah Data</button>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Tgl. Input</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('masterdata.obat.add')
</div>
@endsection
@section('script')
    @include('masterdata.obat.script')
@endsection