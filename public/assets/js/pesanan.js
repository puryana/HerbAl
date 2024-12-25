 // Fungsi untuk setup listener tombol edit 
function setupEditPesananListener() {
    let form = document.querySelector("form#formEditPesanan");

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
                        loadContent('/pesanan'); // Arahkan ke halaman 
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
            setupEditPesananListener();
            
        })
        .catch((error) => {
            console.error("Error:", error.message);
            alert("Gagal memuat konten. Silakan coba lagi.");
        });
}

// Inisialisasi listener saat halaman pertama kali dimuat
document.addEventListener("DOMContentLoaded", function () {
    setupEditPesananListener();
});
