<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('.money').mask('000,000,000,000,000', {
        reverse: true
    });

    function splitNumber(data) {
        return data.split(',').join('');
    }

    $("#obat").select2();

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

        $("#pelanggan").select2({
            minimumResultsForSearch: -1,
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
                let params = {
                    invoice : $("#invoice").val(),
                    pelanggan : $("#pelanggan").val(),
                    total_transaksi : $("#total_transaksi").val(),
                    total_ppn : $("#total_ppn").val(),
                    grand_total : $("#total_grand").val(),
                    nominal_pembayaran : splitNumber($("#nominal_pembayaran_add").val()),
                    kembalian : splitNumber($("#kembalian_add").val()),
                }
                // console.log(params)
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

    $(document).ready(function() {
        let total_transaksi = $("#total_transaksi").val();
        let total_ppn = $("#total_ppn").val();
        let total_grand = $("#total_grand").val();

        $("#t_trans").text(`Rp. ` + numberWithCommas(total_transaksi));
        $("#ppn").text(`Rp. ` + numberWithCommas(total_ppn));
        $("#grandtot").text(`Rp. ` + numberWithCommas(total_grand));

        $("#grandtotal_add").val(numberWithCommas(total_grand));
    })
</script>