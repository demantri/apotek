<script>

    function numberFormat(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $("#tgl_awal, #tgl_akhir").datepicker();

    $("#form-periode").on("submit", function(e) {
        e.preventDefault();

        // $("#content").removeClass('d-none');
        let params = {
            tgl_awal : $("#tgl_awal").val(),
            tgl_akhir : $("#tgl_akhir").val(),
        }

        getData(params);
    });

    function getData(data) {
        $.ajax({
            url: '{{ url('report/laporan-penjualan/list') }}',
            type: 'post',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: data,
            beforeSend: function() {
                @include('processing');
            },
            success: function(response) {
                if (response.length > 0) {

                    swal.close();
                    
                    $("#content").removeClass('d-none');

                    $("#btn-excel").on("click", function() {
                        exportExcel(response);
                    });

                    if ( $.fn.DataTable.isDataTable( '#table' ) ) {
                        $('#table').DataTable().destroy();
                    }
                    
                    let tbody = '';
                    
                    response.forEach(element => {
                        tbody += `
                        <tr>
                            <td>${element.invoice}</td>
                            <td>${element.created_at}</td>
                            <td class="text-right">${numberFormat(element.total_transaksi)}</td>
                            <td class="text-right">${numberFormat(element.ppn)}</td>
                            <td class="text-right">${numberFormat(element.grandtotal)}</td>
                            <td class="text-right">${numberFormat(element.kembalian)}</td>
                        </tr>`;
                    });

                    $("#tbody").html(tbody);

                    $("#table").dataTable({
                        destroy: true,
                        cahce: false,
                        // scrollX: true,
                        lengthMenu: [10, 25, 50, 75, 100],
                    });
                }
            },
            error: function(err) {
                if (err.status == 400) {
                    $("#content").addClass('d-none');

                    swal('', err.responseJSON.message, 'warning');
                }
            }
        });
    }

    function exportExcel(dataArray) {
        $.ajax({
            url: '{{ url('report/laporan-penjualan/excel') }}',
			type: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            xhr: function() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 2) {
                        if (xhr.status == 200) {
                            xhr.responseType = "blob";
                        } else {
                            xhr.responseType = "text";
                        }
                    }
                };
                return xhr;
            },
            data: {
                dataArray
            },
            beforeSend: function() {
                @include('processing')
            },
            success: function(data, status, xhr) {
                // console.log(xhr.getResponseHeader('content-disposition'));
				var fileName = xhr.getResponseHeader('content-disposition').split('filename=')[1].split(';')[0];
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);

                a.href = url;
                a.download = fileName.replace(/\"/g, '');
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);

                swal.close();
			},
			error: function(xhr, stat, err) {
				console.log(err);
				swal.close();
			}
        });
    }
</script>