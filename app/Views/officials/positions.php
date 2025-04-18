<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Official Positions</h1>
        </div>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="positionsTable">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Description</th>
                                    <th>Officials Count</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($positions as $position): ?>
                                    <tr>
                                        <td><?= esc($position['position_name']) ?></td>
                                        <td><?= esc($position['description']) ?></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span><?= $position['current_count'] ?> / <?= $position['max_officials'] ?></span>
                                                <?php 
                                                $percentage = ($position['current_count'] / $position['max_officials']) * 100;
                                                $barClass = $percentage >= 100 ? 'bg-danger' : 
                                                           ($percentage >= 75 ? 'bg-warning' : 'bg-success');
                                                ?>
                                                <div class="progress ml-2" style="width: 100px; height: 10px;">
                                                    <div class="progress-bar <?= $barClass ?>" 
                                                         role="progressbar" 
                                                         style="width: <?= min(100, $percentage) ?>%" 
                                                         aria-valuenow="<?= $position['current_count'] ?>" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="<?= $position['max_officials'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-<?= $position['is_active'] ? 'success' : 'secondary' ?>">
                                                <?= $position['is_active'] ? 'Active' : 'Inactive' ?>
                                            </span>
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

<script>
$(document).ready(function() {
    $('#positionsTable').DataTable({
        "order": [[0, "asc"]],
        "pageLength": 10
    });
});
</script>

<?= $this->endSection() ?>
