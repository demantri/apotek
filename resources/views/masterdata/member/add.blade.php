<div class="modal fade" id="tambah" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="tambahLabel">Tambah Member</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="modalForm">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Member</label>
                    <input type="text" class="form-control" id="kode_member" name="kode_member" placeholder="Masukkan Kode Obat" value="{{$kode}}" readonly>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Nama Member</label>
                    <div class="form-line">
                        <input type="text" class="form-control" id="nama_member" name="nama_member" placeholder="Masukkan Nama Obat">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="" class="form-label">Alamat</label>
                    <div class="form-line">
                        <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control" placeholder="Alamat Lengkap"></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Jenis Kelamin</label>
                    <div class="form-line">
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" data-placeholder="Pilih Jenis Kelamin">
                            <option value=""></option>
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">No. Telp</label>
                    <div class="form-line">
                        <input type="text" class="form-control numeric" id="no_telp" name="no_telp" placeholder="Masukkan No. Telp" maxlength="13">
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
