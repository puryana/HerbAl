// Menambahkan class 'hovered' ke item list yang dipilih
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Toggle Menu
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// Fungsi untuk memuat konten menggunakan AJAX
function loadContent(page) {
  fetch(page)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("content").innerHTML = data;
    })
    .catch((error) => console.log("Error:", error));
}

// Memuat konten dashboard secara default saat halaman pertama kali dibuka
document.addEventListener("DOMContentLoaded", function () {
  loadContent("dashboard");
});


