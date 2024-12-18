<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin HerbAl</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="leaf"></ion-icon>
                        </span>
                        <span class="title-admin">Admin HerbAl</span>
                    </a>
                </li>                

                <li>
                    <a href="#" onclick="loadContent('dashboard')">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('customers')">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('kategori')">
                        <span class="icon">
                            <ion-icon name="albums-outline"></ion-icon>
                        </span>
                        <span class="title">Kategori</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('produk')">
                        <span class="icon">
                            <ion-icon name="cube-outline"></ion-icon>
                        </span>
                        <span class="title">Produk</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('tanaman_obat')">
                        <span class="icon">
                            <ion-icon name="flower-outline"></ion-icon>
                        </span>
                        <span class="title">Tanaman Obat</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('ramuan')">
                        <span class="icon">
                            <ion-icon name="flask-outline"></ion-icon>
                        </span>
                        <span class="title">Ramuan Tradisional</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('penyakit')">
                        <span class="icon">
                            <ion-icon name="medkit-outline"></ion-icon>
                        </span>
                        <span class="title">Penyakit</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('tips_sehat')">
                        <span class="icon">
                            <ion-icon name="pulse-outline"></ion-icon>
                        </span>
                        <span class="title">Tips Sehat</span>
                    </a>
                </li>

                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
                
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <!-- Topbar -->
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Cari Disini">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="User Image">
                </div>
            </div>

            <!-- Dynamic Content Area -->
            <div id="content">
                <!-- Konten dashboard atau halaman lain akan dimuat di sini -->
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/kategori.js') }}"></script>
    <script src="{{ asset('assets/js/produk.js') }}"></script>
    <script src="{{ asset('assets/js/tanaman_obat.js') }}"></script>
    <script src="{{ asset('assets/js/ramuan.js') }}"></script>
    <script src="{{ asset('assets/js/penyakit.js') }}"></script>
    <script src="{{ asset('assets/js/tips.js') }}"></script>
    
    

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
