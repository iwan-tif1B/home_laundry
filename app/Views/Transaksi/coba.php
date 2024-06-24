<script src="https://unpkg.com/tabulator-tables@5.0.7/dist/js/tabulator.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Inisialisasi Tabulator
    var table_layanan_pelanggan = new Tabulator("#tes_tabulator", {
        layout: "fitColumns",
        placeholder: "No Data Available",
        columns: [{
                title: "Nama Layanan",
                field: "nama_layanan",
                headerSort: false,
                headerHozAlign: "center",
                cssClass: "bg-dark text-white"
            },
            {
                title: "Harga Perlayanan",
                field: "harga",
                headerSort: false,
                formatter: "money",
                formatterParams: {
                    decimal: ".",
                    thousand: ",",
                    symbol: "Rp ",
                    precision: 2
                },
                headerHozAlign: "center",
                cssClass: "bg-dark text-white"
            },
            {
                title: "Qty(kg)",
                field: "qty",
                headerSort: false,
                headerHozAlign: "center",
                cssClass: "bg-dark text-white"
            },
            {
                title: "Subtotal",
                field: "subtotal",
                formatter: "money",
                formatterParams: {
                    decimal: ".",
                    thousand: ",",
                    symbol: "Rp ",
                    precision: 2
                },
                bottomCalc: "sum",
                bottomCalcFormatter: "money",
                bottomCalcFormatterParams: {
                    decimal: ".",
                    thousand: ",",
                    symbol: "Rp ",
                    precision: 2
                },
                headerHozAlign: "center",
                cssClass: "bg-dark text-white"
            },
            {
                formatter: "buttonCross",
                width: 40,
                align: "center",
                headerSort: false,
                cellClick: function(e, cell) {
                    cell.getRow().delete();
                },
                headerHozAlign: "center",
                cssClass: "bg-dark text-white"
            },
            {
                title: "",
                field: 'id_layanan',
                visible: false
            } // Kolom tidak terlihat
        ],
    });

    // Fungsi untuk menangani perubahan jumlah quantity
    $(".jumlah_qty").on('change', function() {
        var selectedOption = $(".nama_layanan option:selected");
        var cek_layanan = selectedOption.text();
        var id_jenis_layanan = selectedOption.val();
        var jumlah_qty = $(".jumlah_qty").val();
        var [layanan, harga, durasi] = cek_layanan.split(' / ');

        if (cek_layanan === '' || jumlah_qty === '') {
            return;
        }

        table_layanan_pelanggan.addData([{
            id_layanan: id_jenis_layanan,
            nama_layanan: layanan,
            harga: parseFloat(harga),
            qty: parseFloat(jumlah_qty),
            subtotal: parseFloat(harga) * parseFloat(jumlah_qty),
            waktu_layanan: durasi
        }], true);

        $(".jumlah_qty").val('');
        $(".nama_layanan").val('');
    });

    // Fungsi untuk menyimpan transaksi
    function savetransaksi() {
        var formData = $('#transaksiForm').serialize();
        var tableData = table_layanan_pelanggan.getData();
        var tableDataJSON = JSON.stringify(tableData);
        formData += '&layanan_pelanggan=' + encodeURIComponent(tableDataJSON);

        var total = tableData.reduce((sum, row) => sum + parseFloat(row.subtotal), 0);
        formData += '&total_harga_layanan=' + total;

        $.ajax({
            type: 'POST',
            url: $('#transaksiForm').attr('action'),
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Data saved successfully.',
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location.reload();
                        }
                    });
                } else {
                    console.error('Error:', response.message);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to save data.',
                    });
                }
            },
            error: function(error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to save data.',
                });
            }
        });
    }

    // Fungsi untuk menghapus transaksi
    function deleteTransaksi(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this transaction!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("<?= base_url('Web/transaksi/delete/'); ?>" + id, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Transaction has been deleted.',
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    }

    // Fungsi untuk mengedit transaksi
    function edit_transaksi(url, id) {
        $.ajax({
            type: 'GET',
            url: url + id,
            success: function(response) {
                if (response.transaksi) {
                    $('#transaksiForm input[name="id_pelanggan"]').val(response.transaksi.id_pelanggan);
                    $('#transaksiForm input[name="tanggal_masuk"]').val(response.transaksi.tanggal_masuk);
                    $('#transaksiForm input[name="tanggal_selesai"]').val(response.transaksi.tanggal_selesai);
                    $('#transaksiForm input[name="total_harga"]').val(response.transaksi.total_harga);
                    $('#transaksiForm select[name="status_bayar"]').val(response.transaksi.status_bayar);
                    $('#transaksiForm select[name="status"]').val(response.transaksi.status);
                    $('#transaksiForm input[name="keluhan"]').val(response.transaksi.keluhan);
                    $('#transaksiForm select[name="id_pelanggan"]').val(response.transaksi.id_pelanggan); // Added line to set the selected option
                    $('#transaksiForm select[name="id_pelanggan"]').attr("disabled", true); // Disable the select field
                } else {
                    console.error('No transaksi data found in response');
                }

                var actionUrl = "<?= base_url('Web/transaksi/update/'); ?>" + id;
                $('#transaksiForm').attr('action', actionUrl);

                $('#exampleModal .modal-title').text('Edit Transaksi');
                $('#exampleModal button[type="submit"]').text('Update Transaksi');

                if (response.transaksi_layanan) {
                    table_layanan_pelanggan.setData(response.transaksi_layanan);
                } else {
                    console.error('No transaksi_layanan data found in response');
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    // Fungsi untuk menangani perubahan jumlah quantity
    function tambah_transaksi() {
        $('#transaksiForm')[0].reset();
        $('#transaksiForm select[name="id_pelanggan"]').attr("disabled", false); // Enable the select field for new transactions
        $('#transaksiForm').attr('action', "<?= base_url('/Web/transaksi/store/') ?>");
        $('#exampleModal .modal-title').text('Tambah Transaksi');
        $('#exampleModal button[type="submit"]').text('Simpan Transaksi');
        table_layanan_pelanggan.clearData(); // Clear table data
    }
</script>