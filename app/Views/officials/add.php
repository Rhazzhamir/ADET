<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Official</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('officials/add') ?>" method="post" enctype="multipart/form-data">
                        <?php if (session()->has('errors')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach (session('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?= old('first_name') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?= old('last_name') ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <select class="form-control" id="position" name="position" required>
                                        <option value="">Select Position</option>
                                        <option value="Barangay Captain" <?= old('position') == 'Barangay Captain' ? 'selected' : '' ?>>Barangay Captain</option>
                                        <option value="Barangay Councilor" <?= old('position') == 'Barangay Councilor' ? 'selected' : '' ?>>Barangay Councilor</option>
                                        <option value="Barangay Secretary" <?= old('position') == 'Barangay Secretary' ? 'selected' : '' ?>>Barangay Secretary</option>
                                        <option value="Barangay Treasurer" <?= old('position') == 'Barangay Treasurer' ? 'selected' : '' ?>>Barangay Treasurer</option>
                                        <option value="Barangay Kagawad" <?= old('position') == 'Barangay Kagawad' ? 'selected' : '' ?>>Barangay Kagawad</option>
                                        <option value="SK Chairperson" <?= old('position') == 'SK Chairperson' ? 'selected' : '' ?>>SK Chairperson</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact">Contact Number</label>
                                    <input type="tel" class="form-control" id="contact" name="contact" value="<?= old('contact') ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="term_start">Term Start</label>
                                    <input type="date" class="form-control" id="term_start" name="term_start" value="<?= old('term_start') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="term_end">Term End</label>
                                    <input type="date" class="form-control" id="term_end" name="term_end" value="<?= old('term_end') ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"><?= old('address') ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="photo">Official Photo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photo" name="photo" accept="image/*">
                                        <label class="custom-file-label" for="photo">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Save Official</button>
                                <a href="<?= base_url('officials') ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize custom file input
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>

<?= $this->endSection() ?> 