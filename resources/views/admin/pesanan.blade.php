<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style_col.css">
</head>

<body>
    <!-- ======================= Column ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Kelola Pesanan Produk Herbal</h2>
            </div>
            <div class="cardSubHeader">
                <h3>Data Pesanan</h3>
            </div>

            <!-- Table -->
            <table class="styled-table">
                <thead>
                    <tr>
                        <td>Tanggal Transaksi</td>
                        <td>Total</td>
                        <td>Status</td>
                        <td>Pembayaran</td>
                        <td>Nama Pengiriman</td>
                        <td>Resi Pengiriman</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-12-23 14:15:24</td>
                        <td>36.000</td>
                        <td>dibayar</td>
                        <td>bca</td>
                        <td>sicepat</td>
                        <td>123456789</td>
                        <td>
                            <button class="btn-edit" onclick="loadContent('edit_pesanan.html')">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2024-12-23 14:15:24</td>
                        <td>36.000</td>
                        <td>dibayar</td>
                        <td>bca</td>
                        <td>sicepat</td>
                        <td>123456789</td>
                        <td>
                            <button class="btn-edit" onclick="loadContent('edit_pesanan.html')">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2024-12-23 14:15:24</td>
                        <td>36.000</td>
                        <td>dibayar</td>
                        <td>bca</td>
                        <td>sicepat</td>
                        <td>123456789</td>
                        <td>
                            <button class="btn-edit" onclick="loadContent('edit_pesanan.html')">Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
