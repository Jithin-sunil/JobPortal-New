<?php
header('Content-Type: application/json');
include("../Assets/Connection/Connection.php");

$type = $_GET['type'];
$from = $_GET['from'];
$to = $_GET['to'];

$response = ['headers' => [], 'rows' => [], 'labels' => [], 'values' => []];

switch ($type) {
    case "company":
        $sel = "SELECT company_name, company_email, company_contact, company_status FROM tbl_company WHERE company_doj BETWEEN '$from' AND '$to'";
        $res = $Con->query($sel);
        $response['headers'] = ['Sl.No', 'Name', 'Email', 'Contact', 'Status'];
        $i = 0;
        while ($data = $res->fetch_assoc()) {
            $i++;
            $response['rows'][] = [$i, $data['company_name'], $data['company_email'], $data['company_contact'], $data['company_status'] == 1 ? 'Verified' : 'Pending'];
        }
        $total = $Con->query("SELECT COUNT(*) as count FROM tbl_company WHERE company_doj BETWEEN '$from' AND '$to'")->fetch_assoc()['count'];
        $response['labels'] = ['Verified', 'Pending'];
        $response['values'] = [$Con->query("SELECT COUNT(*) as count FROM tbl_company WHERE company_doj BETWEEN '$from' AND '$to' AND company_status = 1")->fetch_assoc()['count'], $total - $Con->query("SELECT COUNT(*) as count FROM tbl_company WHERE company_doj BETWEEN '$from' AND '$to' AND company_status = 1")->fetch_assoc()['count']];
        break;

    case "user":
        $sel = "SELECT user_name, user_email, user_contact, user_gender FROM tbl_user WHERE user_doj BETWEEN '$from' AND '$to'";
        $res = $Con->query($sel);
        $response['headers'] = ['Sl.No', 'Name', 'Email', 'Contact', 'Gender'];
        $i = 0;
        while ($data = $res->fetch_assoc()) {
            $i++;
            $response['rows'][] = [$i, $data['user_name'], $data['user_email'], $data['user_contact'], $data['user_gender']];
        }
        $total = $Con->query("SELECT COUNT(*) as count FROM tbl_user WHERE user_doj BETWEEN '$from' AND '$to'")->fetch_assoc()['count'];
        $response['labels'] = ['Male', 'Female', 'Other'];
        $response['values'] = [
            $Con->query("SELECT COUNT(*) as count FROM tbl_user WHERE user_doj BETWEEN '$from' AND '$to' AND user_gender = 'Male'")->fetch_assoc()['count'],
            $Con->query("SELECT COUNT(*) as count FROM tbl_user WHERE user_doj BETWEEN '$from' AND '$to' AND user_gender = 'Female'")->fetch_assoc()['count'],
            $total - $Con->query("SELECT COUNT(*) as count FROM tbl_user WHERE user_doj BETWEEN '$from' AND '$to' AND (user_gender = 'Male' OR user_gender = 'Female')")->fetch_assoc()['count']
        ];
        break;

    case "job":
        $sel = "SELECT j.jobpost_title, c.company_name, j.jobpost_date, j.jobpost_lastdate FROM tbl_jobpost j INNER JOIN tbl_company c ON j.company_id = c.company_id WHERE j.jobpost_date BETWEEN '$from' AND '$to'";
        $res = $Con->query($sel);
        $response['headers'] = ['Sl.No', 'Job Title', 'Company', 'Posted On', 'Last Date'];
        $i = 0;
        while ($data = $res->fetch_assoc()) {
            $i++;
            $response['rows'][] = [$i, $data['jobpost_title'], $data['company_name'], $data['jobpost_date'], $data['jobpost_lastdate']];
        }
        $total = $Con->query("SELECT COUNT(*) as count FROM tbl_jobpost WHERE jobpost_date BETWEEN '$from' AND '$to'")->fetch_assoc()['count'];
        $response['labels'] = ['Active', 'Inactive'];
        $response['values'] = [
            $Con->query("SELECT COUNT(*) as count FROM tbl_jobpost WHERE jobpost_date BETWEEN '$from' AND '$to' AND jobpost_status = 0")->fetch_assoc()['count'],
            $total - $Con->query("SELECT COUNT(*) as count FROM tbl_jobpost WHERE jobpost_date BETWEEN '$from' AND '$to' AND jobpost_status = 0")->fetch_assoc()['count']
        ];
        break;

    case "exam":
        $sel = "SELECT e.exam_date, j.jobpost_title, e.exam_status FROM tbl_exam e INNER JOIN tbl_jobpost j ON e.jobpost_id = j.jobpost_id WHERE DATE(e.exam_date) BETWEEN '$from' AND '$to'";
        $res = $Con->query($sel);
        $response['headers'] = ['Sl.No', 'Job Title', 'Exam Date', 'Status'];
        $i = 0;
        while ($data = $res->fetch_assoc()) {
            $i++;
            $status = $data['exam_status'] == 1 ? 'Active' : ($data['exam_status'] == 2 ? 'Completed' : 'Pending');
            $response['rows'][] = [$i, $data['jobpost_title'], $data['exam_date'], $status];
        }
        $total = $Con->query("SELECT COUNT(*) as count FROM tbl_exam WHERE DATE(exam_date) BETWEEN '$from' AND '$to'")->fetch_assoc()['count'];
        $response['labels'] = ['Pending', 'Active', 'Completed'];
        $response['values'] = [
            $Con->query("SELECT COUNT(*) as count FROM tbl_exam WHERE DATE(exam_date) BETWEEN '$from' AND '$to' AND exam_status = 0")->fetch_assoc()['count'],
            $Con->query("SELECT COUNT(*) as count FROM tbl_exam WHERE DATE(exam_date) BETWEEN '$from' AND '$to' AND exam_status = 1")->fetch_assoc()['count'],
            $Con->query("SELECT COUNT(*) as count FROM tbl_exam WHERE DATE(exam_date) BETWEEN '$from' AND '$to' AND exam_status = 2")->fetch_assoc()['count']
        ];
        break;

    case "application":
        $sel = "SELECT a.application_date, u.user_name, j.jobpost_title, a.application_status FROM tbl_application a INNER JOIN tbl_user u ON a.user_id = u.user_id INNER JOIN tbl_jobpost j ON a.jobpost_id = j.jobpost_id WHERE a.application_date BETWEEN '$from' AND '$to'";
        $res = $Con->query($sel);
        $response['headers'] = ['Sl.No', 'User', 'Job Title', 'Applied Date', 'Status'];
        $i = 0;
        while ($data = $res->fetch_assoc()) {
            $i++;
            $status = ['Pending', 'Accepted', 'Rejected', 'Completed'][$data['application_status']] ?? 'Unknown';
            $response['rows'][] = [$i, $data['user_name'], $data['jobpost_title'], $data['application_date'], $status];
        }
        $total = $Con->query("SELECT COUNT(*) as count FROM tbl_application WHERE application_date BETWEEN '$from' AND '$to'")->fetch_assoc()['count'];
        $response['labels'] = ['Pending', 'Accepted', 'Rejected', 'Completed'];
        $response['values'] = [
            $Con->query("SELECT COUNT(*) as count FROM tbl_application WHERE application_date BETWEEN '$from' AND '$to' AND application_status = 0")->fetch_assoc()['count'],
            $Con->query("SELECT COUNT(*) as count FROM tbl_application WHERE application_date BETWEEN '$from' AND '$to' AND application_status = 1")->fetch_assoc()['count'],
            $Con->query("SELECT COUNT(*) as count FROM tbl_application WHERE application_date BETWEEN '$to' AND '$to' AND application_status = 2")->fetch_assoc()['count'],
            $Con->query("SELECT COUNT(*) as count FROM tbl_application WHERE application_date BETWEEN '$from' AND '$to' AND application_status = 3")->fetch_assoc()['count']
        ];
        break;
}

echo json_encode($response);
?>