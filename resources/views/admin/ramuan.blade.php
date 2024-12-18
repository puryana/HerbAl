<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ramuan</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_col.css') }}">
</head>

<body>
    <!-- ======================= Coloumn ================== -->
    <div class="details">
        <div class="recentOrders">
            <!-- Header -->
            <div class="cardHeader">
                <h2>Kelola Ramuan Tradisional</h2>
            </div>
            <div class="cardSubHeader">
                <h3>Data Ramuan</h3>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <td>Nama Ramuan</td>
                        <td>Gambar</td>
                        <td>Obsi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ramuans as $ramuan)
                    <tr>
                        <td>{{ $ramuan->nama_ramuan}}</td>
                        <td>
                            <img 
                                src="{{ asset('storage/img/ramuan/' . $ramuan->gambar) }}" 
                                alt="{{ $ramuan->nama_ramuan }}" 
                                style="width: 50px; height: auto;">
                        </td>
                    
                        <td>
                            <!-- Tombol Edit -->
                            <a href="#" class="btn-edit" onclick="loadContent('{{ route('ramuan.edit', $ramuan->id_ramuan) }}')">Edit</a>
            
                            <!-- Form Hapus -->
                            <form action="{{ route('ramuan.destroy', $ramuan->id_ramuan) }}" method="POST" class="form-delete" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button id="delete_ramuan" type="submit" class="btn-delete" onclick="return confirmDeleteRamuan(this)">Hapus</button>
                            </form> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> <br>

            <!-- Add Button -->
            <button class="btn-add" onclick="loadContent('tambah_ramuan')">Tambah Ramuan</button>
        </div>
    </div>
</body>

</html>
