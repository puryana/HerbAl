<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Tanaman Obat</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Edit Tanaman Obat ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Edit Data Tanaman Obat</h2>
            </div>

            <form id="formEditTanaman" class="formEditTanaman" action="{{ route('tanaman.update', $tanaman->id_tanaman) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input Nama Tanaman -->
                <div class="form-group">
                    <label for="nama_tanaman">Nama Tanaman Obat</label>
                    <input 
                        type="text" 
                        id="nama_tanaman" 
                        name="nama_tanaman" 
                        value="{{ old('nama_tanaman', $tanaman->nama_tanaman) }}" 
                        required>
                </div><br>

                <!-- Tampilkan Gambar Lama -->
                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    @if ($tanaman->gambar)
                        <img 
                            src="{{ asset('storage/img/tanaman_obat/' . $tanaman->gambar) }}" 
                            alt="{{ $tanaman->nama_tanaman }}" 
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
                
                <!-- Input Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Tanaman Obat</label>
                    <textarea
                        rows="3"
                        id="deskripsi" 
                        name="deskripsi" 
                        required>{{ old('deskripsi', $tanaman->deskripsi) }}</textarea>
                </div><br>
                
                <!-- Input Bagian Tumbuhan -->
                <div class="form-group">
                    <label for="bagian_tumbuhan">Bagian Tumbuhan</label>
                    <textarea
                        rows="3"
                        id="bagian_tumbuhan" 
                        name="bagian_tumbuhan"
                        required>{{ old('bagian_tumbuhan', $tanaman->bagian_tumbuhan) }}</textarea>
                </div><br>

                <!-- Input Khasiat -->
                <div class="form-group">
                    <label for="khasiat">Khasiat</label>
                    <textarea
                        rows="3"
                        id="khasiat" 
                        name="khasiat" 
                        required>{{ old('khasiat', $tanaman->khasiat) }}</textarea>
                </div><br>

                <!-- Input Penggunaan -->
                <div class="form-group">
                    <label for="penggunaan">Penggunaan</label>
                    <textarea
                        rows="3"
                        id="penggunaan" 
                        name="penggunaan" 
                        required>{{ old('penggunaan', $tanaman->penggunaan) }}</textarea>
                </div><br>

                <!-- Input Efek Samping -->
                <div class="form-group">
                    <label for="efekSamping">Efek Samping</label>
                    <textarea
                        rows="3"
                        id="efekSamping" 
                        name="efekSamping" 
                        required>{{ old('efekSamping', $tanaman->efekSamping) }}</textarea>
                </div><br>

                <!-- Tombol Kembali -->
                <button class="btn-add-back" type="button" onclick="loadContent('tanaman_obat')">Kembali</button>

                <!-- Tombol Aksi -->
                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupFormEditTanamanListener(this)">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
