// Menangani formulir tambah kategori
function setupFormKategoriListener() {
    let form = document.querySelector("form#formTambahKategori");

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
                        loadContent('/kategori'); // Arahkan ke halaman kategori di folder admin
                    } else {
                        console.error(
                            "Gagal menyimpan kategori:",
                            data.message || "Tidak ada pesan kesalahan."
                        );
                    }
                })
                .catch((error) => console.error("Error:", error.message));
        });
    }
}

// Fungsi untuk setup listener tombol edit 
function setupFormEditKategoriListener() {
    let form = document.querySelector("form#formEditKat");

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
                        alert(data.message || "Kategori berhasil diperbarui!");
                        loadContent('/kategori'); // Arahkan ke halaman kategori
                    } else {
                        console.error(
                            "Gagal memperbarui kategori:",
                            data.message || "Tidak ada pesan kesalahan."
                        );
                    }
                })
                .catch((error) => console.error("Error:", error.message));
        });
    }
}

// Fungsi untuk Hapus
function confirmDeleteKategori(button) {
    if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
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
                throw new Error("Gagal menghapus kategori.");
            }
            return response.json(); // Pastikan server mengembalikan JSON
        })
        .then((data) => {
            console.log("Respons dari server:", data);

            // Jika sukses, hapus baris dari tabel dan update halaman
            if (data.success) {
                // Hapus baris kategori terkait di tabel
                const row = form.closest("tr");
                row.remove();

                // Jika ada redirect_url, arahkan ke halaman tersebut
                if (data.redirect_url) {
                    loadContent(data.redirect_url);
                } else {
                    // Jika tidak, tetap muat ulang halaman
                    loadContent('/kategori');
                }
            } else {
                alert("Gagal menghapus kategori: " + (data.message || "Tidak diketahui"));
            }
        })
        .catch((error) => console.error("Error saat menghapus kategori:", error.message));
    }
    return false; // Mencegah submit form standar
}


// Fungsi untuk setup listeners pada elemen dinamis setelah konten dimuat
function setupButtonKategoriListeners() {
    // Cari elemen dengan ID 'delete_kategori'
    let deleteButton = document.getElementById("delete_kategori");
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
            setupFormKategoriListener();
            setupFormEditKategoriListener();
            setupButtonKategoriListeners();
            
        })
        .catch((error) => {
            console.error("Error:", error.message);
            alert("Gagal memuat konten. Silakan coba lagi.");
        });
}

// Inisialisasi listener saat halaman pertama kali dimuat
document.addEventListener("DOMContentLoaded", function () {
    setupFormKategoriListener();
    setupFormEditKategoriListener();
    setupButtonKategoriListeners();
});
