<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Edit Kategori</h2>
            </div>

            <form id="formEditKat" class="formEditKat" action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input Nama Kategori -->
                <div class="form-group">
                    <label for="nama-kategori">Nama Kategori</label>
                    <input 
                        type="text" 
                        id="nama-kategori" 
                        name="nama_kategori" 
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                        required>
                </div><br>

                <!-- Tampilkan Gambar Lama -->
                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    @if ($kategori->gambar)
                        <img 
                            src="{{ asset('storage/img/kategori/' . $kategori->gambar) }}" 
                            alt="{{ $kategori->nama_kategori }}" 
                            style="width: 150px; height: auto;">
                    @else
                        <p>Tidak ada gambar</p>
                    @endif
                </div><br>

                <!-- Pilih Gambar Baru -->
                <div class="form-group">
                    <label for="gambar">Pilih File Baru</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*">
                </div><br>

                <button class="btn-add-back" type="button" onclick="loadContent('kategori')">Kembali</button>
                <!-- Tombol Aksi -->
                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupFormEditKategoriListener(this)">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>
</body>

</html>
