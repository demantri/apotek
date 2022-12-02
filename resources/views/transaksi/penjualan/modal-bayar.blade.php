<div class="modal fade" id="modal-bayar" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="tambahLabel">Tambah Obat</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="modalForm">
                <div class="mb-3">
                    <label for="" class="form-label">Invoice</label>
                    <input type="text" class="form-control" id="invoice_add" name="invoice_add" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama_obat" class="form-label">Jenis Pelanggan</label>
                    <select name="pelanggan" id="pelanggan" class="form-control" data-placeholder="Jenis Pelanggan">
                        <option value=""></option>
                        <option value="Guest" selected>Guest</option>
                        <option value="Member">Member</option>
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
