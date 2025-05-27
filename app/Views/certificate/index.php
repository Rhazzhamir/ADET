<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<div class="card">

    <div class="card-body">
        <table class="table table-bordered table-hover" id="certificateRequestsTable">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Resident Name</th>
                    <th>Certificate Type</th>
                    <th>Purpose</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?= esc($request['id']) ?></td>
                    <td><?= esc($request['resident_name']) ?></td>
                    <td><?= esc(ucwords(str_replace('-', ' ', $request['certificate_type']))) ?></td>
                    <td><?= esc($request['purpose']) ?></td>
                    <td><?= date('M d, Y', strtotime($request['created_at'])) ?></td>
                    <td>
                        <span class="badge badge-<?= $request['status'] === 'pending' ? 'warning' : ($request['status'] === 'approved' ? 'success' : 'danger') ?>">
                            <?= ucfirst($request['status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm" title="View" onclick="viewCertificateRequest(<?= $request['id'] ?>); return false;"><i class="fas fa-eye"></i></a>
                        <?php if ($request['status'] === 'pending'): ?>
                            <a href="#" class="btn btn-success btn-sm" title="Approve" onclick="approveCertificateRequest(<?= $request['id'] ?>); return false;"><i class="fas fa-check"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Reject"><i class="fas fa-times"></i></a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for viewing certificate request details -->
<div class="modal fade" id="viewCertificateModal" tabindex="-1" aria-labelledby="viewCertificateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewCertificateModalLabel">Certificate Request Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="certificateDetailsBody">
        <!-- Details will be loaded here -->
        <div class="text-center text-muted"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
      </div>
    </div>
  </div>
</div>

<script>
function viewCertificateRequest(requestId) {
    // Show modal
    var modal = new bootstrap.Modal(document.getElementById('viewCertificateModal'));
    document.getElementById('certificateDetailsBody').innerHTML = '<div class="text-center text-muted"><i class="fas fa-spinner fa-spin"></i> Loading...</div>';
    modal.show();
    // Fetch details via AJAX
    fetch('<?= base_url('certificate/view/') ?>' + requestId, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let statusColor =
                data.request.status === 'pending' ? 'warning' :
                data.request.status === 'approved' ? 'success' :
                data.request.status === 'rejected' ? 'danger' : 'secondary';
            let html = `
            <div class='d-flex flex-column align-items-center justify-content-center mb-4'>
                <div style="background: #181c24; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.12); padding: 24px 32px 16px 32px; width: 100%; max-width: 340px; margin-bottom: 16px;">
                    <img src='${data.request.profile_picture_url}' alt='Resident Image' class='rounded-circle mb-2' style='width:100px;height:100px;object-fit:cover;border:3px solid #0d6efd;'>
                    <div class='mt-2 fw-bold fs-5 text-center' style='color:#fff;'>${data.request.resident_name}</div>
                </div>
            </div>
            <div class='container-fluid'>
                <div class='row g-3'>
                    <div class='col-12 col-md-6'>
                        <div class='d-flex align-items-center mb-2'><i class='fas fa-hashtag me-2 text-primary'></i><span class='fw-bold'>Request ID:</span> <span class='ms-auto'>${data.request.id}</span></div>
                        <div class='d-flex align-items-center mb-2'><i class='fas fa-file-alt me-2 text-info'></i><span class='fw-bold'>Certificate Type:</span> <span class='ms-auto'>${data.request.certificate_type}</span></div>
                        <div class='d-flex align-items-center mb-2'><i class='fas fa-copy me-2 text-secondary'></i><span class='fw-bold'>Number of Copies:</span> <span class='ms-auto'>${data.request.number_of_copies}</span></div>
                    </div>
                    <div class='col-12 col-md-6'>
                        <div class='d-flex align-items-center mb-2'><i class='fas fa-calendar-alt me-2 text-success'></i><span class='fw-bold'>Date Requested:</span> <span class='ms-auto'>${data.request.created_at}</span></div>
                        <div class='d-flex align-items-center mb-2'><i class='fas fa-info-circle me-2 text-warning'></i><span class='fw-bold'>Status:</span> <span class='ms-auto'><span class='badge bg-${statusColor} text-uppercase'>${data.request.status}</span></span></div>
                        <div class='d-flex align-items-center mb-2'><i class='fas fa-align-left me-2 text-muted'></i><span class='fw-bold'>Purpose:</span> <span class='ms-auto'>${data.request.purpose}</span></div>
                    </div>
                </div>
            </div>`;
            document.getElementById('certificateDetailsBody').innerHTML = html;
        } else {
            document.getElementById('certificateDetailsBody').innerHTML = '<div class="alert alert-danger">'+data.message+'</div>';
        }
    })
    .catch(() => {
        document.getElementById('certificateDetailsBody').innerHTML = '<div class="alert alert-danger">Failed to load details.</div>';
    });
}

function approveCertificateRequest(requestId) {
    if (!confirm('Are you sure you want to approve this certificate request?')) return;
    fetch('<?= base_url('certificate/approve/') ?>' + requestId, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(() => {
        alert('Failed to approve the request.');
    });
}

$(document).ready(function() {
    $('#certificateRequestsTable').DataTable();
});
</script>
<?= $this->endSection() ?> 