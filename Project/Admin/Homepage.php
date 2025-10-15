<?php
include('Header.php');
include('../Assets/Connection/Connection.php');

// Fetch counts
$userCount      = $Con->query("SELECT COUNT(*) as c FROM tbl_user")->fetch_assoc()['c'];
$companyCount   = $Con->query("SELECT COUNT(*) as c FROM tbl_company")->fetch_assoc()['c'];
$jobCount       = $Con->query("SELECT COUNT(*) as c FROM tbl_jobpost")->fetch_assoc()['c'];
$appCount       = $Con->query("SELECT COUNT(*) as c FROM tbl_application")->fetch_assoc()['c'];
?>

<div class="row">
  <!-- Users -->
  <div class="col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="bg-primary text-white rounded-circle p-3 me-3">
          <i class="ti ti-users fs-4"></i>
        </div>
        <div>
          <h6 class="fw-semibold mb-1">Total Users</h6>
          <h4 class="fw-bold mb-0"><?php echo $userCount; ?></h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Companies -->
  <div class="col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="bg-success text-white rounded-circle p-3 me-3">
          <i class="ti ti-building fs-4"></i>
        </div>
        <div>
          <h6 class="fw-semibold mb-1">Total Companies</h6>
          <h4 class="fw-bold mb-0"><?php echo $companyCount; ?></h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Jobs -->
  <div class="col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="bg-warning text-white rounded-circle p-3 me-3">
          <i class="ti ti-briefcase fs-4"></i>
        </div>
        <div>
          <h6 class="fw-semibold mb-1">Total Jobs</h6>
          <h4 class="fw-bold mb-0"><?php echo $jobCount; ?></h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Applications -->
  <div class="col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm p-3">
      <div class="d-flex align-items-center">
        <div class="bg-danger text-white rounded-circle p-3 me-3">
          <i class="ti ti-file-text fs-4"></i>
        </div>
        <div>
          <h6 class="fw-semibold mb-1">Total Applications</h6>
          <h4 class="fw-bold mb-0"><?php echo $appCount; ?></h4>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Recent Jobs -->
<div class="col-lg-12 mt-4">
  <div class="card w-100">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Recent Job Posts</h5>
      <div class="row">
        <?php
        $jobs = $Con->query("SELECT j.*, c.company_name 
                             FROM tbl_jobpost j
                             INNER JOIN tbl_company c ON j.company_id=c.company_id
                             ORDER BY j.jobpost_id DESC LIMIT 4");
        while($row = $jobs->fetch_assoc()) {
        ?>
        <div class="col-sm-6 col-xl-3">
          <div class="card overflow-hidden rounded-2">
            <div class="card-body pt-3 p-4">
              <h6 class="fw-semibold fs-5"><?php echo $row['jobpost_title']; ?></h6>
              <p class="mb-1">Company: <?php echo $row['company_name']; ?></p>
              <p class="mb-1">Experience: <?php echo $row['jobpost_experience']; ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <!-- <h6 class="fw-semibold fs-6 mb-0">Salary: <?php echo $row['jobpost_salary']; ?></h6> -->
                <span class="badge bg-primary">
                  Posted: <?php echo date("d-m-Y", strtotime($row['jobpost_date'])); ?>
                </span>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <!-- Recent Applications -->
  <div class="col-lg-6">
    <div class="card w-100">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Recent Applications</h5>
        <div class="table-responsive">
          <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Job</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $qry = $Con->query("SELECT a.*, u.user_name, j.jobpost_title 
                                  FROM tbl_application a
                                  INNER JOIN tbl_user u ON a.user_id=u.user_id
                                  INNER JOIN tbl_jobpost j ON a.jobpost_id=j.jobpost_id
                                  ORDER BY a.application_id DESC LIMIT 5");
              while($r = $qry->fetch_assoc()) {
                $status = ($r['application_status']==1) ? 'Accepted' :
                          (($r['application_status']==2) ? 'Rejected' : 'Pending');
              ?>
              <tr>
                <td><?php echo $r['application_id']; ?></td>
                <td><?php echo $r['user_name']; ?></td>
                <td><?php echo $r['jobpost_title']; ?></td>
                <td>
                  <span class="badge bg-<?php echo ($status=='Accepted')?'success':(($status=='Rejected')?'danger':'warning'); ?>">
                    <?php echo $status; ?>
                  </span>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Latest Complaints -->
  <div class="col-lg-6">
    <div class="card w-100">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Latest Complaints</h5>
        <div class="table-responsive">
          <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $complaints = $Con->query("SELECT c.*, u.user_name 
                                         FROM tbl_complaint c 
                                         INNER JOIN tbl_user u ON c.user_id=u.user_id 
                                         ORDER BY complaint_id DESC LIMIT 5");
              while($c = $complaints->fetch_assoc()) {
                $cstatus = ($c['complaint_status']==0) ? "Pending" : "Resolved";
              ?>
              <tr>
                <td><?php echo $c['complaint_id']; ?></td>
                <td><?php echo $c['user_name']; ?></td>
                <td><?php echo $c['complaint_title']; ?></td>
                <td>
                  <span class="badge bg-<?php echo ($cstatus=='Pending')?'warning':'success'; ?>">
                    <?php echo $cstatus; ?>
                  </span>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include('Footer.php');
?>
