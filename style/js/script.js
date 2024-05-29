// Logic pengisian input peminjaman buku scr otomatis
function setReturnDate() {
  let borrowDate = new Date(document.getElementById("tgl_peminjaman").value);
  let returnDate = new Date(borrowDate);
  returnDate.setDate(borrowDate.getDate() + 7); // Menambahkan 7 hari

  // Format tanggal pengembalian ke format yyyy-mm-dd
  let formattedDate = returnDate.toISOString().split('T')[0];
  
  document.getElementById("tgl_pengembalian").value = formattedDate;
}

// Logic pengisian input denda dan keterlambatan pengembalian buku scr otomatis
function hitungDenda() {
  const tglPengembalian = new Date(document.getElementById('tgl_pengembalian').value);
  const bukuKembali = new Date(document.getElementById('buku_kembali').value);
  const keterlambatan = document.getElementById('keterlambatan');
  const denda = document.getElementById('denda');
  
  if (bukuKembali > tglPengembalian) {
      keterlambatan.value = 'YA';

      // Hitung jumlah hari keterlambatan
      const timeDifference = bukuKembali - tglPengembalian;
      const daysLate = Math.ceil(timeDifference / (1000 * 3600 * 24));

      // Hitung denda berdasarkan jumlah hari keterlambatan
      denda.value = daysLate * 5000;
  } else {
      keterlambatan.value = 'Tidak';
      denda.value = 0;
  }
}

// Panggil fungsi hitungDenda saat halaman dimuat
window.onload = function() {
  hitungDenda();
}
