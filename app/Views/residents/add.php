<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add New Resident</h3>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/save') ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="middle_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Birth Date</label>
                        <input type="date" class="form-control" name="birth_date" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Civil Status</label>
                        <select class="form-control" name="civil_status" required>
                            <option value="">Select Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="separated">Separated</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name="address" rows="3" required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control" name="contact">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Household</label>
                <select class="form-control" name="household_id" required>
                    <option value="">Select Household</option>
                    <!-- Household options will be populated dynamically -->
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Resident</button>
                <a href="<?= base_url('admin') ?>" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?> 