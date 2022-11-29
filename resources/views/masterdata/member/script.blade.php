<script>
    $("#table").DataTable({
        destroy: true,
        cahce: false,
        // scrollX: true,
        // order: [['1', 'asc']],
        lengthMenu: [5, 10, 25, 50, 75, 100],
        oLanguage: {
                    sEmptyTable: `<div class="wrappers" style="text-align:center">
                                        <div class="f-12 mt-3">Mohon maaf data tidak di temukan</div> 
                                    </div>`,
                    'sLoadingRecords': `<div class="preloader pl-size-xs" style="text-align:center">
                                        <div class="spinner-layer pl-light-blue">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>`,
                },
        ajax    : {
            url : '{{ url('masterdata/member/list') }}', 
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
            { data : 'kode_member', class: 'nowrap' },
            { data : 'nama_member', class : 'nowrap' },
            { data : 'alamat_lengkap', class : 'nowrap' },
            { data : 'jenis_kelamin', class : 'nowrap' },
            { data : 'no_telp', class : 'nowrap' },
            { data : 'status', class : 'nowrap' },
            { data : 'created_at', class: 'nowrap text-center' },
            { data : 'kode', class: 'nowrap text-center', render: function(data, type, row, meta) {
                return `<button class="btn btn-sm btn-warning" data-id="${row.kode}">Edit</button> <button class="btn btn-sm btn-danger" data-id="${row.kode}">Hapus</button>`;
            }},
        ],
    });

    function proses() {
        let params = {
            kode_member : $("#kode_member").val(),
            nama_member : $("#nama_member").val(),
            alamat : $("#alamat").val(),
            jenis_kelamin : $("#jenis_kelamin").val(),
            no_telp : $("#no_telp").val(),
        }
        // console.log(params)
        $.ajax({
            url: '{{ url('masterdata/member/save') }}',
            type: 'post',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: params,
            success: function(response) {
                swal.close();
                removeForm();
                swal('', response.message, 'success');
                location.reload();

                // swal({
                //     title: "",
                //     text: response.message,
                //     type: "success"
                // }).then(function() {
                //     swal.close();
                //     $('p.text-danger').remove();
                //     $('.form-line.has-error').removeClass('has-error');
                //     // resetForm();
                //     location.reload();
                // });
            },
            error: function(err, status, xhr) {
                swal.close();
                console.log(err);
            } 
        })
        .fail(err => {
            $('p.text-danger').remove();
            $('.form-line.has-error').removeClass('has-error');
            if (err.status == 422) {
                swal.close();

                $.each(err.responseJSON, (key, val) => {
                    console.log(val)
                    let el = $('#' + key);

                    let newVal = `<p class="text-danger" for="${key}" id="${key}-error">${val}</p>`;
                    let newVal2 = `<p class="text-danger" for="${key}" id="${key}-error">${val}</p>`;

                    if (key == 'jenis_kelamin'){
                        el.closest('div.form-line')
                            .removeClass('has-error')
                            .addClass(val.length > 0 ? 'has-error' : '')
                            .find('p.text-danger')
                            .remove();
                        el.parent()
                        .find('.select2-selection--single')
                        .addClass(val.length > 0 ? 'has-error' : '');
                        el.parent()
                        .find('.select2')
                        .after(newVal2);
                    } else {
                        $.each(err.responseJSON, (key, val) => {
                            el.closest('div.form-line')
                                .removeClass('has-error')
                                .addClass(val.length > 0 ? 'has-error' : '')
                                .find('p.text-danger')
                                .remove();
                            el.after(newVal);   
                        });
                    }
                });
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

        $("#jenis_kelamin").select2({
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