<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Official Positions</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addPositionModal">
                            <i class="fas fa-plus"></i> Add Position
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Position Name</th>
                                <th>Description</th>
                                <th>Number of Officials</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Barangay Captain</td>
                                <td>Chief executive of the barangay</td>
                                <td>1</td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Barangay Kagawad</td>
                                <td>Barangay council member</td>
                                <td>7</td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Barangay Secretary</td>
                                <td>Handles barangay documentation</td>
                                <td>1</td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Barangay Treasurer</td>
                                <td>Handles barangay finances</td>
                                <td>1</td>
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

<!-- Add Position Modal -->
<div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog" aria-labelledby="addPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPositionModalLabel">Add New Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="positionName">Position Name</label>
                        <input type="text" class="form-control" id="positionName" required>
                    </div>
                    <div class="form-group">
                        <label for="positionDescription">Description</label>
                        <textarea class="form-control" id="positionDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="numberOfOfficials">Number of Officials</label>
                        <input type="number" class="form-control" id="numberOfOfficials" min="1" value="1" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Position</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
