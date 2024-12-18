<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin HerbAl</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- ======================= Cards ================== -->
    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers">1,504</div>
                <div class="cardName">Tampilan Harian</div>
            </div>

            <div class="iconBx">
                <ion-icon name="eye-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">80</div>
                <div class="cardName">Penjualan</div>
            </div>

            <div class="iconBx">
                <ion-icon name="cart-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">284</div>
                <div class="cardName">Ulasan</div>
            </div>

            <div class="iconBx">
                <ion-icon name="star-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">$55</div>
                <div class="cardName">Konsultasi</div>
            </div>

            <div class="iconBx">
                <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
            </div>
        </div>
    </div>

    <!-- ================ Order Details List ================= -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Pesanan Terbaru</h2>
                <a href="#" class="btn">Lihat Semua</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <td>Nama</td>
                        <td>Harga</td>
                        <td>Pembayaran</td>
                        <td>Status</td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Bubuk Jamu Kunyit</td>
                        <td>Rp 1200</td>
                        <td>Dibayar</td>
                        <td><span class="status selesai">Selesai</span></td>
                    </tr>

                    <tr>
                        <td>Parem</td>
                        <td>Rp 1000</td>
                        <td>COD</td>
                        <td><span class="status dikirim">Dikirim</span></td>
                    </tr>

                    <tr>
                        <td>Apple Watch</td>
                        <td>$1200</td>
                        <td>Paid</td>
                        <td><span class="status dikemas">Dikemas</span></td>
                    </tr>

                    <tr>
                        <td>Addidas Shoes</td>
                        <td>$620</td>
                        <td>Due</td>
                        <td><span class="status diproses">Diproses</span></td>
                    </tr>

                    <tr>
                        <td>Star Refrigerator</td>
                        <td>$1200</td>
                        <td>Paid</td>
                        <td><span class="status selesai">Selesai</span></td>
                    </tr>

                    <tr>
                        <td>Dell Laptop</td>
                        <td>$110</td>
                        <td>Due</td>
                        <td><span class="status dikirim">Dikirim</span></td>
                    </tr>

                    <tr>
                        <td>Apple Watch</td>
                        <td>$1200</td>
                        <td>Paid</td>
                        <td><span class="status dikemas">Dikemas</span></td>
                    </tr>

                    <tr>
                        <td>Addidas Shoes</td>
                        <td>$620</td>
                        <td>Due</td>
                        <td><span class="status diproses">Diproses</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- ================= Produk Herbal Terlaris ================ -->
        <div class="recentCustomers">
            <div class="cardHeader">
                <h2>Produk Herbal Terlaris</h2>
            </div>

            <table>
                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Minyak Kelapa Murni <br> <span>Terjual: 5+ unit</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Teh Daun Jati <br> <span>Terjual: 300+ unit</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Kapsul Temulawak <br> <span>Terjual: 250+ unit</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Jamu Kunyit Asam <br> <span>Terjual: 200+ unit</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Jamu Kunyit Asam <br> <span>Terjual: 200+ unit</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Jamu Kunyit Asam <br> <span>Terjual: 200+ unit</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Jamu Kunyit Asam <br> <span>Terjual: 200+ unit</span></h4>
                    </td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Jamu Kunyit Asam <br> <span>Terjual: 200+ unit</span></h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
