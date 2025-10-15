<?php
include('Header.php');
include('../Assets/Connection/Connection.php');

$companyId = $_SESSION['cid']; // company id from session

// Top stats
$jobCount = $Con->query("SELECT COUNT(*) AS c FROM tbl_jobpost WHERE company_id='$companyId'")
                ->fetch_assoc()['c'];

$appCount = $Con->query("SELECT COUNT(*) AS c 
                         FROM tbl_application a 
                         INNER JOIN tbl_jobpost j ON a.jobpost_id=j.jobpost_id 
                         WHERE j.company_id='$companyId'")
                ->fetch_assoc()['c'];
?>

<style>
  /* ====== Background Styling ====== */
  body {
    background: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') 
                no-repeat center center fixed;
    background-size: cover;
    position: relative;
    min-height: 100vh;
  }
  body::before {
    content: "";
    position: absolute;
    top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.55); /* Dark overlay for readability */
    z-index: 0;
  }
  .container, .row, .card {
    position: relative;
    z-index: 1;
  }

  /* ====== Card Styling ====== */
  .card {
    border: none;
    border-radius: 15px;
    backdrop-filter: blur(6px);
    background: rgba(255,255,255,0.9);
    transition: all 0.3s ease-in-out;
  }
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.25);
  }
  .card .card-body i {
    font-size: 28px;
  }

  /* ====== Table Styling ====== */
  .table thead {
    background: #f8f9fa;
    font-weight: 600;
  }
  .table tbody tr:hover {
    background: #f1f4f8;
  }

  /* ====== List Styling ====== */
  .list-group-item {
    border: none;
    padding: 12px 15px;
    font-size: 15px;
    background: rgba(255,255,255,0.7);
  }
  .list-group-item:nth-child(odd) {
    background: rgba(240,240,240,0.8);
  }
</style>

<div class="container py-4">
  <div class="row">
    <!-- Jobs Posted -->
    <div class="col-sm-6 col-xl-3 mb-4">
      <div class="card shadow-sm text-white" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
        <div class="card-body d-flex align-items-center">
          <div class="bg-white text-primary rounded-circle p-3 me-3 shadow-sm">
            <i class="ti ti-briefcase"></i>
          </div>
          <div>
            <h6 class="fw-semibold mb-1">Jobs Posted</h6>
            <h3 class="fw-bold mb-0"><?php echo $jobCount; ?></h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Applications -->
    <div class="col-sm-6 col-xl-3 mb-4">
      <div class="card shadow-sm text-white" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
        <div class="card-body d-flex align-items-center">
          <div class="bg-white text-success rounded-circle p-3 me-3 shadow-sm">
            <i class="ti ti-users"></i>
          </div>
          <div>
            <h6 class="fw-semibold mb-1">Applications</h6>
            <h3 class="fw-bold mb-0"><?php echo $appCount; ?></h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Job Posts -->
  <div class="row mt-4">
    <div class="col-lg-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4 text-primary">
            <i class="ti ti-briefcase me-2"></i>Recent Job Posts
          </h5>
          <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
              <thead class="text-dark fs-6">
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Recruitment</th>
                  <th>Last Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $jobs = $Con->query("SELECT * FROM tbl_jobpost 
                                     WHERE company_id='$companyId' 
                                     ORDER BY jobpost_id DESC LIMIT 5");
                while($row = $jobs->fetch_assoc()) {
                ?>
                <tr>
                  <td><?php echo $row['jobpost_id']; ?></td>
                  <td><span class="fw-semibold"><?php echo $row['jobpost_title']; ?></span></td>
                  <td><?php echo $row['jobpost_recruitment']; ?></td>
                  <td><span class="badge bg-info"><?php echo date("d-m-Y", strtotime($row['jobpost_date'])); ?></span></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Applications + Activities -->
  <div class="row mt-4">
    <!-- Recent Applications -->
    <div class="col-lg-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4 text-success">
            <i class="ti ti-users me-2"></i>Recent Applications
          </h5>
          <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
              <thead class="table-light">
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
                                    WHERE j.company_id='$companyId'
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

    <!-- Recent Activities -->
    <div class="col-lg-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4 text-danger">
            <i class="ti ti-activity me-2"></i>Recent Activities
          </h5>
          <ul class="list-group">
            <?php
            $activities = $Con->query("
              (SELECT CONCAT('Application received for ', j.jobpost_title) AS activity, a.application_date AS dt
               FROM tbl_application a
               INNER JOIN tbl_jobpost j ON a.jobpost_id=j.jobpost_id
               WHERE j.company_id='$companyId')
              UNION
              (SELECT CONCAT('Job post \"', jobpost_title, '\" created') AS activity, jobpost_date AS dt
               FROM tbl_jobpost
               WHERE company_id='$companyId')
              ORDER BY dt DESC LIMIT 5
            ");
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include('Footer.php');
?>
