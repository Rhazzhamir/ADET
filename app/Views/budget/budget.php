<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<style>
/* Dark mode input styles */
.dark-mode input[type="number"],
.dark-mode select {
    background-color: #454d55 !important;
    color: #fff !important;
    border-color: #6c757d !important;
}

.dark-mode .input-group-text {
    background-color: #3f474e !important;
    color: #fff !important;
    border-color: #6c757d !important;
}

/* Year input specific styles */
input[type="number"].year-input {
    width: 100%;
    padding: 0.375rem 0.75rem;
}
</style>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Budget Management</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBudgetModal">
                <i class="fas fa-plus"></i> Add New Budget
                    </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="budgetTableBody">
                    <?php if (isset($budgets) && !empty($budgets)) : ?>
                        <?php foreach ($budgets as $budget) : ?>
                            <tr>
                                <td><?= esc($budget['year']) ?></td>
                                <td>₱<?= number_format($budget['amount'], 2) ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editBudgetModal<?= $budget['id'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteBudgetModal<?= $budget['id'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center">No budget records found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Budget Modal -->
<div class="modal fade" id="addBudgetModal" tabindex="-1" role="dialog" aria-labelledby="addBudgetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addBudgetForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBudgetModalLabel">Add New Budget</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" class="form-control year-input" id="year" name="year" 
                               min="2000" max="2099" step="1" value="<?= date('Y') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Budget</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (isset($budgets) && !empty($budgets)) : ?>
    <?php foreach ($budgets as $budget) : ?>
        <!-- Edit Budget Modal -->
        <div class="modal fade" id="editBudgetModal<?= $budget['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editBudgetModalLabel<?= $budget['id'] ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= site_url('budget/update/' . $budget['id']) ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBudgetModalLabel<?= $budget['id'] ?>">Edit Budget</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_year<?= $budget['id'] ?>">Year</label>
                                <input type="number" class="form-control year-input" id="edit_year<?= $budget['id'] ?>" 
                                       name="year" min="2000" max="2099" step="1" 
                                       value="<?= date('Y', strtotime($budget['date'])) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_amount<?= $budget['id'] ?>">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="number" class="form-control" id="edit_amount<?= $budget['id'] ?>" 
                                           name="amount" step="0.01" min="0" value="<?= $budget['amount'] ?>" required>
                </div>
            </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Budget</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Budget Modal -->
        <div class="modal fade" id="deleteBudgetModal<?= $budget['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBudgetModalLabel<?= $budget['id'] ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= site_url('budget/delete/' . $budget['id']) ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteBudgetModalLabel<?= $budget['id'] ?>">Delete Budget</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this budget record?</p>
                            <p><strong>Year:</strong> <?= date('Y', strtotime($budget['date'])) ?></p>
                            <p><strong>Amount:</strong> ₱<?= number_format($budget['amount'], 2) ?></p>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<script>
$(document).ready(function() {
    // Debug: Log when document is ready
    console.log('Budget management page initialized');

    // Handle Add Budget Form Submission
    $('#addBudgetForm').on('submit', function(e) {
        e.preventDefault();
        
        // Debug: Log form data
        const formData = $(this).serialize();
        console.log('Submitting budget form with data:', formData);
        
        // Show loading state
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait while we save your data.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Debug: Log AJAX request
        console.log('Sending AJAX request to:', '<?= site_url('budget/add') ?>');
        
        $.ajax({
            url: '<?= site_url('budget/add') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Debug: Log response
                console.log('Received response:', response);
                
                // Close loading state
                Swal.close();
                
                if (response.status === 'success') {
                    // Debug: Log success
                    console.log('Budget added successfully');
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    
                    // Update the table body with new data
                    if (response.data) {
                        console.log('Updating table with new data');
                        $('#budgetTableBody').html(response.data);
                    }
                    
                    // Close the modal
                    $('#addBudgetModal').modal('hide');
                    
                    // Reset the form
                    $('#addBudgetForm')[0].reset();
                    
                    // Reload the page to update the modals
                    console.log('Reloading page in 1.5 seconds');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    // Debug: Log error
                    console.error('Error adding budget:', response.message);
                    
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'An error occurred while saving the budget.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            },
            error: function(xhr, status, error) {
                // Debug: Log error details
                console.error('AJAX Error:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                
                // Close loading state
                Swal.close();
                
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to add budget. Please try again.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    });

    // Debug: Log when modals are opened
    $('#addBudgetModal').on('show.bs.modal', function () {
        console.log('Add Budget modal is opening');
    });

    // Debug: Track form input changes
    $('#year, #amount').on('change', function() {
        console.log('Form field changed:', this.id, 'New value:', this.value);
    });
});
</script>
<?= $this->endSection() ?> 