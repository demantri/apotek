<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
    function upperCase(key) {
		let value = $('#' + key).val();
		$('#' + key).val(value.toUpperCase());
	}

    $('.money').mask('000,000,000,000,000', {
        reverse: true
    });

    function splitNumber(data) {
        return data.split(',').join('');
    }

    // $("#obat").select2();

    $("#obat").on("input", function() {
        let value = $(this).val();

        $.ajax({
            url: '{{ url('transaksi/penjualan-obat/findBarang') }}',
            type: 'post',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: {
                kode_obat : value
            }, 
            success: function(response) {
                if(!Object.keys(response).length){
                    $("#nama_obat").val('');
                } else {
                    $("#nama_obat").val(response.nama)
                }
            }
        })
    })

    $("#form-add").on("submit", function(e) {
        e.preventDefault();

        let params = {
            invoice : $("#invoice").val(),
            tgl_transaksi : $("#tgl_transaksi").val(),
            obat : $("#obat").val(),
            qty : $("#jumlah").val(),
        }

        $.ajax({
            url: '{{ url('transaksi/penjualan-obat/add-detail') }}',
            type: 'post',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: params,
            success: function(response) {

                swal('', response.message, 'success');

                location.reload();
            }
        })
    });

    function proses(status) {
        let invoice = $("#invoice").val();
        if (status == 'pending') {
            swal({
                text: "Apakah anda yakin ingin pending transaksi?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b7ddd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((confirm) => {
                if (confirm.value) {
                    alert('proses pending   ')
                }
            }); 
        } else if (status == 'batal') {
            swal({
                text: "Apakah anda yakin ingin membatalkan transaksi?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b7ddd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((confirm) => {
                if (confirm.value) {
                    alert('proses batal')
                }
            }); 
        }
    }

    $("#bayar").on("click", function() {
        modalBayar();
    });

    function modalBayar() {
        $("#modal-bayar").modal('show');
        $("#invoice_add").val($("#invoice").val());
        $("#ppn_add").val($("#total_ppn").val());
        $("#total_transaksi_add").val($("#total_transaksi").val());

        $("#pelanggan, #jenis_pembayaran").select2({
            minimumResultsForSearch: -1,
            dropdownParent: $("#modal-bayar")
        });

        $("#member").select2({
            placeholder: 'Pilih Member',
            dropdownParent: $("#modal-bayar")
        });

        $("#btn-simpan").prop("disabled", true);
    }

    $(document).on("input", ".money", function() {
        let nominal_pembayaran = splitNumber($("#nominal_pembayaran_add").val());
        // let grandtotal = 
        let kembalian = parseInt(nominal_pembayaran) - parseInt(splitNumber($("#grandtotal_add").val()));
        $("#kembalian_add").val(numberWithCommas(kembalian));

        if (kembalian >= 0) {
            $("#btn-simpan").prop("disabled", false);
        } else {
            $("#btn-simpan").prop("disabled", true);
        }
    });

    $("#btn-simpan").on("click", function() {
        swal({
            text: "Apakah anda yakin?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3b7ddd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((confirm) => {
            if (confirm.value) {
                let params = $("#modalForm").serialize();
                $.ajax({
                    url: '{{ url('transaksi/penjualan-obat/simpan-bayar') }}',
                    type: 'post',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    data: params,
                    success: function(response) {

                        swal('', response.message, 'success');

                        location.reload();
                    }
                });
            }
        }); 
    });

    $("#pelanggan").on("change", function() {
        let jenis_pelanggan = $("#pelanggan").val();

        if (jenis_pelanggan == 'Member') {
            $("#list-member").removeClass('d-none');

            getMember();
        } else {
            $("#list-member").addClass('d-none');
        }
    });

    function getMember() {
        $.ajax({
            url: '{{ url('transaksi/penjualan-obat/getMember') }}',
            type: 'get',
            success: function(response) {
                console.log(response)
                let option = '<option value=""></option>';

                response.forEach(element => {
                    option += `<option value="${element.kode_member}">${element.kode_member +' - '+ element.nama_member}</option>`;    
                });

                $("#member").html(option);
            }
        });
    }

    function getData() {
        $("#table").DataTable({
            destroy: true,
            cahce: false,
            lengthMenu: [5, 10, 25, 50, 75, 100],
            ajax    : {
                url : '{{ url('transaksi/penjualan-obat/list') }}', 
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
                { data : 'invoice', class: 'nowrap' },
                { data : 'tgl_transaksi', class : 'nowrap' },
                { data : 'total_transaksi', class : 'nowrap text-right', render: function(data, type, row, meta) {
                    return `Rp. ` + numberWithCommas(row.total_transaksi)
                }},
                { data : 'pelanggan', class : 'nowrap' },
                { data : 'status', class : 'nowrap text-center', render: function(data, type, row, meta) {
                    return (row.status == 1) ? '<span class="badge bg-success">Terbayar</span>' : (row.status == 3) ? '<span class="badge bg-warning">Pending</span>' : (row.status == 4) ? '<span class="badge bg-danger">Pembayaran Gagal</span>' : '';
                }},
                { data : 'invoice', class: 'nowrap text-center', render: function(data, type, row, meta) {
                    return `<button class="btn btn-sm btn-info" data-id="${row.invoice}"> Detail Penjualan Obat</button>`;
                }},
            ],
        });
    }

    $(document).ready(function() {
        getData();

        let total_transaksi = $("#total_transaksi").val();
        let total_ppn = $("#total_ppn").val();
        let total_grand = $("#total_grand").val();

        $("#t_trans").text(`Rp. ` + numberWithCommas(total_transaksi));
        $("#ppn").text(`Rp. ` + numberWithCommas(total_ppn));
        $("#grandtot").text(`Rp. ` + numberWithCommas(total_grand));

        $("#grandtotal_add").val(numberWithCommas(total_grand));
    })
</script>