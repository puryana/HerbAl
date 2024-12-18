<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Ramuan</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Tambah Produk ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Tambah Data Ramuan</h2>
            </div>

            <form id="formTambahRamuan" class="formTambahRamuan" method="POST" action="{{ route('ramuan.store') }}" enctype="multipart/form-data">
                @csrf  <!-- CSRF token untuk keamanan -->
                <div class="form-group">
                    <label for="nama_ramuan">Nama Ramuan</label>
                    <input type="text" id="nama_ramuan" name="nama_ramuan" placeholder="Masukkan Nama Ramuan" required>
                </div><br>

                <div class="form-group">
                    <label for="id_kategori">Pilih Kategori</label>
                    <select id="id_kategori" name="id_kategori" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div><br>

                <div class="form-group">
                    <label for="gambar">Pilih File Gambar</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" required>
                </div><br>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Ramuan</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi Ramuan" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="manfaat">Manfaat Ramuan</label>
                    <textarea id="manfaat" name="manfaat" rows="3" placeholder="Masukkan Manfaat Ramuan" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="efekSamping">Efek Samping</label>
                    <textarea id="efekSamping" name="efekSamping" rows="3" placeholder="Masukkan Efek Samping" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="waktuKonsumsi">Waktu Penggunaan</label>
                    <textarea id="waktuKonsumsi" name="waktuKonsumsi" rows="3" placeholder="Masukkan Waktu Penggunaan" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="saranPenggunaan">Saran Penggunaan</label>
                    <textarea id="saranPenggunaan" name="saranPenggunaan" rows="3" placeholder="Masukkan Saran Penggunaan" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="bahan">Bahan-bahan</label>
                    <textarea id="bahan" name="bahan" rows="3" placeholder="Masukkan Bahan-bahan" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="langkahPembuatan">Langkah-langkah Pembuatan</label>
                    <textarea id="langkahPembuatan" name="langkahPembuatan" rows="3" placeholder="Masukkan Langkah-langkah Pembuatan" required></textarea>
                </div><br>

                <button class="btn-add-back" type="button" onclick="loadContent('ramuan')">Kembali</button>

                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupRamuanListener(this)">Simpan</button>
                    <button type="reset" class="btn-hapus">Hapus</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
