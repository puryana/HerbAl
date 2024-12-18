// Menangani formulir tambah Tanaman
function setupFormTanamanListener() {
    let form = document.querySelector("form#formTambahTanaman");

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
                        throw new Error("Gagal menyimpan Data.");
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log("Respons dari server:", data);
                    if (data.success) {
                        loadContent('/tanaman_obat'); // Arahkan ke halaman kategori di folder admin
                    } else {
                        console.error(
                            "Gagal menyimpan Data:",
                            data.message || "Tidak ada pesan kesalahan."
                        );
                    }
                })
                .catch((error) => console.error("Error:", error.message));
        });
    }
}


// Fungsi untuk setup listener tombol edit 
function setupFormEditTanamanListener() {
    let form = document.querySelector("form#formEditTanaman");

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
                        loadContent('/tanaman_obat'); // Arahkan ke halaman 
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
function confirmDeleteDataTanaman(button) {
    if (confirm('Apakah Anda yakin ingin menghapus Data Tanaman ini?')) {
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
                loadContent('/tanaman_obat');
            } else {
                alert("Gagal menghapus data: " + (data.message || "Tidak diketahui"));
            }
        })
        .catch((error) => console.error("Error saat menghapus kategori:", error.message));
    }
    return false; // Mencegah submit form standar
}

// Fungsi untuk setup listeners pada elemen dinamis setelah konten dimuat
function setupButtonTanamanListeners() {
    let deleteButton = document.getElementById("delete_tanaman");
    if (deleteButton) { // Pastikan tombol ditemukan
        deleteButton.addEventListener("click", function (e) {
            e.preventDefault(); // Hindari submit default
            confirmDeleteKategori(deleteButton); // Panggil fungsi hapus
        });
    }
}


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
            setupFormTanamanListener();
            setupFormEditTanamanListener();
            setupButtonTanamanListeners();
            
        })
        .catch((error) => {
            console.error("Error:", error.message);
            alert("Gagal memuat konten. Silakan coba lagi.");
        });
}

// Inisialisasi listener saat halaman pertama kali dimuat
document.addEventListener("DOMContentLoaded", function () {
    setupFormTanamanListener();
    setupFormEditTanamanListener();
    setupButtonTanamanListeners();
});
