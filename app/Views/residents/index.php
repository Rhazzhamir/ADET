<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <!-- View Resident Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Resident Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
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
                        Are you sure you want to delete this resident?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Residents List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Residents List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>FirstName</th>
                                <th>MiddleName</th>
                                <th>LastName</th>
                                <th>Phone Number</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($residents) && !empty($residents)): ?>
                                <?php foreach ($residents as $index => $resident): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= esc($resident['FirstName']) ?></td>
                                        <td><?= esc($resident['MiddleName']) ?></td>
                                        <td><?= esc($resident['LastName']) ?></td>
                                        <td><?= esc($resident['Phone_Number']) ?></td>
                                        <td><?= esc($resident['Created_at']) ?></td>
                                        <td><?= esc($resident['Updated_at']) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-info view-resident" data-id="<?= $resident['id'] ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger delete-resident" data-id="<?= $resident['id'] ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No residents found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this before the closing body tag -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize modals
    let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    let viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
    let residentIdToDelete = null;

    // View resident functionality
    document.querySelectorAll('.view-resident').forEach(button => {
        button.addEventListener('click', function() {
            const residentId = this.dataset.id;
            
            // Fetch resident details
            fetch(`<?= base_url('admin/view') ?>/${residentId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update modal with resident data
                    document.getElementById('viewFirstName').textContent = data.data.first_name;
                    document.getElementById('viewMiddleName').textContent = data.data.middle_name || '-';
                    document.getElementById('viewLastName').textContent = data.data.last_name;
                    document.getElementById('viewEmail').textContent = data.data.email;
                    document.getElementById('viewPhone').textContent = data.data.phone;
                    document.getElementById('viewAddress').textContent = data.data.address;
                    document.getElementById('viewCreatedAt').textContent = data.data.created_at;
                    document.getElementById('viewUpdatedAt').textContent = data.data.updated_at;
                    
                    // Show the modal
                    viewModal.show();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while fetching resident details');
            });
        });
    });

    // Delete resident functionality
    document.querySelectorAll('.delete-resident').forEach(button => {
        button.addEventListener('click', function() {
            residentIdToDelete = this.dataset.id;
            deleteModal.show();
        });
    });

    // Handle confirm delete button click
    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (residentIdToDelete) {
            // Send delete request
            fetch(`<?= base_url('admin/delete') ?>/${residentIdToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Remove the row from the table
                    const row = document.querySelector(`button[data-id="${residentIdToDelete}"]`).closest('tr');
                    row.remove();
                    
                    // Show success message
                    alert(data.message);
                } else {
                    // Show error message
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the resident');
            })
            .finally(() => {
                deleteModal.hide();
                residentIdToDelete = null;
            });
        }
    });
});
</script>
<?= $this->endSection() ?> 