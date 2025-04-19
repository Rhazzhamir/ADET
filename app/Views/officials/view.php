<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Official Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="profile-image" style="width: 150px; height: 150px; margin: 0 auto; background-color: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                <?php if ($official['image']): ?>
                                    <img src="<?= base_url('uploads/officials/' . $official['image']) ?>" 
                                        alt="<?= $official['first_name'] . ' ' . $official['last_name'] ?>" 
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <i class="fas fa-user fa-4x text-muted"></i>
                                <?php endif; ?>
                            </div>
                            <h4 class="mt-3"><?= $official['first_name'] . ' ' . ($official['middle_name'] ? $official['middle_name'] . ' ' : '') . $official['last_name'] ?></h4>
                            <h5 class="text-muted"><?= $official['position'] ?></h5>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%">Term</th>
                                    <td><?= $official['term'] ?></td>
                                </tr>
                                <?php if ($official['email']): ?>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $official['email'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if ($official['phone_number']): ?>
                                <tr>
                                    <th>Phone Number</th>
                                    <td><?= $official['phone_number'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if ($official['address']): ?>
                                <tr>
                                    <th>Address</th>
                                    <td><?= $official['address'] ?></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            <a href="<?= base_url('officials/edit/' . $official['id']) ?>" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                            <a href="<?= base_url('officials') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Additional Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Contact Information</h5>
                                <p>
                                    <?php if ($official['email']): ?>
                                        <i class="fas fa-envelope"></i> <?= $official['email'] ?><br>
                                    <?php endif; ?>
                                    <?php if ($official['phone_number']): ?>
                                        <i class="fas fa-phone"></i> <?= $official['phone_number'] ?><br>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5>Position Details</h5>
                                <p>
                                    <strong>Position:</strong> <?= $official['position'] ?><br>
                                    <strong>Term:</strong> <?= $official['term'] ?>
                                </p>
                            </div>
                        </div>
                        
                        <?php if ($official['address']): ?>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Address</h5>
                                <p><i class="fas fa-map-marker-alt"></i> <?= $official['address'] ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-image {
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
.table th {
    background-color: #f8f9fa;
}
</style>
<?= $this->endSection() ?> 