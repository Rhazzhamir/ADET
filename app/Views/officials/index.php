<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Barangay Officials</h3>
                    <div class="card-tools">
                        <a href="<?= base_url('officials/add') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Official
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Contact Number</th>
                                <th>Term Start</th>
                                <th>Term End</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>Barangay Captain</td>
                                <td>09123456789</td>
                                <td>2023-01-01</td>
                                <td>2025-12-31</td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 