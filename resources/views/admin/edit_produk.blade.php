<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Produk</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Edit Produk ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Edit Data Produk</h2>
            </div>

            <form id="formEditProduk" class="formEditProduk" action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- nama produk -->
                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input 
                        type="text" 
                        id="nama_produk" 
                        name="nama_produk" 
                        value="{{ old('nama_produk', $produk->nama_produk) }}" 
                        required>
                </div><br>

                <!-- Kategori -->
                <div class="form-group">
                    <label for="id_kategori">Pilih Kategori</label>
                    <select id="id_kategori" name="id_kategori" required>
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id_kategori }}" {{ $produk->id_kategori == $item->id_kategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div><br>

                <!-- Tampilkan Gambar Lama -->
                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    @if ($produk->gambar)
                        <img 
                            src="{{ asset('storage/img/produk/' . $produk->gambar) }}" 
                            alt="{{ $produk->nama_produk }}" 
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

                <!-- harga  -->
                <div class="form-group">
                    <label for="harga">Harga Produk</label>
                    <input 
                    type="text" 
                    id="harga" 
                    name="harga" 
                    value="{{ old('harga', $produk->harga) }}" 
                    required>
                </div><br>
                
                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Produk</label>
                    <textarea
                        rows="3"
                        id="deskripsi" 
                        name="deskripsi" 
                        rows="3"
                        required>{{ old('deskripsi', $produk->deskripsi) }}
                    </textarea>
                </div><br>

                <!-- Manfaat -->
                <div class="form-group">
                    <label for="manfaat">Manfaat Produk</label>
                    <textarea
                        rows="3"
                        id="manfaat" 
                        name="manfaat" 
                        rows="3"
                        required>{{ old('manfaat', $produk->manfaat) }}
                    </textarea>
                </div><br>

                <!-- EfekSamping-->
                <div class="form-group">
                    <label for="efekSamping">Efek Samping</label>
                    <textarea
                        rows="3"
                        id="efekSamping" 
                        name="efekSamping" 
                        rows="3"
                        required>{{ old('efekSamping', $produk->efekSamping) }}
                    </textarea>
                </div><br>

                <!-- WaktuKonsumsi -->
                <div class="form-group">
                    <label for="waktuKonsumsi">Waktu Konsumsi</label>
                    <textarea
                        rows="3"
                        id="waktuKonsumsi" 
                        name="waktuKonsumsi" 
                        rows="3"
                        required>{{ old('waktuKonsumsi', $produk->waktuKonsumsi) }}
                    </textarea>
                </div><br>

                <!-- Tombol Aksi -->
                <button class="btn-add-back" type="button" onclick="loadContent('produk')">Kembali</button>
                <div class="form-actions">
                    <button type="submit" class="btn-simpan">Simpan</button>
                    {{-- <button type="submit" class="btn-simpan" onclick="return setupEditProdukListener(this)">Simpan</button> --}}
                </div>
            </form>
        </div>
    </div>
</body>

</html>
