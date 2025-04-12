<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Households</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addHouseholdModal">
                <i class="fas fa-plus"></i> Add Household
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Household ID</th>
                    <th>Head of Family</th>
                    <th>Address</th>
                    <th>Members</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">No households found</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Household Modal -->
<div class="modal fade" id="addHouseholdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Household</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('residents/saveHousehold') ?>" method="post">
                    <div class="form-group">
                        <label>Household Number</label>
                        <input type="text" class="form-control" name="household_number" required>
                    </div>
                    <div class="form-group">
                        <label>Head of Family</label>
                        <input type="text" class="form-control" name="head_of_family" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control" name="contact">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Household</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 