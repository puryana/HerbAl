<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penyakit</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Edit Penyakit ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Edit Data Penyakit</h2>
            </div>

            <form id="formEditPenyakit" class="formEditPenyakit" action="{{ route('penyakit.update', $penyakit->id_penyakit) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input Nama Tanaman -->
                <div class="form-group">
                    <label for="nama_penyakit">Nama Penyakit</label>
                    <input 
                        type="text" 
                        id="nama_penyakit"
                        name="nama_penyakit"
                        value="{{ old('nama_penyakit', $penyakit->nama_penyakit) }}" 
                        required>
                </div><br>

                <!-- Tampilkan Gambar Lama -->
                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    @if ($penyakit->gambar)
                        <img 
                            src="{{ asset('storage/img/penyakit/' . $penyakit->gambar) }}" 
                            alt="{{ $penyakit->nama_penyakit }}" 
                            style="width: 150px; height: auto;">
                    @else
                        <p>Tidak ada gambar</p>
                    @endif
                </div><br>

                <!-- Pilih Gambar Baru -->
                <div class="form-group">
                    <label for="gambar">Pilih File</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*">
                </div><br>

                <!-- Input Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Penyakit</label>
                    <textarea 
                        id="deskripsi" 
                        rows="3" 
                        name="deskripsi" 
                        required>{{ old('deskripsi', $penyakit->deskripsi) }}
                    </textarea>
                </div><br>

                <!-- Input Penyebab -->
                <div class="form-group">
                    <label for="penyebab">Penyebab</label>
                    <textarea 
                        id="penyebab" 
                        name="penyebab"
                        rows="3" 
                        required>{{ old('penyebab', $penyakit->penyebab) }}
                    </textarea>
                </div><br>

                <!-- Input Gejala-->
                <div class="form-group">
                    <label for="gejala">Gejala</label>
                    <textarea 
                        id="gejala"
                        name="gejala"
                        rows="3"
                        required>{{ old('gejala', $penyakit->gejala) }}
                    </textarea>
                </div><br>

                <!-- Input Pantangan -->
                <div class="form-group">
                    <label for="pantangan">Pantangan</label>
                    <textarea 
                        id="pantangan"
                        name="pantangan"
                        rows="3"
                        required>{{ old('pantangan', $penyakit->pantangan) }}
                    </textarea>
                </div><br>

                <!-- Input Anjuran -->
                <div class="form-group">
                    <label for="anjuran">Anjuran</label>
                    <textarea 
                        id="anjuran" 
                        name="anjuran"
                        rows="3"
                        required>{{ old('anjuran', $penyakit->anjuran) }}
                    </textarea>
                </div><br>

                <button class="btn-add-back" type="button" onclick="loadContent('penyakit')">Kembali</button>

                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupFormEditPenyakitListener(this)">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
