<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <!-- View Official Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Official Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center mb-4">
                                <div id="viewImage" class="mb-3" style="width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                    <img src="" alt="Official Image" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><strong>First Name:</strong></p>
                                <p id="viewFirstName"></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Middle Name:</strong></p>
                                <p id="viewMiddleName"></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Last Name:</strong></p>
                                <p id="viewLastName"></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p><strong>Position:</strong></p>
                                <p id="viewPosition"></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Term:</strong></p>
                                <p id="viewTerm"></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p><strong>Email:</strong></p>
                                <p id="viewEmail"></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Phone:</strong></p>
                                <p id="viewPhone"></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <p><strong>Address:</strong></p>
                                <p id="viewAddress"></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p><strong>Created At:</strong></p>
                                <p id="viewCreatedAt"></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Updated At:</strong></p>
                                <p id="viewUpdatedAt"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this official?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Officials List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Officials List</h3>
                <div class="card-tools">
                    <a href="<?= base_url('officials/add') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Official
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="officialsTable">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 80px">Image</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Term</th>
                                <th>Phone Number</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($officials) && !empty($officials)): ?>
                                <?php foreach ($officials as $index => $official): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td class="text-center">
                                            <div style="width: 50px; height: 50px; margin: 0 auto; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <?php if (!empty($official['image']) && file_exists(FCPATH . 'uploads/officials/' . $official['image'])): ?>
                                                    <img src="<?= base_url('uploads/officials/' . $official['image']) ?>" 
                                                         alt="<?= esc($official['first_name']) ?>'s photo"
                                                         style="width: 100%; height: 100%; object-fit: cover;"
                                                         onerror="this.onerror=null; this.src='<?= base_url('assets/img/default-profile.jpg') ?>'; this.parentElement.innerHTML='<i class=\'fas fa-user text-secondary\'></i>';">
                                                <?php else: ?>
                                                    <i class="fas fa-user text-secondary"></i>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td><?= esc($official['first_name'] . ' ' . ($official['middle_name'] ? $official['middle_name'] . ' ' : '') . $official['last_name']) ?></td>
                                        <td><?= esc($official['position']) ?></td>
                                        <td><?= esc($official['term']) ?></td>
                                        <td><?= esc($official['phone_number']) ?></td>
                                        <td><?= esc($official['created_at']) ?></td>
                                        <td><?= esc($official['updated_at']) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-info view-official" 
                                                        data-id="<?= $official['id'] ?>"
                                                        data-image="<?= !empty($official['image']) ? base_url('uploads/officials/' . $official['image']) : '' ?>"
                                                        data-firstname="<?= esc($official['first_name']) ?>"
                                                        data-middlename="<?= esc($official['middle_name']) ?>"
                                                        data-lastname="<?= esc($official['last_name']) ?>"
                                                        data-position="<?= esc($official['position']) ?>"
                                                        data-term="<?= esc($official['term']) ?>"
                                                        data-email="<?= esc($official['email']) ?>"
                                                        data-phone="<?= esc($official['phone_number']) ?>"
                                                        data-address="<?= esc($official['address']) ?>"
                                                        data-created="<?= esc($official['created_at']) ?>"
                                                        data-updated="<?= esc($official['updated_at']) ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="<?= base_url('officials/edit/' . $official['id']) ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger delete-official" data-id="<?= $official['id'] ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">No officials found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize DataTable
    if (!$.fn.DataTable.isDataTable('#officialsTable')) {
        $('#officialsTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    }

    // View official functionality
    document.querySelectorAll('.view-official').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('viewModal');
            
            // Set the image
            const imageUrl = this.dataset.image;
            const imageContainer = modal.querySelector('#viewImage');
            if (imageUrl) {
                imageContainer.innerHTML = `<img src="${imageUrl}" alt="Official Image" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'fas fa-user text-secondary\'></i>';">`;
            } else {
                imageContainer.innerHTML = '<i class="fas fa-user text-secondary"></i>';
            }
            
            // Set other fields
            modal.querySelector('#viewFirstName').textContent = this.dataset.firstname;
            modal.querySelector('#viewMiddleName').textContent = this.dataset.middlename || '-';
            modal.querySelector('#viewLastName').textContent = this.dataset.lastname;
            modal.querySelector('#viewPosition').textContent = this.dataset.position;
            modal.querySelector('#viewTerm').textContent = this.dataset.term;
            modal.querySelector('#viewEmail').textContent = this.dataset.email || '-';
            modal.querySelector('#viewPhone').textContent = this.dataset.phone || '-';
            modal.querySelector('#viewAddress').textContent = this.dataset.address || '-';
            modal.querySelector('#viewCreatedAt').textContent = this.dataset.created;
            modal.querySelector('#viewUpdatedAt').textContent = this.dataset.updated;
            
            // Show the modal
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
        });
    });

    // Delete official functionality
    let officialIdToDelete = null;
    
    document.querySelectorAll('.delete-official').forEach(button => {
        button.addEventListener('click', function() {
            officialIdToDelete = this.dataset.id;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        });
    });

    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (officialIdToDelete) {
            fetch(`<?= base_url('officials/delete/') ?>/${officialIdToDelete}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    alert('Failed to delete official');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the official');
            });
        }
    });
});
</script>

<style>
.table td {
    vertical-align: middle;
}
</style>
<?= $this->endSection() ?> 