<?php
usort($transaksi, function ($a, $b) {
    return strtotime($b->tanggal_masuk) - strtotime($a->tanggal_masuk);
});

echo $this->include('layout/header.php');
?>
<div class="page">
    <?php
    echo $this->include('layout/sidebar.php');
    ?>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-dark text-white">
                                <h1 class="card-title"> Data Transaksi</h1>
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-solid fa-plus mx-1"></i>Tambah Transaksi
                                        </button>
                                        <a href="<?= site_url('Web/transaksi/export') ?>" class="btn btn-success">Export Data</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-mobile-md card-table" style="font-size: 0.9rem;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Id Trx</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Total Harga</th>
                                                <th>Status Trx</th>
                                                <th>Status Bayar</th>
                                                <th>Keluhan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($transaksi as $dt) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $dt->id_transaksi; ?></td>
                                                    <td><?= $dt->nama_pelanggan; ?></td>
                                                    <td><?= date("d-m-Y", strtotime($dt->tanggal_masuk)); ?></td>
                                                    <td><?= date("d-m-Y", strtotime($dt->tanggal_selesai)); ?></td>
                                                    <td><?= "Rp " . number_format($dt->total_harga, 2, ',', '.'); ?></td>
                                                    <td>
                                                        <?php if ($dt->status == 'pending') : ?>
                                                            <span class="badge badge-danger" style="background-color: red; color: white;"><?= ucwords(strtolower($dt->status)); ?></span>
                                                        <?php elseif ($dt->status == 'prosess') : ?>
                                                            <span class="badge badge-warning" style="background-color: orange; color: white;"><?= ucwords(strtolower($dt->status)); ?></span>
                                                        <?php elseif ($dt->status == 'dicuci') : ?>
                                                            <span class="badge badge-primary" style="background-color: blue; color: white;"><?= ucwords(strtolower($dt->status)); ?></span>
                                                        <?php elseif ($dt->status == 'selesai') : ?>
                                                            <span class="badge badge-success" style="background-color: green; color: white;"><?= ucwords(strtolower($dt->status)); ?></span>
                                                        <?php elseif ($dt->status == 'diambil') : ?>
                                                            <span class="badge badge-success" style="background-color: green; color: white;"><?= ucwords(strtolower($dt->status)); ?></span>
                                                        <?php else : ?>
                                                            <span class="badge badge-info" style="color: white;"><?= ucwords(strtolower($dt->status)); ?></span>
                                                        <?php endif; ?>
                                                    </td>


                                                    <td>
                                                        <?php if ($dt->status_bayar == 'belum') : ?>
                                                            <span class="badge badge-danger">
                                                                <i class="fas fa-fw fa-times"></i> <?= $dt->status_bayar; ?>
                                                            </span>

                                                        <?php elseif ($dt->status_bayar == 'sudah') : ?>
                                                            <span class="badge badge-success">
                                                                <i class="fas fa-fw fa-check"></i> <?= $dt->status_bayar; ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $dt->keluhan; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm p-1" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit_transaksi('<?= base_url('/Web/transaksi/edit/') ?>', '<?= $dt->id_transaksi ?>')">
                                                            <i class="fa-solid fa-pen-to-square mx-1"></i> Edit
                                                        </button>

                                                        <button class="btn-delete btn-sm p-1 btn btn-danger" type="button" onclick="deleteTransaksi(<?php echo $dt->id_transaksi; ?>);">
                                                            <i class="fa-solid fa-trash mx-1"></i>Delete
                                                        </button>
                                                    </td>

                                                </tr>

                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo $this->include('layout/footer.php');
        ?>
    </div>
</div>
<?php
echo $this->include('layout/scriptjs.php');
?>

<!-- Modal -->
<div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="card" id="transaksiForm" method="post" action="<?= base_url('/Web/transaksi/store/') ?>">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-6 mt-3">
                                <label>Nama Pelanggan</label>
                                <select class="form-select pelanggan js-example-matcher-start" name="id_pelanggan">
                                    <?php foreach ($arr_pelanggan as $id_pelanggan => $nama_pelanggan) : ?>
                                        <option value="<?= $id_pelanggan ?>"><?= $nama_pelanggan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php
                            $fields = [
                                ['label' => 'Tanggal Masuk', 'name' => 'tanggal_masuk', 'type' => 'date', 'placeholder' => 'Enter Tanggal Masuk'],
                                ['label' => 'Tanggal Selesai', 'name' => 'tanggal_selesai', 'type' => 'date', 'placeholder' => 'Enter Tanggal Selesai'],
                                ['label' => 'Total Bayar', 'name' => 'total_harga', 'type' => 'text', 'placeholder' => 'Enter Total Bayar'],
                                ['label' => 'Status Bayar', 'name' => 'status_bayar', 'type' => 'select', 'options' => ['sudah', 'belum']],
                                ['label' => 'Status', 'name' => 'status', 'type' => 'select', 'options' => ['pending', 'prosess ', 'dicuci', 'selesai', 'diambil']],
                                ['label' => 'Keluhan', 'name' => 'keluhan', 'type' => 'text', 'placeholder' => 'Enter Keluhan'],
                            ];
                            ?>
                            <?php foreach ($fields as $field) : ?>
                                <div class="col-lg-6">
                                    <label class="col-3 col-form-label required"><?= $field['label'] ?></label>
                                    <?php if ($field['type'] === 'select') : ?>
                                        <select class="form-select" name="<?= $field['name'] ?>" id="<?= $field['name'] ?>">
                                            <?php foreach ($field['options'] as $option) : ?>
                                                <option value="<?= $option ?>"><?= $option ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php elseif ($field['name'] === 'id_pegawai') : ?>
                                        <input type="hidden" id="id_pegawai" name="id_pegawai">
                                        <input type="<?= $field['type'] ?>" class="form-control" id="<?= $field['name'] ?>" name="<?= $field['name'] ?>" placeholder="<?= $field['placeholder'] ?>">
                                        <input type="hidden" id="nama_pegawai" name="nama_pegawai">
                                    <?php elseif ($field['name'] === 'id_pelanggan') : ?>
                                        <input type="hidden" id="id_pelanggan" name="id_pelanggan">
                                        <input type="<?= $field['type'] ?>" class="form-control" id="<?= $field['name'] ?>" name="<?= $field['name'] ?>" placeholder="<?= $field['placeholder'] ?>">
                                        <input type="hidden" id="nama_pelanggan" name="nama_pelanggan">
                                    <?php else : ?>
                                        <input type="<?= $field['type'] ?>" class="form-control" id="<?= $field['name'] ?>" name="<?= $field['name'] ?>" placeholder="<?= $field['placeholder'] ?>">
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="row border">
                            <div class="col-lg-6">
                                <label>Nama Layanan</label>
                                <select class="form-select nama_layanan">
                                    <?php foreach ($arr_layanan as $id_layanan => $nama_layanan) : ?>
                                        <option value="<?= $id_layanan ?>"><?= $nama_layanan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Qty</label>
                                <input class="form-control jumlah_qty" type="number">
                            </div>

                        </div>
                        <br>
                        <div id="tes_tabulator"></div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-primary" onclick="savetransaksi()">Simpan Transaksi</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

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
        // Mendapatkan data dari formulir menggunakan serialize()
        var formData = $('#transaksiForm').serialize();

        // Mendapatkan data dari tabel menggunakan getData()
        var tableData = table_layanan_pelanggan.getData();

        // Mengonversi data tabel menjadi string JSON
        var tableDataJSON = JSON.stringify(tableData);

        // Menambahkan data tabel ke formData sebagai pasangan nama dan nilai
        formData += '&layanan_pelanggan=' + encodeURIComponent(tableDataJSON);

        // Menghitung total harga
        var total = tableData.reduce((sum, row) => sum + parseFloat(row.subtotal), 0);

        // Menambahkan total harga ke formData
        formData += '&total_harga_layanan=' + total;

        // Mengirim data melalui AJAX
        $.ajax({
            type: 'POST',
            url: $('#transaksiForm').attr('action'),
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    // Tampilkan pesan sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Data saved successfully.',
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location.reload(); // Muat ulang halaman setelah berhasil menyimpan data
                        }
                    });
                } else {
                    // Tangani kesalahan
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
                // Proceed with deletion if the user confirms
                fetch("<?= base_url('Web/transaksi/delete/'); ?>" + id, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle response from the server
                        console.log(data);

                        // Show a SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Transaction has been deleted.',
                        }).then(() => {
                            // Refresh the page or update the view if necessary
                            location.reload(); // Example: Refresh the page after successful deletion
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
                // Mengatur nilai input berdasarkan respons
                $('#transaksiForm input[name="id_pelanggan"]').val(response.transaksi.id_pelanggan);
                $('#transaksiForm input[name="tanggal_masuk"]').val(response.transaksi.tanggal_masuk);
                $('#transaksiForm input[name="tanggal_selesai"]').val(response.transaksi.tanggal_selesai);
                $('#transaksiForm input[name="total_harga"]').val(response.transaksi.total_harga);
                $('#transaksiForm select[name="status_bayar"]').val(response.transaksi.status_bayar);
                $('#transaksiForm select[name="status"]').val(response.transaksi.status);
                $('#transaksiForm input[name="keluhan"]').val(response.transaksi.keluhan);

                // Mengatur aksi form
                $('#transaksiForm').attr('action', "<?= base_url('Web/transaksi/update/'); ?>" + id);

                // Mengubah judul modal
                $('#exampleModal .modal-title').text('Edit Transaksi');

                // Mengubah teks tombol submit
                $('#exampleModal button[type="submit"]').text('Update Transaksi');

                // Mengatur data tabel Tabulator
                table_layanan_pelanggan.setData(response.transaksi_layanan);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    // Menginisialisasi Litepicker
    document.addEventListener("DOMContentLoaded", function() {
        window.Litepicker && (new Litepicker({
            element: document.getElementById('datepicker-icon'),
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
            },
        }));
    });

    // Mengisi dropdown layanan
    fetch('<?= base_url('Web/jenislayanan/dropdown'); ?>')
        .then(response => response.json())
        .then(data => {
            // Mengisi dropdown dengan data layanan yang diterima
            const selectElement = document.querySelector('.layanan');
            data.forEach(service => {
                const option = document.createElement('option');
                option.value = service.id_layanan;
                option.textContent = service.nama_layanan;
                selectElement.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching services:', error));

    // Memperbarui harga saat layanan dipilih
    document.querySelector('.layanan').addEventListener('change', function() {
        const layananId = this.value;
        fetch(`<?= base_url('Web/jenislayanan/getHargaById'); ?>/${layananId}`)
            .then(response => response.json())
            .then(data => {
                // Mengisi input harga dengan harga layanan yang diterima
                document.querySelector('.harga').value = data.harga;
            })
            .catch(error => console.error('Error fetching service price:', error));
    });

    function matchStart(params, data) {
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
            return data;
        }

        // Skip if there is no 'children' property
        if (typeof data.children === 'undefined') {
            return null;
        }

        // `data.children` contains the actual options that we are matching against
        var filteredChildren = [];
        $.each(data.children, function(idx, child) {
            if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) === 0) {
                filteredChildren.push(child);
            }
        });

        // If we matched any of the group's children, then set the matched children on the group
        // and return the group object
        if (filteredChildren.length) {
            var modifiedData = $.extend({}, data, true);
            modifiedData.children = filteredChildren;

            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }

    $(document).ready(function() {
        $('.js-example-matcher-start').select2({
            matcher: matchStart
        });
    });
</script>