<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Produk</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Coloumn ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Kelola Produk Obat Herbal</h2>
            </div>
            <div class="cardSubHeader">
                <h3>Data Produk</h3>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <td>Nama Produk</td>
                        <td>Gambar</td>
                        <td>Harga</td>
                        <td>Obsi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produks as $produk)
                    <tr>
                        <td>{{ $produk->nama_produk}}</td>
                        <td>
                            <img 
                                src="{{ asset('storage/img/produk/' . $produk->gambar) }}" 
                                alt="{{ $produk->nama_produk }}" 
                                style="width: 50px; height: auto;">
                        </td>
                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="#" class="btn-edit" onclick="loadContent('{{ route('produk.edit', $produk->id_produk) }}')">Edit</a>
                        
                            <!-- Form Hapus -->
                            <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST" class="form-delete" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button id="delete_produk" type="submit" class="btn-delete" onclick="return confirmDeleteProduk(this)">Hapus</button>
                            </form> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> <br>

            <!-- Add Button -->
            <button class="btn-add" onclick="loadContent('tambah_produk')">Tambah Produk</button>
        </div>
    </div>
</body>

</html>