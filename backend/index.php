<?php
header("Content-Type: text/html; charset=UTF-8");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hospital API Dashboard</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f0f4f8;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .container {
        max-width: 900px;
        margin: 50px auto;
        background: #fff;
        padding: 40px 50px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    h2 {
        text-align: center;
        color: #34495e;
        margin-bottom: 30px;
    }

    .section {
        margin-bottom: 30px;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        background: #ecf0f1;
        margin: 10px 0;
        padding: 15px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    li:hover {
        background: #d1e7fd;
    }

    code {
        background: #e1e1e1;
        padding: 3px 6px;
        border-radius: 4px;
        font-size: 0.95em;
        color: #e74c3c;
    }

    p {
        text-align: center;
        margin-top: 20px;
        font-size: 0.95em;
        color: #555;
    }

    @media (max-width: 600px) {
        .container {
            margin: 20px;
            padding: 20px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Hospital API Dashboard</h1>
        <h2>Available API Endpoints</h2>

        <div class="section">
            <h3>Patients API</h3>
            <ul>
                <li>Read all patients → <code>patients/read.php</code> (GET)</li>
                <li>Create patient → <code>patients/create.php</code> (POST, JSON)</li>
                <li>Update patient → <code>patients/update.php</code> (POST, JSON with id)</li>
                <li>Delete patient → <code>patients/delete.php</code> (POST, JSON with id)</li>
            </ul>
        </div>

        <div class="section">
            <h3>Appointments API</h3>
            <ul>
                <li>Read all appointments → <code>appointments/read.php</code> (GET)</li>
                <li>Create appointment → <code>appointments/create.php</code> (POST, JSON)</li>
                <li>Update appointment → <code>appointments/update.php</code> (POST, JSON with id)</li>
                <li>Delete appointment → <code>appointments/delete.php</code> (POST, JSON with id)</li>
            </ul>
        </div>

        <p>Use <b>Postman</b> or frontend to interact with these APIs.</p>
    </div>
</body>

</html>