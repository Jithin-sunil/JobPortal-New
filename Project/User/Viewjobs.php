
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="codepixer">
    <title>Job Listings</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/linearicons.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/magnific-popup.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/nice-select.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/animate.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/owl.carousel.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/main.css">

    <style>
        .job-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .search-filter {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }
        .search-filter .form-control {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .job-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .job-card:hover {
            transform: translateY(-5px);
        }
        .job-card .card-body {
            padding: 20px;
        }
        .job-card .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #222;
        }
        .job-card .card-text {
            font-size: 14px;
            color: #555;
        }
        .job-card .list-unstyled li {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }
        .job-card .list-unstyled li strong {
            color: #222;
        }
        .primary-btn {
            background: #f44a40;
            border: none;
            padding: 8px 20px;
            color: #fff;
            font-weight: 500;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .primary-btn:hover {
            background: #e33a30;
        }
        .outline-btn {
            border: 1px solid #f44a40;
            color: #f44a40;
            padding: 8px 20px;
            font-weight: 500;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .outline-btn:hover {
            background: #f44a40;
            color: #fff;
        }
        .badge-closed {
            background: #6c757d;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 500;
        }
        @media (max-width: 768px) {
            .search-filter {
                padding: 20px;
            }
            .job-card .card-body {
                padding: 15px;
            }
            .job-card .card-title {
                font-size: 18px;
            }
            .job-card .card-text, .job-card .list-unstyled li {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <section class="job-section">
        <div class="container">
            <!-- Search & Filters -->
            <div class="search-filter">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" name="txt_keyword" id="txt_keyword" 
                               class="form-control" 
                               placeholder="Search by keyword..." 
                               onkeyup="searchjob()">
                    </div>
                    <div class="col-md-4 mb-3">
                        <select name="sel_type" id="sel_type" class="form-control" onchange="searchjob()">
                            <option value="">-- Select Job Type --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_jobtype WHERE jobtype_status = 0 ORDER BY jobtype_name ASC";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['jobtype_id']; ?>">
                                <?php echo htmlspecialchars($data['jobtype_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <select name="sel_category" id="sel_category" class="form-control" onchange="searchjob()">
                            <option value="">-- Select Category --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_category WHERE category_status = 0 ORDER BY category_name ASC";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['category_id']; ?>">
                                <?php echo htmlspecialchars($data['category_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div id="result" class="row">
                <?php
                $i = 0;
                $selQry = "SELECT * FROM tbl_jobpost p 
                           INNER JOIN tbl_jobtype t ON p.jobtype_id = t.jobtype_id 
                           INNER JOIN tbl_category c ON p.category_id = c.category_id 
                           WHERE jobpost_status = 0 
                           ORDER BY jobpost_date ASC";
                $row = $Con->query($selQry); 
                while ($data = $row->fetch_assoc()) {
                    $i++;
                    $currentDate = date('Y-m-d');
                    $lastDate = $data['jobpost_lastdate'];
                    $applicationDisabled = ($currentDate > $lastDate);
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card job-card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($data['jobpost_title']); ?></h5>
                            <p class="card-text text-muted mb-2"><?php echo htmlspecialchars($data['jobpost_content']); ?></p>
                            <ul class="list-unstyled small mb-3">
                                <li><strong>Experience:</strong> <?php echo htmlspecialchars($data['jobpost_experience']); ?></li>
                                <li><strong>Type:</strong> <?php echo htmlspecialchars($data['jobtype_name']); ?></li>
                                <li><strong>Category:</strong> <?php echo htmlspecialchars($data['category_name']); ?></li>
                                <li><strong>Last Date:</strong> <?php echo date("d-m-Y", strtotime($data['jobpost_lastdate'])); ?></li>
                            </ul>
                            <div class="mt-auto d-flex gap-2">
                                <a href="Viewmore.php?eid=<?php echo $data['jobpost_id']; ?>" class="outline-btn">View More</a>
                                <?php if ($applicationDisabled) { ?>
                                    <span class="badge-closed">Application Closed</span>
                                <?php } else { ?>
                                    <a href="Application.php?eid=<?php echo $data['jobpost_id']; ?>" class="primary-btn">Apply Now</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function searchjob() {
            var type = document.getElementById("sel_type").value;
            var category = document.getElementById("sel_category").value;
            var keyword = document.getElementById("txt_keyword").value;

            $.ajax({
                url: "../Assets/AjaxPages/AjaxSearch.php?type=" + type + "&category=" + category + "&keyword=" + keyword,
                success: function(result) {
                    $("#result").html(result);
                }
            });
        }
    </script>

    <?php include('Footer.php'); ?>
</body>
</html>
