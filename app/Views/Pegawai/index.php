<?php
echo $this->include('layout/header.php');
?>
<div class="page">
  <?php
  echo $this->include('layout/sidebar.php');
  ?>
  <div class="page-wrapper">
    <div class="page-wrapper">
      <div class="page-body">
        <div class="container-xl">
          <div class="row row-deck row-cards">
            <div class="col-md-12">
              <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                  <h3 class="card-title"> Data Pegawai</h3>

                  <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="clear_cache()">
                        <i class="fa-solid fa-plus mx-1"></i>Tambah Pegawai
                      </button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">

                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>No. HP</th>
                          <th>Email</th>
                          <th>Alamat</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Menampilkan Data Pegawai -->
                        <?php foreach ($pegawai as $pegawaiItem) : ?>
                          <tr>
                            <td><?php echo $pegawaiItem['nama']; ?></td>
                            <td><?php echo $pegawaiItem['no_hp']; ?></td>
                            <td><?php echo $pegawaiItem['email']; ?></td>
                            <td><?php echo $pegawaiItem['alamat']; ?></td>
                            <td>
                              <!-- Tambahkan tombol edit dan delete sesuai kebutuhan -->
                              <button type="button" class="btn btn-primary btn-sm p-1" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit_Pegawai('<?= base_url('/Web/pegawai/edit/') ?>', 
                              '<?= $pegawaiItem['id_pegawai'] ?>')"><i class="fa-solid fa-pen-to-square mx-1"></i> Edit</button>
                              <button class="btn btn-sm btn-danger p-1" type="button" onclick="deletePelanggan(<?php echo $pegawaiItem['id_pegawai']; ?>);">
                                <i class="fa-solid fa-trash mx-1"></i>Delete</button>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="card" id="pegawaiForm" method="post" action="<?= base_url('/Web/pegawai/store/') ?>">
            <div class="card-body">
              <?php
              $fields = [
                ['label' => 'Nama', 'name' => 'nama', 'type' => 'text', 'placeholder' => 'Enter nama'],
                ['label' => 'No Handphone', 'name' => 'no_hp', 'type' => 'text', 'placeholder' => 'Enter no handphone'],
                ['label' => 'Email', 'name' => 'email', 'type' => 'text', 'placeholder' => 'Enter email'],
                ['label' => 'Alamat', 'name' => 'alamat', 'type' => 'text', 'placeholder' => 'Enter alamat'],
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
              <button type="button" class="btn btn-primary" onclick="savePegawai()">Simpan Pegawai</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    var originalAction;
    $(document).ready(function() {
      originalAction = $('#pelangganForm').attr('action');
    });

    function edit_Pegawai(url, id) {
      // Assuming you have an AJAX endpoint to get data for a specific pegawai
      $.ajax({
        type: 'GET',
        url: url + id,
        success: function(response) {
          $('#pegawaiForm input[name="nama"]').val(response.nama);
          $('#pegawaiForm input[name="no_hp"]').val(response.no_hp);
          $('#pegawaiForm input[name="email"]').val(response.email);
          $('#pegawaiForm input[name="alamat"]').val(response.alamat);

          // Set the form action URL with the pegawai ID
          $('#pegawaiForm').attr('action', 'pegawai/update/' + id);

          // Set the pegawai ID in a hidden input
          // $('#pegawai_id').val(id);
        },
        error: function(error) {
          console.error('Error:', error);
        }
      });
    }

    function clear_cache() {
      $('#pegawaiForm')[0].reset();
      $('#pegawaiForm').attr('action', originalAction); // Reset the form action to the original URL
    }

    function savePegawai() {
      var formData = $('#pegawaiForm').serialize();

      $.ajax({
        type: 'POST',
        url: $('#pegawaiForm').attr('action'),
        data: formData,
        success: function(response) {
          if (response.status === 'success') {
            // If the save operation was successful, show SweetAlert success message
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Data saved successfully.',
            }).then((result) => {
              // Reload the page after the user clicks "OK"
              if (result.isConfirmed || result.isDismissed) {
                window.location.reload();
              }
            });
          } else {
            // Handle any errors or display a message
            console.error('Error:', response.message);
          }
        },
        error: function(error) {
          console.error('Error:', error);
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
          fetch("<?php echo base_url('Web/pegawai/delete/'); ?>" + id, {
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
                text: 'Pegawai has been deleted.',
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