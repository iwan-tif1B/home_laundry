<?php include('layout/header.php'); ?>
<div class="page">
    <?php include('layout/sidebar.php'); ?>
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
                            Dashboard
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card bg-primary text-white shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="h3">Total Customers</div>
                                        <div class="h1 mb-0"><?= $totalCustomers; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card bg-success text-white shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="h3">Completed Transactions</div>
                                        <div class="h1 mb-0"><?= $totalDiambil; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card bg-warning text-dark shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-clock fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="h3">Pending Transactions</div>
                                        <div class="h1 mb-0"><?= $totalPending; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card bg-info text-white shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-spinner fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="h3">Process Transactions</div>
                                        <div class="h1 mb-0"><?= $totalDicuci; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Transactions Table -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-dark text-white">
                                <h3 class="card-title">Today's Transactions</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id Trx</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Total Harga</th>
                                                <th>Status Trx</th>
                                                <th>Status Bayar</th>
                                                <th>Keluhan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($todaysTransactions as $dt) : ?>
                                                <tr>
                                                    <td><?= $dt['id_transaksi']; ?></td>
                                                    <td><?= $dt['nama']; ?></td>
                                                    <td><?= date("d-m-Y", strtotime($dt['tanggal_masuk'])); ?></td>
                                                    <td><?= date("d-m-Y", strtotime($dt['tanggal_selesai'])); ?></td>
                                                    <td><?= "Rp " . number_format($dt['total_harga'], 2, ',', '.'); ?></td>
                                                    <td><?= ucwords(strtolower($dt['status'])); ?></td>
                                                    <td><?= ucwords(strtolower($dt['status_bayar'])); ?></td>
                                                    <td><?= $dt['keluhan']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php if (empty($todaysTransactions)) : ?>
                                        <div class="text-center">
                                            <p>No transactions for today.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Today's Transactions Table -->
            </div>
        </div>
        <?php include('layout/footer.php'); ?>
    </div>
</div>
<?php include('layout/scriptjs.php'); ?>