<?php
include("../Connection/Connection.php");

$type = $_GET['type'] ?? "";
$category = $_GET['category'] ?? "";
$keyword = $_GET['keyword'] ?? "";

$selQry = "SELECT * FROM tbl_jobpost p 
           INNER JOIN tbl_jobtype t ON p.jobtype_id = t.jobtype_id 
           INNER JOIN tbl_category c ON p.category_id = c.category_id 
           WHERE jobpost_status = 0";

if ($type != "") {
    $selQry .= " AND p.jobtype_id = '$type'";
}
if ($category != "") {
    $selQry .= " AND p.category_id = '$category'";
}
if ($keyword != "") {
    $selQry .= " AND (
                    p.jobpost_title LIKE '%$keyword%' OR 
                    p.jobpost_content LIKE '%$keyword%' OR 
                    p.jobpost_experience LIKE '%$keyword%'
                )";
}

$selQry .= " ORDER BY jobpost_date ASC";

$row = $Con->query($selQry);
$i = 0;

if ($row->num_rows > 0) {
    while ($data = $row->fetch_assoc()) {
        $i++;
        $currentDate = date('Y-m-d');
        $lastDate = $data['jobpost_lastdate'];
        $applicationDisabled = ($currentDate > $lastDate);
        ?>
        
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo $data['jobpost_title']; ?></h5>
                    <p class="card-text text-muted mb-2">
                        <?php echo $data['jobpost_content']; ?>
                    </p>
                    <ul class="list-unstyled small mb-3">
                        <li><strong>Experience:</strong> <?php echo $data['jobpost_experience']; ?></li>
                        <li><strong>Type:</strong> <?php echo $data['jobtype_name']; ?></li>
                        <li><strong>Category:</strong> <?php echo $data['category_name']; ?></li>
                        <li><strong>Last Date:</strong> <?php echo $data['jobpost_lastdate']; ?></li>
                    </ul>
                    <div class="mt-auto">
                        <a href="Viewmore.php?eid=<?php echo $data['jobpost_id']; ?>" 
                           class="btn btn-outline-primary btn-sm">View More</a>
                        <?php if ($applicationDisabled) { ?>
                            <span class="badge ">Application Closed</span>
                        <?php } else { ?>
                            <a href="Application.php?eid=<?php echo $data['jobpost_id']; ?>" 
                               class="btn btn-primary btn-sm ms-2">Apply Now</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
    }
} else {
    echo '<div class="col-12"><h5 class="text-center text-muted">No Jobs Found</h5></div>';
}
?>
