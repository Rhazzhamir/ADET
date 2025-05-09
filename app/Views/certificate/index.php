<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Certificate Requests</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="certificateRequestsTable">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Resident Name</th>
                    <th>Certificate Type</th>
                    <th>Purpose</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?= esc($request['id']) ?></td>
                    <td><?= esc($request['resident_name']) ?></td>
                    <td><?= esc(ucwords(str_replace('-', ' ', $request['certificate_type']))) ?></td>
                    <td><?= esc($request['purpose']) ?></td>
                    <td><?= date('M d, Y', strtotime($request['created_at'])) ?></td>
                    <td>
                        <span class="badge badge-<?= $request['status'] === 'pending' ? 'warning' : ($request['status'] === 'approved' ? 'success' : 'danger') ?>">
                            <?= ucfirst($request['status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                        <?php if ($request['status'] === 'pending'): ?>
                            <a href="#" class="btn btn-success btn-sm" title="Approve"><i class="fas fa-check"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Reject"><i class="fas fa-times"></i></a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#certificateRequestsTable').DataTable();
});
</script>
<?= $this->endSection() ?> 