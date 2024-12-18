// Menangani formulir tambah penyakit
function setupFormPenyakitListener() {
    let form = document.querySelector("form#formTambahPenyakit");

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Mencegah reload halaman

            let formData = new FormData(this);

            fetch(this.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Gagal menyimpan penyakit.");
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.success) {
                        // Muat ulang halaman daftar penyakit ke dalam #content
                        loadContent('/penyakit');
                    } else {
                        console.error(
                            "Gagal menyimpan penyakit:",
                            data.message || "Tidak ada pesan kesalahan."
                        );
                    }
                })
                .catch((error) => console.error("Error:", error.message));
        });
    }
}

// Fungsi untuk setup listener tombol edit 
function setupFormEditPenyakitListener() {
    let form = document.querySelector("form#formEditPenyakit");

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Mencegah reload halaman

            let formData = new FormData(this);

            fetch(this.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Gagal menyimpan kategori.");
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log("Respons dari server:", data);

                    if (data.success) {
                        alert(data.message || "Data berhasil diperbarui!");
                        loadContent('/penyakit'); // Arahkan ke halaman 
                    } else {
                        console.error(
                            "Gagal memperbarui data:",
                            data.message || "Tidak ada pesan kesalahan."
                        );
                    }
                })
                .catch((error) => console.error("Error:", error.message));
        });
    }
}

// Fungsi untuk Hapus
function confirmDeleteDataPenyakit(button) {
    if (confirm('Apakah Anda yakin ingin menghapus Data Penyakit ini?')) {
        let form = button.closest('form');
        
        // Kirim permintaan DELETE menggunakan fetch
        fetch(form.action, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Gagal menghapus data.");
            }
            return response.json(); // Pastikan server mengembalikan JSON
        })
        .then((data) => {
            console.log("Respons dari server:", data);

            // Jika sukses, hapus baris dari tabel dan updat
            if (data.success) {
                // Hapus baris kategori terkait di tabel
                const row = form.closest("tr");
                row.remove();

                // Muat ulang halaman kategori tanpa reload seluruh halaman
                loadContent('/penyakit');
            } else {
                alert("Gagal menghapus data: " + (data.message || "Tidak diketahui"));
            }
        })
        .catch((error) => console.error("Error saat menghapus kategori:", error.message));
    }
    return false; // Mencegah submit form standar
}

// Fungsi untuk setup listeners pada elemen dinamis setelah konten dimuat
function setupButtonPenyakitListeners() {
    let deleteButton = document.getElementById("delete_penyakit");
    if (deleteButton) { // Pastikan tombol ditemukan
        deleteButton.addEventListener("click", function (e) {
            e.preventDefault(); // Hindari submit default
            confirmDeleteKategori(deleteButton); // Panggil fungsi hapus
        });
    }
}

// // Fungsi untuk setup listeners pada elemen dinamis setelah konten dimuat
// function setupButtonPenyakitListeners() {
//     let deleteButtons = document.querySelectorAll(".btn-delete");
//     deleteButtons.forEach((button) => {
//         button.addEventListener("click", function (e) {
//             e.preventDefault();
//             confirmDeleteDataPenyakit(button); // Panggil fungsi hapus
//         });
//     });
// }


// Fungsi untuk memuat konten menggunakan AJAX
function loadContent(page) {
    fetch(page) // Tambahkan '/admin' sebagai prefix
        .then((response) => {
            if (!response.ok) {
                throw new Error("Halaman tidak ditemukan: " + page);
            }
            return response.text();
        })
        .then((data) => {
            document.getElementById("content").innerHTML = data;

            // Jalankan ulang listener untuk elemen dinamis
            setupFormPenyakitListener();
            setupFormEditPenyakitListener();
            setupButtonPenyakitListeners();
            
        })
        .catch((error) => {
            console.error("Error:", error.message);
            alert("Gagal memuat konten. Silakan coba lagi.");
        });
}

// Inisialisasi listener saat halaman pertama kali dimuat
document.addEventListener("DOMContentLoaded", function () {
    setupFormPenyakitListener();
    setupFormEditPenyakitListener();
    setupButtonPenyakitListeners();
});
