<div class="modal fade" id="tambah" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="tambahLabel">Tambah Obat</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="modalForm">
                <div class="mb-3">
                    <label for="kode_obat" class="form-label">Kode Obat</label>
                    <input type="text" class="form-control" id="kode_obat" name="kode_obat" placeholder="Masukkan Kode Obat" value="{{$kode}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama_obat" class="form-label">Nama Obat</label>
                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="Masukkan Nama Obat">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jenis Obat</label>
                    <select name="jenis_obat" id="jenis_obat" class="form-control" data-placeholder="Pilih Jenis Obat">
                        <option value=""></option>
                        <option value="1">Tablet</option>
                        <option value="2">Sirup</option>
                        <option value="3">Obat Keras</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Satuan</label>
                    <select name="satuan" id="satuan" class="form-control" data-placeholder="Pilih Satuan">
                        <option value=""></option>
                        <option value="1">Strip</option>
                        <option value="2">Tablet</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stok_obat" class="form-label">Stok Obat</label>
                    <input type="text" class="form-control numeric" id="stok_obat" name="stok_obat" placeholder="Masukkan Nama Obat">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="text" class="form-control money" id="harga_beli" name="harga_beli" placeholder="Masukkan Harga Beli">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="text" class="form-control money" id="harga_jual" name="harga_jual" placeholder="Masukkan Harga Jual">
                        </div>
                    </div>
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
