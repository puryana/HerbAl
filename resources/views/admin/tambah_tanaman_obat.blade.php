<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Tanaman Obat</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Tambah Tanaman Obat ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Tambah Data Tanaman Obat</h2>
            </div>

            <form id="formTambahTanaman" class="formTambahTanaman" method="POST" action="{{ route('tanaman.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nama_tanaman">Nama Tanaman Obat</label>
                    <input type="text" id="nama_tanaman" name="nama_tanaman" placeholder="Masukkan Nama Tanaman Obat" value="{{ old('nama_tanaman') }}" required>
                </div><br>

                <div class="form-group">
                    <label for="gambar">Pilih File</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" required>
                </div><br>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Tanaman Obat</label>
                    <textarea id="deskripsi" rows="3" name="deskripsi" placeholder="Masukkan Deskripsi Tanaman Obat" required>{{ old('deskripsi') }}</textarea>
                </div><br>

                <div class="form-group">
                    <label for="bagian_tumbuhan">Bagian Tumbuhan</label>
                    <textarea id="bagian_tumbuhan" rows="3" name="bagian_tumbuhan" placeholder="Masukkan Bagian Tumbuhan yang digunakan" required>{{ old('bagian_tum') }}</textarea>
                </div><br>

                <div class="form-group">
                    <label for="khasiat">Khasiat</label>
                    <textarea id="khasiat" rows="3" name="khasiat" placeholder="Masukkan Khasiat" required>{{ old('khasiat') }}</textarea>
                </div><br>

                <div class="form-group">
                    <label for="penggunaan">Penggunaan</label>
                    <textarea id="penggunaan" name="penggunaan" rows="3" placeholder="Masukkan Penggunaan" required>{{ old('penggunaan') }}</textarea>
                </div><br>

                <div class="form-group">
                    <label for="efekSamping">Efek Samping</label>
                    <textarea id="efekSamping" name="efekSamping" rows="3" placeholder="Masukkan Efek Samping" required>{{ old('efek') }}</textarea>
                </div><br>

                <button class="btn-add-back" type="button" onclick="loadContent('tanaman_obat')">Kembali</button><br>

                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupFormTanamanListener(this)">Simpan</button>
                    <button type="reset" class="btn-hapus">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
