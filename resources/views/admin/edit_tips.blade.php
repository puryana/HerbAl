<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tips Sehat</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Form Edit Tips Sehat ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Edit Tips Sehat</h2>
            </div>

            <form id="formEditTips" class="formEditTips" action="{{ route('tips.update', $tips->id_tips) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- nama tips -->
                <div class="form-group">
                    <label for="nama_tips">Nama Tips Sehat</label>
                    <input 
                        type="text"
                        id="nama_tips"
                        name="nama_tips"
                        value="{{ old('nama_tips', $tips->nama_tips) }}" 
                        required>
                </div><br>

                <!-- Tampilkan Gambar Lama -->
                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    @if ($tips->gambar)
                        <img 
                            src="{{ asset('storage/img/tips/' . $tips->gambar) }}" 
                            alt="{{ $tips->nama_tips }}" 
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
                    <label for="deskripsi">Deskripsi Tips Sehat</label>
                    <textarea
                        rows="3"
                        id="deskripsi" 
                        name="deskripsi" 
                        required>{{ old('deskripsi', $tips->deskripsi) }}</textarea>
                </div><br>

                <!-- Resep1 -->
                <div class="form-group">
                    <label for="resep1">Resep 1</label>
                    <textarea 
                        id="resep1"
                        name="resep1"
                        rows="3" 
                        required>{{ old('resep1', $tips->resep1) }}</textarea>
                </div><br>

                <!-- Resep2 -->
                <div class="form-group">
                    <label for="resep2">Resep 2</label>
                    <textarea 
                        id="resep2"
                        name="resep2"
                        rows="3" 
                        required>{{ old('resep2', $tips->resep2) }}</textarea>
                </div><br>

                <!-- Resep3 -->
                <div class="form-group">
                    <label for="resep3">Resep 3</label>
                    <textarea 
                        id="resep3"
                        name="resep3"
                        rows="3" 
                        required>{{ old('resep3', $tips->resep3) }}</textarea> 
                </div><br>

                <button class="btn-add-back" type="button" onclick="loadContent('tips_sehat')">Kembali</button>
                
                <div class="form-actions">
                    <button type="submit" class="btn-simpan" onclick="return setupEditTipsListener(this)">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
