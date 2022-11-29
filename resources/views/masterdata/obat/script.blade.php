<script>
    $("#table").DataTable({
        destroy: true,
        cahce: false,
        lengthMenu: [5, 10, 25, 50, 75, 100],
        ajax    : {
            url : '{{ url('masterdata/obat/list') }}', 
            dataType : 'json', 
            type : 'get' ,
            dataSrc : function(json) {
                console.log(json)
                return json;
            },
            error: function(err) {
                if(err.status == 500) {
                    @include('swal-error')
                }
            }
        },
        columns: [
            {   
                data: 'no', class: 'text-center', render: function (data, type, row, meta) 
                {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data : 'kode', class: 'nowrap' },
            { data : 'nama', class : 'nowrap' },
            { data : 'harga_beli', class : 'nowrap' },
            { data : 'harga_jual', class : 'nowrap' },
            { data : 'stok', class : 'nowrap' },
            { data : 'satuan', class : 'nowrap' },
            { data : 'created_at', class: 'nowrap text-center' },
            { data : 'kode', class: 'nowrap text-center', render: function(data, type, row, meta) {
                return `<button class="btn btn-sm btn-warning" data-id="${row.kode}">Edit</button> <button class="btn btn-sm btn-danger" data-id="${row.kode}">Hapus</button>`;
            }},
        ],
    });

    // $("#tgl_produksi, #tgl_expired").datepicker({
    //     dateFormat: 'yy/mm/dd',
    //     changeMonth: true,
    //     changeYear: true,
    //     setDate: new Date()
    // });

    function proses() {
        let params = {
            kode_obat : $("#kode_obat").val(), 
            nama_obat : $("#nama_obat").val(), 
            jenis_obat : $("#jenis_obat").val(), 
            satuan : $("#satuan").val(), 
            stok_obat : $("#stok_obat").val(), 
            harga_beli : $("#harga_beli").val(), 
            harga_jual : $("#harga_jual").val(), 
        }
        // console.log(params)
        $.ajax({
            url: '{{ url('masterdata/obat/save') }}',
            type: 'post',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: params,
            success: function(response) {
                // console.log(response)
                swal.close();
                swal('', response.message, 'success');
                location.reload();
            },
            error: function(err, status, xhr) {
                swal.close();
                console.log(err);
            } 
        });
    }

    function removeForm() {
        $('p.text-danger').remove();
        $('.form-control.is-invalid').removeClass('is-invalid');
        
        $('label.error').remove();
        $('.form-control.error').removeClass('error');

        $("#modalForm")[0].reset();
    }

    function modalAdd() {
        $("#tambah").modal("show");

        $("#jenis_obat, #satuan").select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('#tambah .modal-content')
        });
    }

    $(document).ready(function() {
        $('.money').mask('000.000.000.000.000', {reverse: true});

        $("#btn-tambah").on("click", function() {
            modalAdd();
            removeForm();
        });

        $("#modalForm").validate({
            rules: {
                barcode: {
                    required: true,
                },
                kode_obat: {
                    required: true,
                },
                nama_obat: {
                    required: true,
                },
                tgl_produksi: {
                    required: true,
                },
                tgl_expired: {
                    required: true,
                },
                jenis_obat: {
                    required: true,
                },
                stok_obat: {
                    required: true,
                },
                harga_beli: {
                    required: true,
                },
                harga_jual: {
                    required: true,
                },
            },
            submitHandler: function(form) {
                // console.log(form)
                proses();
            }
        });

        $("#btn-simpan").on("click", function() {
            swal({
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((confirm) => {
                console.log(confirm)
                if (confirm.value) {
                    proses();
                }
            });
        });
    });
</script>