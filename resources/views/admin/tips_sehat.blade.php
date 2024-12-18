<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tips Sehat</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Coloumn ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Kelola Tips Sehat</h2>
            </div>
            <div class="cardSubHeader">
                <h3>Data Tips Sehat</h3>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <td>Nama Tips Sehat</td>
                        <td>Gambar</td>
                        <td>Obsi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tips as $tip)
                    <tr>
                        <td>{{ $tip->nama_tips}}</td>
                        <td>
                            <img 
                                src="{{ asset('storage/img/tips/' . $tip->gambar) }}" 
                                alt="{{ $tip->nama_tips }}" 
                                style="width: 50px; height: auto;">
                        </td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="#" class="btn-edit" onclick="loadContent('{{ route('tips.edit', $tip->id_tips) }}')">Edit</a>
                
                            <!-- Form Hapus -->
                        <form action="{{ route('tips.destroy', $tip->id_tips) }}" method="POST" class="form-delete" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button id="delete_tips" type="submit" class="btn-delete" onclick="return confirmDeleteTips(this)">Hapus</button>
                        </form> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> <br>

            <!-- Add Button -->
            <button class="btn-add" onclick="loadContent('tambah_tips_sehat')">Tambah Data Tips Sehat</button>
        </div>
    </div>
        <!-- Elemen untuk menampilkan pesan sukses -->
        @if (session('success'))
        <div id="success-message" style="color: green; margin-top: 10px;">
            {{ session('success') }}
        </div>
    @endif
</body>

</html>