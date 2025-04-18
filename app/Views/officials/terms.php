<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Official Terms</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="termsTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Term Start</th>
                                    <th>Term End</th>
                                    <th>Status</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($officials as $official): ?>
                                    <tr>
                                        <td><?= esc($official['first_name']) . ' ' . esc($official['last_name']) ?></td>
                                        <td><?= esc($official['position']) ?></td>
                                        <td><?= date('M d, Y', strtotime($official['term_start'])) ?></td>
                                        <td><?= date('M d, Y', strtotime($official['term_end'])) ?></td>
                                        <td>
                                            <span class="badge badge-<?= $official['status'] === 'active' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($official['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $start = new DateTime($official['term_start']);
                                            $end = new DateTime($official['term_end']);
                                            $interval = $start->diff($end);
                                            echo $interval->y . ' years, ' . $interval->m . ' months';
                                            ?>
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
    $('#termsTable').DataTable({
        "order": [[2, "desc"]],
        "pageLength": 25
    });
});
</script>

<?= $this->endSection() ?>
