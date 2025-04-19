<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Official</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('officials/store') ?>" method="post" enctype="multipart/form-data" id="officialForm">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('first_name')) ? 'is-invalid' : '' ?>" 
                                    id="first_name" name="first_name" value="<?= old('first_name') ?>" required>
                                <?php if (isset($validation) && $validation->hasError('first_name')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('first_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" 
                                    value="<?= old('middle_name') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('last_name')) ? 'is-invalid' : '' ?>" 
                                    id="last_name" name="last_name" value="<?= old('last_name') ?>" required>
                                <?php if (isset($validation) && $validation->hasError('last_name')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('last_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('position')) ? 'is-invalid' : '' ?>" 
                                    id="position" name="position" value="<?= old('position') ?>" required>
                                <?php if (isset($validation) && $validation->hasError('position')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('position') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="term">Term <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('term')) ? 'is-invalid' : '' ?>" 
                                    id="term" name="term" value="<?= old('term') ?>" required>
                                <?php if (isset($validation) && $validation->hasError('term')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('term') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                                    id="email" name="email" value="<?= old('email') ?>">
                                <?php if (isset($validation) && $validation->hasError('email')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('phone_number')) ? 'is-invalid' : '' ?>" 
                                    id="phone_number" name="phone_number" value="<?= old('phone_number') ?>">
                                <?php if (isset($validation) && $validation->hasError('phone_number')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('phone_number') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control <?= (isset($validation) && $validation->hasError('address')) ? 'is-invalid' : '' ?>" 
                                    id="address" name="address" rows="3"><?= old('address') ?></textarea>
                                <?php if (isset($validation) && $validation->hasError('address')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('address') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="image">Profile Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?= (isset($validation) && $validation->hasError('image')) ? 'is-invalid' : '' ?>" 
                                        id="image" name="image" accept="image/*">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    <?php if (isset($validation) && $validation->hasError('image')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('image') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <small class="form-text text-muted">Recommended size: 300x300 pixels. Max file size: 2MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Official</button>
                            <a href="<?= base_url('officials') ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('officialForm');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // File input label
    const fileInput = document.querySelector('.custom-file-input');
    fileInput.addEventListener('change', function() {
        const fileName = this.files[0]?.name || 'Choose file';
        this.nextElementSibling.textContent = fileName;
    });
});
</script>
<?= $this->endSection() ?> 