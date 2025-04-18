<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<!-- Flash Messages -->
<?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- Budget Summary Card -->
<div class="row">
    <div class="col-md-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>₱<?= number_format(array_sum(array_column($budgets ?? [], 'amount')), 2) ?></h3>
                <p>Total Budget</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= count($budgets ?? []) ?></h3>
                <p>Total Records</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-bar"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= date('Y') ?></h3>
                <p>Current Year</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar"></i>
            </div>
        </div>
    </div>
</div>

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
            <table class="table table-bordered table-striped" id="budgetTable">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
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
            <form id="addBudgetForm" action="<?= site_url('budget/store') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBudgetModalLabel">Add New Budget</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="year">Year</label>
                        <select class="form-control" id="year" name="year" required>
                            <?php for($i = date('Y'); $i <= date('Y') + 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
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
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBudgetModalLabel<?= $budget['id'] ?>">Edit Budget</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_year<?= $budget['id'] ?>">Year</label>
                                <select class="form-control" id="edit_year<?= $budget['id'] ?>" name="year" required>
                                    <?php for($i = date('Y') - 10; $i <= date('Y') + 10; $i++): ?>
                                        <option value="<?= $i ?>" <?= ($i == $budget['year']) ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_amount<?= $budget['id'] ?>">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="number" class="form-control" id="edit_amount<?= $budget['id'] ?>" name="amount" step="0.01" min="0" value="<?= $budget['amount'] ?>" required>
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
                    <form action="<?= site_url('budget/delete/' . $budget['id']) ?>" method="post" class="delete-budget-form">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteBudgetModalLabel<?= $budget['id'] ?>">Delete Budget</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this budget record?</p>
                            <p><strong>Year:</strong> <?= $budget['year'] ?></p>
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

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#budgetTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
    });

    // Handle Add Budget Form Submission
    $('#addBudgetForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        
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
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                Swal.close();
                
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    
                    if (response.data) {
                        $('#budgetTable tbody').html(response.data);
                    }
                    
                    $('#addBudgetModal').modal('hide');
                    $('#addBudgetForm')[0].reset();
                    
                    // Reload the page to update all data
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'An error occurred while saving the budget.'
                    });
                }
            },
            error: function() {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.'
                });
            }
        });
    });

    // Format amount inputs
    $('input[name="amount"]').on('input', function() {
        let value = $(this).val();
        if (value) {
            $(this).val(parseFloat(value).toFixed(2));
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);

    // Handle delete form submission
    $('.delete-budget-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Hide the modal
                    form.closest('.modal').modal('hide');
                    // Show success message
                    $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        response.message +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button></div>')
                        .insertBefore('.card');
                    // Reload the page after a short delay
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    // Show error message
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while processing your request.');
            }
        });
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?> 