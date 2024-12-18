<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Data Penyakit</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Tambah Data Penyakit ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Tambah Data Penyakit</h2>
            </div>

            <form id="formTambahPenyakit" class="formTambahPenyakit" method="POST" action="{{ route('penyakit.store') }}" enctype="multipart/form-data">
                
                @csrf  <!-- CSRF token untuk keamanan -->
                <div class="form-group">
                    <label for="nama_penyakit">Nama Penyakit</label>
                    <input type="text" id="nama_penyakit" name="nama_penyakit" placeholder="Masukkan Nama Penyakit" required>
                </div><br>

                <div class="form-group">
                    <label for="gambar">Pilih File</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" required>
                </div><br>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Penyakit</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi Penyakit" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="penyebab">Penyebab</label>
                    <textarea id="penyebab" name="penyebab" rows="3" placeholder="Masukkan Penyebab Sakit" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="gejala">Gejala</label>
                    <textarea id="gejala" name="gejala" rows="3" placeholder="Masukkan Gejala" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="pantangan">Pantangan</label>
                    <textarea id="pantangan" name="pantangan" rows="3" placeholder="Masukkan Pantangan" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="anjuran">Anjuran</label>
                    <textarea id="anjuran" name="anjuran" rows="3" placeholder="Masukkan Anjuran" required></textarea>
                </div><br>

                <button class="btn-add-back" onclick="loadContent('penyakit')">Kembali</button>

                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupFormPenyakitListener(this)">Simpan</button>
                    <button type="reset" class="btn-hapus">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
