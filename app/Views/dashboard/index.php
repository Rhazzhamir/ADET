<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <!-- Budget Overview -->
        <div class="row">
            <div class="col-lg-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>₱<?= number_format($total_budget, 2) ?></h3>
                        <p>Total Budget</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <a href="<?= site_url('budget') ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>₱<?= number_format($total_expenses, 2) ?></h3>
                        <p>Total Expenses</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <a href="<?= site_url('expenses') ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="small-box <?= isset($remaining_balance) && $remaining_balance < 0 ? 'bg-danger' : 'bg-success' ?>">
                    <div class="inner">
                        <h3>₱<?= isset($remaining_balance) ? number_format($remaining_balance, 2) : '0.00' ?></h3>
                        <p>Remaining Balance</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <a href="<?= site_url('budget') ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Residents Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-users mr-1"></i>
                            Resident Records
                        </h3>
                        <div class="card-tools">
                            <a href="<?= site_url('admin/residents') ?>" class="btn btn-tool">
                                <i class="fas fa-list"></i> View All
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Residents</span>
                                        <span class="info-box-number"><?= $total_residents ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-success"><i class="fas fa-home"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Households</span>
                                        <span class="info-box-number"><?= $total_households ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Recent Registrations</th>
                                        <th>Date Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($recent_residents) && !empty($recent_residents)): ?>
                                        <?php foreach ($recent_residents as $resident): ?>
                                            <tr>
                                                <td><?= esc($resident['full_name']) ?></td>
                                                <td><?= date('M d, Y', strtotime($resident['created_at'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="2" class="text-center">No recent registrations</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history mr-1"></i>
                            Recent Activities
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <?php if (isset($recent_residents) && !empty($recent_residents)): ?>
                                <div class="time-label">
                                    <span class="bg-info">Recent Activities</span>
                                </div>
                                <?php foreach ($recent_residents as $resident): ?>
                                <div>
                                    <i class="fas fa-user bg-primary"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?= date('H:i', strtotime($resident['created_at'])) ?></span>
                                        <h3 class="timeline-header">New Resident Registration</h3>
                                        <div class="timeline-body">
                                            <?= esc($resident['full_name']) ?> has been registered as a new resident.
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="time-label">
                                    <span class="bg-info">No Recent Activities</span>
                                </div>
                                <div>
                                    <i class="fas fa-info bg-info"></i>
                                    <div class="timeline-item">
                                        <div class="timeline-body">
                                            No recent activities to display.
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 