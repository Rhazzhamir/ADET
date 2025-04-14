<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Resident</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Profile picture upload section -->
            <div class="col-md-4">
                <?= $this->include('partials/profile_picture_upload') ?>
            </div>
            
            <!-- Resident details form -->
            <div class="col-md-8">
                <form action="<?= base_url('admin/update') ?>" method="post">
                    <input type="hidden" name="id" value="<?= isset($resident['id']) ? $resident['id'] : '' ?>">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" value="<?= isset($resident['first_name']) ? $resident['first_name'] : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="<?= isset($resident['last_name']) ? $resident['last_name'] : '' ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" value="<?= isset($resident['middle_name']) ? $resident['middle_name'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Birth Date</label>
                                <input type="date" class="form-control" name="birth_date" value="<?= isset($resident['birth_date']) ? $resident['birth_date'] : '' ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" <?= (isset($resident['gender']) && $resident['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                                    <option value="female" <?= (isset($resident['gender']) && $resident['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Civil Status</label>
                                <select class="form-control" name="civil_status" required>
                                    <option value="">Select Status</option>
                                    <option value="single" <?= (isset($resident['civil_status']) && $resident['civil_status'] == 'single') ? 'selected' : '' ?>>Single</option>
                                    <option value="married" <?= (isset($resident['civil_status']) && $resident['civil_status'] == 'married') ? 'selected' : '' ?>>Married</option>
                                    <option value="widowed" <?= (isset($resident['civil_status']) && $resident['civil_status'] == 'widowed') ? 'selected' : '' ?>>Widowed</option>
                                    <option value="separated" <?= (isset($resident['civil_status']) && $resident['civil_status'] == 'separated') ? 'selected' : '' ?>>Separated</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address" rows="3" required><?= isset($resident['address']) ? $resident['address'] : '' ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact" value="<?= isset($resident['contact']) ? $resident['contact'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?= isset($resident['email']) ? $resident['email'] : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Household</label>
                        <select class="form-control" name="household_id" required>
                            <option value="">Select Household</option>
                            <?php if(isset($households)): ?>
                                <?php foreach($households as $household): ?>
                                    <option value="<?= $household['id'] ?>" <?= (isset($resident['household_id']) && $resident['household_id'] == $household['id']) ? 'selected' : '' ?>>
                                        <?= $household['household_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="<?= base_url('admin') ?>" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 