<?php
ob_start();
include('Header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Comprehensive Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #2d3436;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 95%;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .filter-section {
            text-align: center;
            margin-bottom: 20px;
        }
        select, input[type="date"], button {
            padding: 8px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin: 5px;
        }
        button {
            background: #0984e3;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #74b9ff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ddd;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #2f3640;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        .chart-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        canvas {
            max-width: 400px;
            max-height: 400px;
        }
        .print-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 15px;
            background: #0984e3;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
        .print-btn:hover {
            background: #74b9ff;
        }
    </style>
</head>
<body onload="loadReport()">
    <div class="container">
        <h2>Admin Comprehensive Report</h2>
        <div class="filter-section">
            <select id="reportType" onchange="loadReport()">
                <option value="company">Company Registered</option>
                <option value="user">User Registered</option>
                <option value="job">Jobs Added</option>
                <option value="exam">Exam Declared</option>
                <option value="application">Applied for Job</option>
            </select>
            <input type="date" id="fromDate" onchange="loadReport()">
            <input type="date" id="toDate" value="2025-10-16" onchange="loadReport()">
            <button onclick="loadReport()">Generate</button>
        </div>

        <div id="reportContent"></div>
        <div class="chart-container">
            <canvas id="pieChart"></canvas>
        </div>
        <button class="print-btn" onclick="window.print()">Print Report</button>
    </div>

    <script>
        let chart = null;

        function loadReport() {
            const reportType = document.getElementById('reportType').value;
            const fromDate = document.getElementById('fromDate').value || '2025-01-01';
            const toDate = document.getElementById('toDate').value || '2025-10-16';
            const contentDiv = document.getElementById('reportContent');

            fetch(`report_data.php?type=${reportType}&from=${fromDate}&to=${toDate}`)
                .then(response => response.json())
                .then(data => {
                    let html = `<h3 align="center">Report from ${fromDate} to ${toDate}</h3>`;
                    html += `<h3 align="center">${getReportTitle(reportType)} Report</h3>`;
                    html += '<table><tr>' + data.headers.map(header => `<th>${header}</th>`).join('') + '</tr>';

                    data.rows.forEach(row => {
                        html += '<tr>';
                        row.forEach(cell => html += `<td>${cell}</td>`);
                        html += '</tr>';
                    });

                    html += '</table>';
                    contentDiv.innerHTML = html;

                    // Update Pie Chart
                    if (chart) chart.destroy();
                    const ctx = document.getElementById('pieChart').getContext('2d');
                    chart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                data: data.values,
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function getReportTitle(type) {
            const titles = {
                'company': 'Company Registered',
                'user': 'User Registered',
                'job': 'Jobs Added',
                'exam': 'Exam Declared',
                'application': 'Applied for Job'
            };
            return titles[type] || '';
        }
    </script>
</body>
</html>
<?php
ob_end_flush();
include('Footer.php');
?>