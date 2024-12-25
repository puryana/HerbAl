<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Produk</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Tambah Produk ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Tambah Data Produk</h2>
            </div>

            <form id="formTambahProduk" class="formTambahProduk" method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                
                @csrf  <!-- CSRF token untuk keamanan -->
                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk" required>
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
                    <label for="gambar">Pilih File</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" required>
                </div><br>

                <div class="form-group">
                    <label for="harga">Harga Produk</label>
                    <input type="number" id="harga" name="harga" placeholder="Masukkan Harga Produk" required>
                </div><br>

                <div class="form-group">
                    <label for="stock">Stok Produk</label>
                    <input type="number" id="stock" name="stock" placeholder="Masukkan Stok Produk" required min="0">
                </div><br>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Produk</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi Produk" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="manfaat">Manfaat Produk</label>
                    <textarea id="manfaat" name="manfaat" rows="3" placeholder="Masukkan Manfaat Produk" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="efekSamping">Efek Samping</label>
                    <textarea id="efekSamping" name="efekSamping" rows="3" placeholder="Masukkan Efek Samping" required></textarea>
                </div><br>

                <div class="form-group">
                    <label for="waktuKonsumsi">Waktu Konsumsi</label>
                    <textarea id="waktuKonsumsi" name="waktuKonsumsi" rows="3" placeholder="Masukkan Waktu Konsumsi" required></textarea>
                </div><br>

                <button class="btn-add-back" type="button" onclick="loadContent('produk')">Kembali</button>

                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupProdukListener(this)">Simpan</button>
                    <button type="reset" class="btn-hapus">Hapus</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
