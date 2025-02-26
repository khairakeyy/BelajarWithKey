let totalWeight = 0;

function addFood(weight) {
    totalWeight += weight;
    document.getElementById('total-weight').textContent = totalWeight + ' gr';
    // Pindahkan item ke bagian makanan pagi/siang/malam sesuai kebutuhan
}

function removeFood(weight) {
    totalWeight -= weight;
    if (totalWeight < 0) totalWeight = 0;
    document.getElementById('total-weight').textContent = totalWeight + ' gr';
    // Hapus item dari bagian makanan jika diperlukan
}

function showNutrition() {
    alert("Menampilkan informasi nutrisi");
}
