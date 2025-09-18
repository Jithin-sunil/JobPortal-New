
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

// Validate job post ID
$jid = isset($_GET['jid']) ? (int)$_GET['jid'] : 0;
if ($jid <= 0) {
    echo "<script>alert('Invalid job post ID.'); window.location='JobList.php';</script>";
    exit;
}

// Check for completed exam
$exam_query = "SELECT exam_id FROM tbl_exam WHERE jobpost_id = $jid AND exam_status = 2 LIMIT 1";
$exam_result = $Con->query($exam_query);
if (!$exam_result || !$exam = $exam_result->fetch_assoc()) {
    echo "<script>alert('No completed exam found for this job post.'); window.location='JobList.php';</script>";
    exit;
}
$exam_id = $exam['exam_id'];

// Fetch job post details
$jobQry = "SELECT j.jobpost_title, c.company_name, c.company_address, p.place_name, d.district_name, s.state_name 
           FROM tbl_jobpost j 
           INNER JOIN tbl_company c ON j.company_id = c.company_id 
           INNER JOIN tbl_place p ON p.place_id = c.place_id 
           INNER JOIN tbl_district d ON d.district_id = p.district_id 
           INNER JOIN tbl_state s ON s.state_id = d.state_id 
           WHERE j.jobpost_id = $jid AND j.company_id = '" . $_SESSION['cid'] . "'";
$jobRes = $Con->query($jobQry);
$jobRow = $jobRes->fetch_assoc();
if (!$jobRow) {
    echo "<script>alert('Job post not found or you are not authorized.'); window.location='JobList.php';</script>";
    exit;
}

// Fetch categories and calculate max possible marks
$category_query = "SELECT questioncategory_id, questioncategory_mark FROM tbl_questioncategory 
                  WHERE questioncategory_id IN (SELECT questioncategory_id FROM tbl_question WHERE exam_id = $exam_id)";
$category_result = $Con->query($category_query);
$categories = [];
$max_possible_marks = 0;
while ($category = $category_result->fetch_assoc()) {
    $cat_id = $category['questioncategory_id'];
    $mark = $category['questioncategory_mark'];
    $categories[$cat_id] = $mark;
    $question_query = "SELECT COUNT(*) as total FROM tbl_question WHERE exam_id = $exam_id AND questioncategory_id = $cat_id";
    $question_result = $Con->query($question_query);
    $total_questions = $question_result->fetch_assoc()['total'];
    $max_possible_marks += $total_questions * $mark;
}
$pass_mark = $max_possible_marks * 0.5;

// Handle interview invitation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_interview'])) {
    $user_id = (int)$_POST['user_id'];
    $user_email = $_POST['user_email'];
    $interview_date = $_POST['interview_date'];
    $interview_time = $_POST['interview_time'];
    $interview_location = $_POST['interview_location'];

    // Validate inputs
    if (strtotime($interview_date) < strtotime(date('Y-m-d'))) {
        echo "<script>alert('Interview date must be in the future.');</script>";
    } elseif (empty($interview_time) || empty($interview_location)) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        $userQry = "SELECT user_name FROM tbl_user WHERE user_id = '$user_id'";
        $userRes = $Con->query($userQry);
        $userRow = $userRes->fetch_assoc();

        $appQry = "SELECT application_id FROM tbl_application WHERE user_id = '$user_id' AND jobpost_id = '$jid'";
        $appRes = $Con->query($appQry);
        if ($appRes->num_rows == 0) {
            echo "<script>alert('No application found for this user and job post.');</script>";
        } else {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jobportalarjun@gmail.com'; // Replace with your actual Gmail address
                $mail->Password = 'jberropyurlewonl'; // Replace with your actual app-specific password
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('jobportalarjun@gmail.com', 'Job Portal');
                $mail->addAddress($user_email);

                $mail->isHTML(true);
                $mail->Subject = "Interview Invitation for " . htmlspecialchars($jobRow['jobpost_title']);
                $mail->Body = "
                    <h3>Interview Invitation</h3>
                    <p>Dear <strong>" . htmlspecialchars($userRow['user_name']) . "</strong>,</p>
                    <p>Congratulations! You have qualified for the interview for the job: <strong>" . htmlspecialchars($jobRow['jobpost_title']) . "</strong>.</p>
                    <p><strong>Interview Details:</strong></p>
                    <p><strong>Date:</strong> " . htmlspecialchars($interview_date) . "</p>
                    <p><strong>Time:</strong> " . htmlspecialchars($interview_time) . "</p>
                    <p><strong>Location/Address:</strong> " . htmlspecialchars($interview_location) . "</p>
                    <p><strong>Company:</strong> " . htmlspecialchars($jobRow['company_name']) . "</p>
                    <p><strong>Address:</strong> " . htmlspecialchars($jobRow['company_address'] . ", " . $jobRow['place_name'] . ", " . $jobRow['district_name'] . ", " . $jobRow['state_name']) . "</p>
                    <br><p>We look forward to meeting you!</p>
                    <p>Best Regards,<br>Hiring Team</p>
                ";

                $mail->send();

                $updateQry = "UPDATE tbl_application SET application_status = 3 WHERE user_id = '$user_id' AND jobpost_id = '$jid'";
                if ($Con->query($updateQry)) {
                    echo "<script>alert('Interview invitation sent successfully to $user_email and application status updated.');</script>";
                } else {
                    echo "<script>alert('Interview invitation sent, but failed to update application status.');</script>";
                }
            } catch (Exception $e) {
                echo "<script>alert('Mail could not be sent. Error: " . htmlspecialchars($mail->ErrorInfo) . "');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="codepixer">
    <title>View Exam Results</title>


    <style>
        .results-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .results-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 0 auto;
        }
        .results-table h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            color: #222;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background: #f44a40;
            color: #fff;
            font-weight: 600;
        }
        .table td {
            background: #fff;
            color: #555;
        }
        .action-link {
            color: #f44a40;
            text-decoration: none;
            font-weight: 500;
        }
        .action-link:hover {
            color: #e33a30;
            text-decoration: underline;
        }
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            max-width: 500px;
            width: 90%;
        }
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .modal.active, .modal-overlay.active {
            display: block;
        }
        .modal h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #222;
        }
        .modal .form-group {
            margin-bottom: 20px;
        }
        .modal label {
            font-weight: 500;
            color: #222;
            display: block;
            margin-bottom: 5px;
        }
        .modal input, .modal textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .modal textarea {
            resize: vertical;
            min-height: 100px;
        }
        .modal .primary-btn {
            background: #f44a40;
            border: none;
            padding: 12px 30px;
            color: #fff;
            font-weight: 500;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .modal .primary-btn:hover {
            background: #e33a30;
        }
        .modal .cancel-btn {
            background: #6c757d;
            border: none;
            padding: 12px 30px;
            color: #fff;
            font-weight: 500;
            border-radius: 5px;
            margin-left: 10px;
        }
        @media (max-width: 768px) {
            .results-table {
                padding: 20px;
            }
            .table th, .table td {
                padding: 10px;
                font-size: 14px;
            }
            .modal {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <section class="results-section">
        <div class="container">
            <div class="results-table">
                <h3>Exam Results for <?php echo htmlspecialchars($jobRow['jobpost_title']); ?></h3>
                <p class="text-center">Maximum Possible Marks: <?php echo $max_possible_marks; ?> | Pass Mark: <?php echo $pass_mark; ?></p>
                <?php
                $user_query = "SELECT u.user_id, u.user_name, u.user_email FROM tbl_user u 
                               JOIN tbl_questionanswer qa ON u.user_id = qa.user_id 
                               WHERE qa.question_id IN (SELECT question_id FROM tbl_question WHERE exam_id = $exam_id) 
                               GROUP BY u.user_id";
                $user_result = $Con->query($user_query);
                if ($user_result->num_rows == 0) {
                    ?>
                    <p class="text-center" style="color: #f44a40;">No candidates have completed the exam.</p>
                    <?php
                } else {
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <?php foreach ($categories as $cat_id => $mark) { ?>
                                    <th>Category <?php echo $cat_id; ?><br>(Mark/Q: <?php echo $mark; ?>)</th>
                                <?php } ?>
                                <th>Total Marks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            while ($user = $user_result->fetch_assoc()) {
                                $i++;
                                $user_id = $user['user_id'];
                                $total_marks = 0;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo htmlspecialchars($user['user_name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['user_email']); ?></td>
                                    <?php
                                    foreach ($categories as $cat_id => $mark) {
                                        $question_query = "SELECT question_id FROM tbl_question WHERE exam_id = $exam_id AND questioncategory_id = $cat_id";
                                        $question_result = $Con->query($question_query);
                                        $total_questions = $question_result->num_rows;
                                        $correct_count = 0;
                                        $cat_marks = 0;

                                        while ($question = $question_result->fetch_assoc()) {
                                            $qid = $question['question_id'];
                                            $answer_query = "SELECT o.option_iscorrect FROM tbl_questionanswer qa 
                                                             JOIN tbl_option o ON qa.option_id = o.option_id 
                                                             WHERE qa.user_id = $user_id AND qa.question_id = $qid";
                                            $answer_result = $Con->query($answer_query);
                                            if ($answer_result && $answer = $answer_result->fetch_assoc()) {
                                                if ($answer['option_iscorrect'] == 1) {
                                                    $correct_count++;
                                                    $cat_marks += $mark;
                                                }
                                            }
                                        }
                                        $total_marks += $cat_marks;
                                        ?>
                                        <td><?php echo "$correct_count/$total_questions<br>(Marks: $cat_marks)"; ?></td>
                                    <?php } ?>
                                    <td><?php echo $total_marks; ?></td>
                                    <td>
                                        <a href="#" class="action-link" onclick="showInterviewForm('<?php echo $user_id; ?>', '<?php echo htmlspecialchars($user['user_email']); ?>')">Send Interview Notification</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </section>

    <div class="modal-overlay" id="modal-overlay"></div>
    <div class="modal" id="interview-modal">
        <h3>Send Interview Invitation</h3>
        <form method="POST" action="">
            <input type="hidden" name="user_id" id="form-user-id">
            <input type="hidden" name="user_email" id="form-user-email">
            <div class="form-group">
                <label for="interview_date">Date</label>
                <input type="date" name="interview_date" id="interview_date" 
                       min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
            </div>
            <div class="form-group">
                <label for="interview_time">Time</label>
                <input type="time" name="interview_time" id="interview_time" required>
            </div>
            <div class="form-group">
                <label for="interview_location">Location/Address</label>
                <textarea name="interview_location" id="interview_location" required></textarea>
            </div>
            <div class="form-group text-center">
                <button type="submit" name="send_interview" class="primary-btn">Send Invitation</button>
                <button type="button" class="cancel-btn" onclick="hideInterviewForm()">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        function showInterviewForm(userId, userEmail) {
            document.getElementById('form-user-id').value = userId;
            document.getElementById('form-user-email').value = userEmail;
            document.getElementById('interview-modal').classList.add('active');
            document.getElementById('modal-overlay').classList.add('active');
        }

        function hideInterviewForm() {
            document.getElementById('interview-modal').classList.remove('active');
            document.getElementById('modal-overlay').classList.remove('active');
        }
    </script>

    <?php include('Footer.php'); ?>

</body>
</html>
