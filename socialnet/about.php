<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Social Network</title>

    <style>

        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            padding: 40px 20px;
        }

        /* Container */
        .student-container {
            width: 90%;
            max-width: 700px;
            margin: auto;
            background-color: white;
            border-radius: 14px;
            padding: 35px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        /* Header */
        .student-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .student-header h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .student-header p {
            color: #777;
        }

        /* Information Table */
        .student-table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-table tr {
            border-bottom: 1px solid #e5e5e5;
        }

        .student-table th,
        .student-table td {
            padding: 16px;
            text-align: left;
        }

        .student-table th {
            width: 35%;
            background-color: #f7f7f7;
            color: #2c3e50;
        }

        .student-table td {
            background-color: #ffffff;
        }

        /* Responsive */
        @media (max-width: 600px) {

            .student-container {
                padding: 20px;
            }

            .student-table,
            .student-table tbody,
            .student-table tr,
            .student-table th,
            .student-table td {
                display: block;
                width: 100%;
            }

            .student-table th {
                border-bottom: none;
            }

            .student-table td {
                padding-top: 5px;
                margin-bottom: 15px;
            }
        }

    </style>

</head>

<body>

    <div class="student-container">

        <div class="student-header">
            <h1>About</h1>
            <p>Details of the student information</p>
        </div>

        <table class="student-table">

            <tr>
                <th>Student Name</th>
                <td>Ly Ba Hoang</td>
            </tr>

            <tr>
                <th>Student Number</th>
                <td>1695172</td>
            </tr>

        </table>

    </div>

</body>
</html>