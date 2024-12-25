<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style_col.css">
</head>

<body>
    <!-- ======================= Form Edit ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Edit Pesanan</h2>
            </div>

            <form class="form-ramuan">
                <div class="form-group">
                    <label for="nama-ramuan">Status</label>
                    <input type="obsi" id="nama-ramuan" placeholder="Pilih Status">
                </div>

                <div class="form-group">
                    <label for="gambar">No Resi</label>
                    <input type="text" id="nama-ramuan" placeholder="Masukkan Nomor Resi">
                </div>

                <button class="btn-add-back" onclick="loadContent('pesanan.html')">Kembali</button>

                <div class="form-actions">
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
