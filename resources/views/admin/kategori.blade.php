<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kategori</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Coloumn ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Kelola Kategori Obat Herbal</h2>
            </div>
            <div class="cardSubHeader">
                <h3>Data Kategori</h3>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <td>Nama Kategori</td>
                        <td>Gambar</td>
                        <td>Obsi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $kategori)
                        <tr>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td>
                                <img 
                                    src="{{ asset('storage/img/kategori/' . $kategori->gambar) }}" 
                                    alt="{{ $kategori->nama_kategori }}" 
                                    style="width: 50px; height: auto;">
                            </td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="#" class="btn-edit" onclick="loadContent('{{ route('kategori.edit', $kategori->id_kategori) }}')">Edit</a>
                
                                <!-- Form Hapus -->
                                <form action="{{ route('kategori.destroy', $kategori->id_kategori) }}" method="POST" class="form-delete" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete_kategori" type="submit" class="btn-delete" onclick="return confirmDeleteKategori(this)">Hapus</button>
                                </form>                                
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>                
            </table> <br>

            <!-- Add Button -->
            <button class="btn-add" onclick="loadContent('tambah_kategori')">Tambah Kategori</button>
        </div>
    </div>
    
    <!-- Elemen untuk menampilkan pesan sukses -->
    @if (session('success'))
    <div id="success-message" style="color: green; margin-top: 10px;">
        {{ session('success') }}
    </div>
    @endif
</body>

</html>