<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Barangay Officials</h1>
                <a href="<?= base_url('officials/add') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Official
                </a>
            </div>
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
                        <table class="table table-bordered" id="officialsTable">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Contact</th>
                                    <th>Term Period</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($officials as $official): ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php if ($official['photo']): ?>
                                                <img src="<?= base_url('uploads/officials/' . $official['photo']) ?>" 
                                                     alt="<?= esc($official['first_name']) ?>" 
                                                     class="img-thumbnail" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            <?php else: ?>
                                                <img src="<?= base_url('assets/img/default-profile.jpg') ?>" 
                                                     alt="Default Profile" 
                                                     class="img-thumbnail" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($official['first_name']) . ' ' . esc($official['last_name']) ?></td>
                                        <td><?= esc($official['position']) ?></td>
                                        <td><?= esc($official['contact']) ?></td>
                                        <td>
                                            <?= date('M d, Y', strtotime($official['term_start'])) ?> - 
                                            <?= date('M d, Y', strtotime($official['term_end'])) ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-<?= $official['status'] === 'active' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($official['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('officials/edit/' . $official['id']) ?>" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="confirmDelete(<?= $official['id'] ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this official? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#officialsTable').DataTable({
        "order": [[1, "asc"]],
        "pageLength": 10
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});

function confirmDelete(id) {
    $('#deleteForm').attr('action', '<?= base_url('officials/delete/') ?>' + id);
    $('#deleteModal').modal('show');
}
</script>

<?= $this->endSection() ?> 