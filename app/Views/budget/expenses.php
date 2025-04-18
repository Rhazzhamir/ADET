<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<!-- Summary Cards -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>₱<?= number_format($totalBudget, 2) ?></h3>
                <p>Total Expenses</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Expense Records</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addExpenseModal">
                <i class="fas fa-plus"></i> Add Expense
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="expensesTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($expenses) && !empty($expenses)) : ?>
                    <?php foreach ($expenses as $expense) : ?>
                        <tr>
                            <td><?= date('M d, Y', strtotime($expense['date'])) ?></td>
                            <td><?= ucfirst($expense['category']) ?></td>
                            <td>₱<?= number_format($expense['amount'], 2) ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editExpenseModal<?= $expense['id'] ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteExpenseModal<?= $expense['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">No expense records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= site_url('expenses/add') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Add New Expense</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="utilities">Utilities</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="salaries">Salaries</option>
                            <option value="supplies">Supplies</option>
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
                    <button type="submit" class="btn btn-primary">Save Expense</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (isset($expenses) && !empty($expenses)) : ?>
    <?php foreach ($expenses as $expense) : ?>
        <!-- Edit Expense Modal -->
        <div class="modal fade" id="editExpenseModal<?= $expense['id'] ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= site_url('expenses/update/' . $expense['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Expense</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_date<?= $expense['id'] ?>">Date</label>
                                <input type="date" class="form-control" id="edit_date<?= $expense['id'] ?>" 
                                       name="date" value="<?= $expense['date'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_category<?= $expense['id'] ?>">Category</label>
                                <select class="form-control" id="edit_category<?= $expense['id'] ?>" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="utilities" <?= $expense['category'] == 'utilities' ? 'selected' : '' ?>>Utilities</option>
                                    <option value="maintenance" <?= $expense['category'] == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                                    <option value="salaries" <?= $expense['category'] == 'salaries' ? 'selected' : '' ?>>Salaries</option>
                                    <option value="supplies" <?= $expense['category'] == 'supplies' ? 'selected' : '' ?>>Supplies</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_amount<?= $expense['id'] ?>">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="number" class="form-control" id="edit_amount<?= $expense['id'] ?>" 
                                           name="amount" step="0.01" min="0" value="<?= $expense['amount'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Expense Modal -->
        <div class="modal fade" id="deleteExpenseModal<?= $expense['id'] ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= site_url('expenses/delete/' . $expense['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Expense</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this expense?</p>
                            <p><strong>Date:</strong> <?= date('M d, Y', strtotime($expense['date'])) ?></p>
                            <p><strong>Category:</strong> <?= ucfirst($expense['category']) ?></p>
                            <p><strong>Amount:</strong> ₱<?= number_format($expense['amount'], 2) ?></p>
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
    $('#expensesTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);

    // Format amount inputs
    $('input[name="amount"]').on('input', function() {
        let value = $(this).val();
        if (value) {
            $(this).val(parseFloat(value).toFixed(2));
        }
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?> 