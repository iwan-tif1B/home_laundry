document.addEventListener('DOMContentLoaded', function () {
    // Fetch layanan data from backend
    fetch('http://localhost:8080/jenislayanan')
        .then(response => response.json())
        .then(data => {
            console.log('Received layanan data:', data);

            if (Array.isArray(data)) {
                // Populate layanan dropdown options
                const layananSelect = document.getElementById('layanan');
                data.forEach(layanan => {
                    const option = document.createElement('option');
                    option.value = layanan.id_layanan;
                    option.dataset.harga = layanan.harga;
                    option.innerText = layanan.nama_layanan;
                    layananSelect.appendChild(option);
                });
            } else {
                console.error('Invalid layanan data format. Expected an array.');
            }
        })
        .catch(error => {
            console.error('Error fetching layanan data:', error);
        });

    document.getElementById('layanan').addEventListener('change', function () {
        // Update harga satuan saat layanan berubah
        const selectedOption = this.options[this.selectedIndex];
        const hargaSatuan = selectedOption.dataset.harga;
        document.getElementById('hargaSatuan').innerText = hargaSatuan;
    });

    function addLayanan() {
        const layananSelect = document.getElementById('layanan');
        const beratInput = document.getElementById('berat');
    
        const selectedOption = layananSelect.options[layananSelect.selectedIndex];
        const id_layanan = selectedOption.value;
        const layananText = selectedOption.text;
        const hargaSatuan = parseFloat(selectedOption.dataset.harga);
        const berat = parseFloat(beratInput.value);
    
        // Validasi
        if (isNaN(berat) || berat <= 0) {
            alert('Berat harus merupakan angka positif.');
            return;
        }
    
        // Tambahkan layanan ke daftar
        const layananList = document.getElementById('layananList');
        const newItem = document.createElement('li');
        newItem.innerHTML = `${layananText} (${berat} kg) - Harga: ${hargaSatuan} USD`;
        layananList.appendChild(newItem);
    
        // Reset input
        beratInput.value = '';
        layananSelect.selectedIndex = -1;
    
        // Hitung total harga
        hitungTotal();
    }    

    function hitungTotal() {
        const beratItems = document.querySelectorAll('#layananList li');
        const totalHargaInput = document.getElementById('totalHarga');
        let totalHarga = 0;

        beratItems.forEach(item => {
            const [layananText, beratText] = item.innerText.split(' ');
            const berat = parseFloat(beratText);
            const hargaSatuan = parseFloat(document.getElementById('hargaSatuan').innerText);
            const subtotal = berat * hargaSatuan;
            totalHarga += subtotal;
        });

        totalHargaInput.value = totalHarga.toFixed(2);
    }

    // Definisikan fungsi createTransaction
    function createTransaction() {
        // Implementasi fungsi createTransaction
        // ...
    }

    // Tambahkan event listener untuk tombol Create Transaction
    document.getElementById('createTransactionBtn').addEventListener('click', createTransaction);
});
