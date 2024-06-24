<?php
echo $this->include('layout/header.php');
?>
<div class="page">
    <?php
    echo $this->include('layout/sidebar.php');
    ?>
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Vertical layout
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <span class="d-none d-sm-inline">
                                <a href="#" class="btn">
                                    New view
                                </a>
                            </span>
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Create new report
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-md-12">
                        <form class="card" method="post" action="<?= route_to('web/pegawai/update/' . $pegawai['id']); ?>">

                            <div class="card-header">
                                <h3 class="card-title">Edit Pegawai</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Username</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="username" placeholder="Enter username" value="<?= $pegawai['username'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Password</label>
                                    <div class="col">
                                        <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?= $pegawai['password'] ?>">
                                        <!-- Tambahkan petunjuk untuk penggunaan password baru jika diperlukan -->
                                        <small class="form-hint">
                                            Your password must be 8-20 characters long, contain letters and numbers, and must not contain
                                            spaces, special characters, or emoji.
                                        </small>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Nama</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="nama" placeholder="Enter nama" value="<?= $pegawai['nama'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Alamat</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="alamat" placeholder="Enter alamat" value="<?= $pegawai['alamat'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">No Handphone</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="no_handphone" placeholder="Enter no handphone" value="<?= $pegawai['no_handphone'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
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