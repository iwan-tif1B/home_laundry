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
                <h3 class="card-title"> Data Layanan</h3>
                <div class="col-auto ms-auto d-print-none">
                  <div class="btn-list">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="clear_cache()">
                      <i class="fa-solid fa-plus mx-1"></i>Tambah Layanan
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID Layanan</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Waktu Pengerjaan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Menampilkan Data Layanan -->
                      <?php foreach ($jenislayanan as $jenislayananItem) : ?>
                        <tr>
                          <td><?php echo $jenislayananItem['id_layanan']; ?></td>
                          <td><?php echo $jenislayananItem['nama_layanan']; ?></td>
                          <td><?php echo "Rp." . $jenislayananItem['harga']; ?></td>
                          <td><?php echo $jenislayananItem['waktu_pengerjaan'] . " hari"; ?></td>
                          <td><?php echo $jenislayananItem['deskripsi']; ?></td>
                          <td>
                            <!-- Tambahkan tombol edit dan delete sesuai kebutuhan -->
                            <button type="button" class="btn btn-primary btn-sm p-1" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit_jenislayanan('<?= base_url('/Web/jenislayanan/edit/') ?>', '<?= $jenislayananItem['id_layanan'] ?>')"><i class="fa-solid fa-pen-to-square mx-1"></i> Edit</button>
                            <button class="btn btn-sm btn-danger p-1" type="button" onclick="deleteJenislayanan(<?php echo $jenislayananItem['id_layanan']; ?>);"><i class="fa-solid fa-trash mx-1"></i>Delete</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Layanan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="card" id="jenislayananForm" method="post" action="<?= base_url('/Web/jenislayanan/store/') ?>">
            <div class="card-body">
              <?php
              $fields = [
                ['label' => 'Nama Layanan', 'name' => 'nama_layanan', 'type' => 'text', 'placeholder' => 'Enter nama layanan'],
                ['label' => 'Harga', 'name' => 'harga', 'type' => 'text', 'placeholder' => 'Enter harga'],
                ['label' => 'Waktu Pengerjaan', 'name' => 'waktu_pengerjaan', 'type' => 'number', 'placeholder' => 'Enter waktu pengerjaan'],
                ['label' => 'Deskripsi', 'name' => 'deskripsi', 'type' => 'textarea', 'placeholder' => 'Enter deskripsi'],
              ];
              ?>
              <?php foreach ($fields as $field) : ?>
                <div class="mb-3 row">
                  <label class="col-3 col-form-label required"><?= $field['label'] ?></label>
                  <div class="col">
                    <?php if ($field['type'] === 'textarea') : ?>
                      <textarea class="form-control" name="<?= $field['name'] ?>" placeholder="<?= $field['placeholder'] ?>"></textarea>
                    <?php else : ?>
                      <input type="<?= $field['type'] ?>" class="form-control" name="<?= $field['name'] ?>" placeholder="<?= $field['placeholder'] ?>">
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="card-footer text-end">
              <button type="button" class="btn btn-primary" onclick="saveJenislayanan()">Simpan Jenis Layanan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function edit_jenislayanan(url, id) {
      $.ajax({
        type: 'GET',
        url: url + id,
        success: function(response) {
          $('#jenislayananForm input[name="nama_layanan"]').val(response.nama_layanan);
          $('#jenislayananForm input[name="harga"]').val(response.harga);
          $('#jenislayananForm input[name="waktu_pengerjaan"]').val(response.waktu_pengerjaan);
          $('#jenislayananForm textarea[name="deskripsi"]').val(response.deskripsi);

          $('#jenislayananForm').attr('action', "<?php echo base_url('Web/jenislayanan/update/') ?>" + id);

          $('#exampleModal .modal-title').text('Edit Jenis Layanan');
          $('#exampleModal button[type="submit"]').text('Update Jenis Layanan');
        },
        error: function(error) {
          console.error('Error:', error);
        }
      });
    }

    function saveJenislayanan() {
      var formData = $('#jenislayananForm').serialize();

      $.ajax({
        type: 'POST',
        url: $('#jenislayananForm').attr('action'),
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

    function deleteJenislayanan(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this data!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch("<?php echo base_url('Web/jenislayanan/delete/') ?>" + id, {
              method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
              console.log(data);
              Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Data has been deleted.',
              }).then(() => {
                location.reload();
              });
            })
            .catch(error => console.error('Error:', error));
        }
      });
    }
  </script>
</div>
<?php
echo $this->include('layout/footer.php');
?>
</body>

</html>