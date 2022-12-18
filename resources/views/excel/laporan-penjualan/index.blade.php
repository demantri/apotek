<table>
    <thead>
        <tr>
            <td colspan="5" align="left" style="font-weight: bold">{{ $headers['title'] }}</td>
        </tr>
    </thead>
</table>
<br>
<table>
    <thead>
        <tr>
            <th align="center">No</th>
            <th align="center">ID Transaksi</th>
            <th align="center">Tgl. Transaksi </th>
            <th align="center">Total Transaksi</th>
            <th align="center">PPN</th>
            <th align="center">Grandtotal</th>
            <th align="center">Kembalian</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;?>
        @foreach ($data as $row)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row['invoice'] }}</td>
            <td>{{ $row['created_at'] }}</td>
            <td>{{ $row['total_transaksi'] }}</td>
            <td>{{ $row['ppn'] }}</td>
            <td>{{ $row['grandtotal'] }}</td>
            <td>{{ $row['kembalian'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


<table>
    {{-- <tr>
        <td colspan="5">User ID: {{ $footer['user_id'] }}</td>
    </tr> --}}
    <tr>
        <td colspan="5">Tanggal Cetak: {{ $footer['time_export'] }}</td>
    </tr>
</table>