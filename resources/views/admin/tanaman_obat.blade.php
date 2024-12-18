<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tanaman Obat</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Coloumn ================== -->
    <div class="details">
        <div class="recentOrders">
            <!-- Header -->
            <div class="cardHeader">
                <h2>Kelola Tanaman Obat</h2>
            </div>
            <div class="cardSubHeader">
                <h3>Data Tanaman Obat</h3>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <td>Nama Tanaman Obat</td>
                        <td>Gambar</td>
                        <td>Obsi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tanaman_obats as $tanaman)
                    <tr>
                        <td>{{ $tanaman->nama_tanaman }}</td>
                        <td>
                            <img 
                                src="{{ asset('storage/img/tanaman_obat/' . $tanaman->gambar) }}" 
                                alt="{{ $tanaman->nama_tanaman }}" 
                                style="width: 50px; height: auto;">
                        </td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="#" class="btn-edit" onclick="loadContent('{{ route('tanaman.edit', $tanaman->id_tanaman) }}')">Edit</a>
            
                            <!-- Form Hapus -->
                            <form action="{{ route('tanaman.destroy', $tanaman->id_tanaman) }}" method="POST" class="form-delete" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button id="delete_tanaman" type="submit" class="btn-delete" onclick="return confirmDeleteDataTanaman(this)">Hapus</button>
                            </form>                                
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> <br>

            <!-- Add Button -->
            <button class="btn-add" onclick="loadContent('tambah_tanaman_obat')">Tambah Tanaman Obat</button>
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
