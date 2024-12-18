<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
    
</head>

<body>
    <!-- ======================= Form Tambah Kategori================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Tambah Kategori</h2>
            </div>

            <form id="formTambahKategori" class="formTambahKategori" method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
                
                @csrf  <!-- CSRF token untuk keamanan -->
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Nama Kategori" required>
                </div><br>

                <div class="form-group">
                    <label for="gambar">Pilih File</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" required>
                </div>
                
                <button class="btn-add-back" type="button" onclick="loadContent('kategori')">Kembali</button><br>

                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupFormKategoriListener(this)">Simpan</button>
                    <button type="reset" class="btn-hapus">Hapus</button>
                </div>
                
            </form>
        </div>
    </div>
</body>

</html>
