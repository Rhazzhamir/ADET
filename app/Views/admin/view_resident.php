<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Resident Details</h3>
                    
                </div>
                <div class="card-body">
                    <div id="resident-details">
                        <!-- Resident details will be loaded here via JavaScript -->
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const residentId = <?= $residentId ?>;
    
    fetch(`<?= base_url('admin/view') ?>/${residentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const resident = data.data;
                const detailsHtml = `
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th width="30%">Name:</th>
                                    <td>${resident.name}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>${resident.address}</td>
                                </tr>
                                <tr>
                                    <th>Contact Number:</th>
                                    <td>${resident.contact_number}</td>
                                </tr>
                                <tr>
                                    <th>Age:</th>
                                    <td>${resident.age}</td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td>${resident.gender}</td>
                                </tr>
                                <tr>
                                    <th>Civil Status:</th>
                                    <td>${resident.civil_status}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                `;
                document.getElementById('resident-details').innerHTML = detailsHtml;
            } else {
                document.getElementById('resident-details').innerHTML = `
                    <div class="alert alert-danger">
                        ${data.message || 'Error loading resident details'}
                    </div>
                `;
            }
        })
        .catch(error => {
            document.getElementById('resident-details').innerHTML = `
                <div class="alert alert-danger">
                    Error loading resident details. Please try again later.
                </div>
            `;
            console.error('Error:', error);
        });
});
</script>
<?= $this->endSection() ?> 