<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Ramuan</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Edit Ramuan ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Edit Data Ramuan</h2>
            </div>

            <form id="formEditRamuan" class="formEditRamuan" action="{{ route('ramuan.update', $ramuan->id_ramuan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- nama ramuan -->
                <div class="form-group">
                    <label for="nama_ramuan">Nama Ramuan</label>
                    <input 
                    type="text" 
                    id="nama_ramuan" 
                    name="nama_ramuan"
                    value="{{ old('nama_ramuan', $ramuan->nama_ramuan) }}" 
                    required>
                </div><br>

                <!-- Kategori -->
                <div class="form-group">
                    <label for="id_kategori">Pilih Kategori</label>
                    <select id="id_kategori" name="id_kategori" required>
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id_kategori }}" {{ $ramuan->id_kategori == $item->id_kategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div><br>

                <!-- Tampilkan Gambar Lama -->
                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    @if ($ramuan->gambar)
                        <img 
                            src="{{ asset('storage/img/ramuan/' . $ramuan->gambar) }}" 
                            alt="{{ $ramuan->nama_ramuan }}" 
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

                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Ramuan</label>
                    <textarea
                        rows="3"
                        id="deskripsi" 
                        name="deskripsi" 
                        required>{{ old('deskripsi', $ramuan->deskripsi) }} 
                    </textarea>
                </div><br>

                <!-- Manfaat -->
                <div class="form-group">
                    <label for="manfaat">Manfaat Ramuan</label>
                    <textarea
                        rows="3"
                        id="manfaat" 
                        name="manfaat" 
                        required>{{ old('manfaat', $ramuan->manfaat) }}
                    </textarea>
                </div><br>

                <!-- EfekSamping-->
                <div class="form-group">
                    <label for="efekSamping">Efek Samping</label>
                    <textarea
                        rows="3"
                        id="efekSamping" 
                        name="efekSamping" 
                        required>{{ old('efekSamping', $ramuan->efekSamping) }} 
                    </textarea>
                </div><br>

                <!-- WaktuKonsumsi -->
                <div class="form-group">
                    <label for="waktuKonsumsi">Waktu Penggunaan</label>
                    <textarea
                        rows="3"
                        id="waktuKonsumsi" 
                        name="waktuKonsumsi" 
                        required>{{ old('waktuKonsumsi', $ramuan->waktuKonsumsi) }} 
                    </textarea><br>
                </div>

                <!-- saran -->
                <div class="form-group">
                    <label for="saranPenggunaan">Saran Penggunaan</label>
                    <textarea 
                        id="saranPenggunaan" 
                        name="saranPenggunaan"
                        rows="3" 
                        required>{{ old('saranPenggunaan', $ramuan->saranPenggunaan) }}
                    </textarea><br>
                </div>

                <div class="form-group">
                    <label for="bahan">Bahan-bahan</label>
                    <textarea 
                        id="bahan"
                        name="bahan"
                        rows="3"
                        required>{{ old('efek', $ramuan->bahan) }} 
                    </textarea><br>
                </div>

                <div class="form-group">
                    <label for="langkahPembuatan">Langkah-langkah Pembuatan</label>
                    <textarea 
                        id="langkahPembuatan" 
                        name="langkahPembuatan"
                        rows="3" 
                        required>{{ old('langkahPembuatan', $ramuan->langkahPembuatan) }} 
                    </textarea><br>
                </div>

                <!-- Tombol Aksi -->
                <button class="btn-add-back" type="button" onclick="loadContent('ramuan')">Kembali</button>
                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupEditRamuanListener(this)">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
