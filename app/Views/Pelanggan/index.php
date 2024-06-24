<?php
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
                <h3 class="card-title"> Data pelanggan</h3>

                <div class="col-auto ms-auto d-print-none">
                  <div class="btn-list">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="clear_cache()">
                      <i class="fa-solid fa-plus mx-1"></i>Tambah pelanggan
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                      <!-- Menampilkan Data pelanggan -->
                      <?php foreach ($pelanggan as $pelangganItem) : ?>
                        <tr>
                          <td><?php echo $pelangganItem['id_pelanggan']; ?></td>
                          <td><?php echo $pelangganItem['nama']; ?></td>
                          <td><?php echo $pelangganItem['no_hp']; ?></td>
                          <td><?php echo $pelangganItem['alamat']; ?></td>
                          <td><?php echo $pelangganItem['username']; ?></td>
                          <td><?php echo $pelangganItem['password']; ?></td>
                          <td>
                            <!-- Tambahkan tombol edit dan delete sesuai kebutuhan -->
                            <button type="button" class="btn btn-primary btn-sm p-1" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit_pelanggan('<?= base_url('/Web/pelanggan/edit/') ?>', 
                              '<?= $pelangganItem['id_pelanggan'] ?>')"><i class="fa-solid fa-pen-to-square mx-1"></i> Edit</button>
                            <button class="btn btn-sm btn-danger p-1" type="button" onclick="deletePelanggan(<?php echo $pelangganItem['id_pelanggan']; ?>);">
                              <i class="fa-solid fa-trash mx-1"></i>Delete</button>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="card" id="pelangganForm" method="post" action="<?= base_url('/Web/pelanggan/store/') ?>">
            <div class="card-body">
              <?php
              $fields = [
                ['label' => 'Username', 'name' => 'username', 'type' => 'text', 'placeholder' => 'Enter username'],
                ['label' => 'Password', 'name' => 'password', 'type' => 'password', 'placeholder' => 'Enter password'],
                ['label' => 'Nama', 'name' => 'nama', 'type' => 'text', 'placeholder' => 'Enter nama'],
                ['label' => 'Alamat', 'name' => 'alamat', 'type' => 'text', 'placeholder' => 'Enter alamat'],
                ['label' => 'No Handphone', 'name' => 'no_hp', 'type' => 'text', 'placeholder' => 'Enter no handphone'],
              ];
              ?>
              <?php foreach ($fields as $field) : ?>
                <div class="mb-3 row">
                  <label class="col-3 col-form-label required"><?= $field['label'] ?></label>
                  <div class="col">

                    <input type="<?= $field['type'] ?>" class="form-control" name="<?= $field['name'] ?>" placeholder="<?= $field['placeholder'] ?>">
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="card-footer text-end">
              <button type="button" class="btn btn-primary" onclick="savepelanggan()">Simpan pelanggan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Menyimpan URL aksi asli
    var originalAction;

    $(document).ready(function() {
      originalAction = $('#pelangganForm').attr('action');
    });

    function edit_pelanggan(url, id) {
      $.ajax({
        type: 'GET',
        url: url + id,
        success: function(response) {

          $('#pelangganForm input[name="username"]').val(response.username);
          $('#pelangganForm input[name="password"]').val(response.password);
          $('#pelangganForm input[name="nama"]').val(response.nama);
          $('#pelangganForm input[name="alamat"]').val(response.alamat);
          $('#pelangganForm input[name="no_hp"]').val(response.no_hp);

          $('#pelangganForm').attr('action', "<?php echo base_url('Web/pelanggan/update/'); ?>" + id);

          // Change modal title
          $('#exampleModal .modal-title').text('Edit Pelanggan');

          $('#exampleModal button[type="submit"]').text('Update Pelanggan');
        },
        error: function(error) {
          console.error('Error:', error);
        }
      });
    }

    function savepelanggan() {
      var formData = $('#pelangganForm').serialize();

      $.ajax({
        type: 'POST', // Menggunakan metode PUT untuk pembaruan data
        url: $('#pelangganForm').attr('action'),
        data: formData,
        success: function(response) {
          if (response.status === 'success') {
            // Jika operasi penyimpanan berhasil, tampilkan pesan sukses SweetAlert
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Data saved successfully.',
            }).then((result) => {
              // Muat ulang halaman setelah pengguna menekan "OK"
              if (result.isConfirmed || result.isDismissed) {
                window.location.reload();
              }
            });
          } else {
            // Tangani kesalahan atau tampilkan pesan
            console.error('Error:', response.message);
          }
        },
        error: function(error) {
          console.error('Error:', error);
          // Tampilkan pesan kesalahan
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to save data.',
          });
        }
      });
    }

    function deletePelanggan(id) {
      // Use SweetAlert for confirmation
      Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this customer!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Proceed with deletion if the user confirms
          fetch("<?php echo base_url('Web/pelanggan/delete/'); ?>" + id, {
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
                text: 'Customer has been deleted.',
              }).then(() => {
                // Refresh the page or update the view if necessary
                location.reload(); // Example: Refresh the page after successful deletion
              });
            })
            .catch(error => console.error('Error:', error));
        }
      });
    }
  </script>