<div class="modal fade" id="modal-bayar" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="tambahLabel">Tambah Obat</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="modalForm">
                {{-- testing untuk deploy cpanel --}}

                <input type="hidden" id="ppn_add" name="ppn_add">
                <input type="hidden" id="total_transaksi_add" name="total_transaksi_add">

                <div class="mb-3">
                    <label for="" class="form-label">Invoice</label>
                    <input type="text" class="form-control" id="invoice_add" name="invoice_add" readonly>
                </div>
                @foreach ($detail as $item)
                <input type="hidden" value="{{$item->kode_obat}}" id="kode_obat" class="kode_obat" name="kode_obat[]">
                <input type="hidden" value="{{$item->qty}}" id="qty" class="qty" name="qty[]">
                @endforeach
                <div class="mb-3">
                    <label for="" class="form-label">Jenis Pelanggan</label>
                    <select name="pelanggan" id="pelanggan" class="form-control" data-placeholder="Jenis Pelanggan">
                        <option value=""></option>
                        <option value="Guest" selected>Guest</option>
                        <option value="Member">Member</option>
                    </select>
                </div>
                <div class="mb-3 d-none" id="list-member">
                    <label for="" class="form-label">List Member</label>
                    <select name="member" id="member" class="form-control">
                        
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jenis Pembayaran</label>
                    <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control" data-placeholder="Jenis Pembayaran">
                        <option value=""></option>
                        <option value="Cash" selected>Cash</option>
                        <option value="Kredit">Kredit</option>
                    </select>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="" class="form-label">Nominal Pembayaran</label>
                    <input type="text" style="text-align:right;" class="form-control money" id="nominal_pembayaran_add" name="nominal_pembayaran_add">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Grandtotal</label>
                    <input type="text" style="text-align:right;" class="form-control" id="grandtotal_add" name="grandtotal_add" readonly>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kembalian</label>
                    <input type="text" style="text-align:right;" class="form-control" id="kembalian_add" name="kembalian_add" value="0" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" id="btn-simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
