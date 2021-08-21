<table>
    <thead>
    <tr>
        <th>Barang</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($history as $hs)
        <tr>
            <td>
                @php
                $items = json_decode($hs->keranjang);
                foreach($items as $item)
                    {
                @endphp
                    <p>{{ $item->nama_produk }} x {{ $item->jumlah }}</p>
                @php
                    }
                @endphp
            </td>
            <td>{{ $hs->total }}</td>
            <td>{{ $hs->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
