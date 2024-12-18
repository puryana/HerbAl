<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tips Sehat</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Tambah Tips Sehat ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Tambah Tips Sehat</h2>
            </div>

            <form id="formTambahTips" class="formTambahTips" method="POST" action="{{ route('tips.store') }}" enctype="multipart/form-data">
                
                @csrf  <!-- CSRF token untuk keamanan -->
                <div class="form-group">
                    <label for="nama_tips">Nama Tips Sehat</label>
                    <input type="text" id="nama_tips" name="nama_tips" placeholder="Masukkan Nama Tips Sehat" required>
                </div><br>

                <div class="form-group">
                    <label for="gambar">Pilih File</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" required>
                </div><br>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Tips Sehat</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi Tips Sehat" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="resep1">Resep 1</label>
                    <textarea id="resep1" name="resep1" rows="3" placeholder="Masukkan Resep 1" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="resep2">Resep 2</label>
                    <textarea id="resep2" name="resep2" rows="3" placeholder="Masukkan Resep 2" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="resep3">Resep 3</label>
                    <textarea id="resep3" name="resep3" rows="3" placeholder="Masukkan Resep 3" required></textarea>
                </div><br>

                <button class="btn-add-back" type="button" onclick="loadContent('tips_sehat')">Kembali</button>

                <div class="form-actions">
                    <button type="submit" class="btn-simpan" class="btn-simpan" onclick="return setupTipsListener(this)">Simpan</button>
                    <button type="reset" class="btn-hapus">Hapus</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
