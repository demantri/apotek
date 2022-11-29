@section('title')
    Masterdata Member
@endsection

@extends('template.main')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle"><strong>Masterdata</strong> Member</h1>
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
                                    <th>Kode Member</th>
                                    <th>Nama Member</th>
                                    <th>Alamat Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No. Telp</th>
                                    <th>Status</th>
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
    @include('masterdata.member.add')
</div>
@endsection
@section('script')
    @include('masterdata.member.script')
@endsection