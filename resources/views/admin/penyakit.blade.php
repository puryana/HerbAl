<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Penyakit</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Coloumn ================== -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Kelola Jenis Penyakit</h2>
            </div>
            <div class="cardSubHeader">
                <h3>Data Jenis Penyakit</h3>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <td>Nama Penyakit</td>
                        <td>Gambar</td>
                        <td>Obsi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penyakits as $penyakit)
                    <tr>
                        <td>{{ $penyakit->nama_penyakit}}</td>
                        <td>
                            <img 
                                src="{{ asset('storage/img/penyakit/' . $penyakit->gambar) }}" 
                                alt="{{ $penyakit->nama_penyakit }}" 
                                style="width: 50px; height: auto;">
                        </td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="#" class="btn-edit" onclick="loadContent('{{ route('penyakit.edit', $penyakit->id_penyakit) }}')">Edit</a>
            
                        <!-- Form Hapus -->
                        <form action="{{ route('penyakit.destroy', $penyakit->id_penyakit) }}" method="POST" class="form-delete" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button id="delete_penyakit" type="submit" class="btn-delete" onclick="return confirmDeleteDataPenyakit(this)">Hapus</button>
                        </form>                                
                        
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> <br>

            <!-- Add Button -->
            <button class="btn-add" onclick="loadContent('tambah_penyakit')">Tambah Data Penyakit</button>
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