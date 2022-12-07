@section('title')
    Masterdata Obat
@endsection

@extends('template.main')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle"><strong>Transaksi</strong> Penjualan Obat</h1>
    </div>

    <div class="mb-3">
        <a href="{{ url('transaksi/penjualan-obat') }}" class="btn btn-outline-dark"> Kembali</a>
    </div>

    <div class="row">
        <div class="col-5 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4>Form Penjualan</h4>
                </div>
                <div class="card-body">
                    <form id="form-add">
                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Invoice</label>
                            <div class="col-sm-8 form-line">
                              <input type="text" class="form-control" name="invoice" id="invoice" value="{{$kode}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Tgl Transaksi</label>
                            <div class="col-sm-8 form-line">
                              <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Kode Obat <span style="color:rgba(255, 0, 0, 0.616)">*</span></label>
                            <div class="col-sm-8 form-line">
                                <input type="text" class="form-control" id="obat" name="obat" placeholder="Input Kode Produk ..." onkeyup="upperCase('obat')">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Nama Obat</label>
                            <div class="col-sm-8 form-line">
                                <input type="text" class="form-control" id="nama_obat" name="nama_obat" readonly>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Obat</label>
                            <div class="col-sm-8 form-line">
                              <select name="obat" id="obat" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($obat as $item)
                                <option value="{{$item->kode}}">{{$item->kode .' - '. $item->nama}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div> --}}
                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-8 form-line">
                              <input type="number" class="form-control numeric" name="jumlah" id="jumlah" value="1" min="1">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                              <button class="btn btn-primary" id="btn-tambah" type="submit">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-7 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Penjualan</h4>
                </div>
                <div class="card-body">
                    <form id="form-detail">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                                <?php
                                $total_transaksi = 0; 
                                $no = 1; 
                                ?>
                                @foreach ($detail as $item)

                                <?php 
                                $total_transaksi += $item->subtotal;
                                ?>
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->kode_obat .' - '. $item->nama_obat}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td align="right">{{'Rp. '. number_format($item->harga_satuan)}}</td>
                                    <td align="right">{{'Rp. '. number_format($item->subtotal)}}</td>
                                </tr>
                                @endforeach

                                <input type="hidden" value="{{$total_transaksi}}" id="total_transaksi">
                                <input type="hidden" value="{{$total_transaksi * (2/100)}}" id="total_ppn">
                                <input type="hidden" value="{{$total_transaksi + ($total_transaksi * (2/100))}}" id="total_grand">
                            </table>
                        </div>
                        <div class="info-total">
                            <table class="table  table-sm table-borderless">
                                <tr>
                                    <td style="width: 150px"><strong>Total Transaksi</strong></td>
                                    <td style="width: 10px">:</td>
                                    <td><span id="t_trans"></span></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px"><strong>PPN (2%)</strong></td>
                                    <td style="width: 10px">:</td>
                                    <td><span id="ppn"></span></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px"><strong>Grandtotal</strong></td>
                                    <td style="width: 10px">:</td>
                                    <td><span id="grandtot"></span></td>
                                </tr>
                            </table>
                        </div>
                        @if (count($detail) > 0)
                        <hr>
                        <div class="button">
                            <button type="button" id="simpan_cetak" class="btn btn-outline-primary">Simpan & Cetak</button>
                            <button type="button" id="bayar" class="btn btn-outline-success">Bayar</button>
                            <button type="button" id="pending" class="btn btn-outline-warning" onclick="proses('pending')">Pending</button>
                            <button type="button" id="batalkan" class="btn btn-outline-danger" onclick="proses('batal')">Batalkan</button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('transaksi.penjualan.modal-bayar')
</div>
@endsection
@section('script')
    @include('transaksi.penjualan.script')
    <script>
        $("#sidebar").addClass('collapsed');
    </script>
@endsection