<?php
require_once 'config.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;700&display=swap" rel="stylesheet">
    <!-- in your <head> -->
    <link href="https://banglawebfonts.pages.dev/css/solaiman-lipi.css" rel="stylesheet">


    <style>
    body {
        background-color: #f8f9fa;
    }

    * {
        font-family: "SolaimanLipi", "Noto Sans Bengali", sans-serif;

    }

    .registration-container {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
        color: #3f51b5;
    }

    .header h2 {
        font-weight: 700;
    }

    .form-section {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .form-section-title {
        color: #3f51b5;
        margin-bottom: 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .form-section-title i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .password-toggle {
        cursor: pointer;
        position: absolute;
        right: 15px;
        top: 38px;
        color: #6c757d;
    }

    .select-icon {
        position: relative;
    }

    .select-icon:after {
        content: "▼";
        font-size: 12px;
        position: absolute;
        right: 15px;
        top: 42px;
        color: #6c757d;
        pointer-events: none;
    }
    </style>
</head>

<body>
    <?php include"nav.php" ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="registration-container">
                    <div class="header">
                        <h2><i class=""></i> Syllebus</h2>
                        <p class="text-muted">Please fill in all the required information</p>
                    </div>

                    <div class="container">
                        <!-- <h3 class="mb-3">Bootstrap 2x5 Table</h3> -->
                        <table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Module</th>
            <th>Topic</th>
            <th>Sub Topic</th>
        </tr>
    </thead>
    <tbody>
        <!-- Artificial Intelligence -->
        <tr>
            <td rowspan="6">Artificial Intelligence (AI)</td>
            <td>Introduction to AI</td>
            <td>Definition, History, Applications</td>
        </tr>
        <tr>
            <td>Machine Learning</td>
            <td>Supervised, Unsupervised, Reinforcement Learning</td>
        </tr>
        <tr>
            <td>Deep Learning</td>
            <td>Neural Networks, CNN, RNN</td>
        </tr>
        <tr>
            <td>Natural Language Processing</td>
            <td>Text Processing, Chatbots, Sentiment Analysis</td>
        </tr>
        <tr>
            <td>Computer Vision</td>
            <td>Image Recognition, Object Detection</td>
        </tr>
        <tr>
            <td>AI Ethics</td>
            <td>Bias, Privacy, Fairness</td>
        </tr>

        <!-- Networking -->
        <tr>
            <td rowspan="6">Networking</td>
            <td>Fundamentals</td>
            <td>LAN, WAN, MAN, Topologies</td>
        </tr>
        <tr>
            <td>Models & Protocols</td>
            <td>OSI Model, TCP/IP Model</td>
        </tr>
        <tr>
            <td>Devices</td>
            <td>Routers, Switches, Firewalls</td>
        </tr>
        <tr>
            <td>Network Security</td>
            <td>Encryption, VPN, IDS/IPS</td>
        </tr>
        <tr>
            <td>Wireless & Mobile Networks</td>
            <td>Wi-Fi, 4G/5G</td>
        </tr>
        <tr>
            <td>Cloud Networking</td>
            <td>Virtual Networks, SDN</td>
        </tr>

        <!-- Computer Programming -->
        <tr>
            <td rowspan="8">Computer Programming (CP)</td>
            <td>Basics</td>
            <td>Syntax, Variables, Data Types</td>
        </tr>
        <tr>
            <td>Control Structures</td>
            <td>Loops, Conditionals</td>
        </tr>
        <tr>
            <td>Functions & Modules</td>
            <td>Reusability, Libraries</td>
        </tr>
        <tr>
            <td>Object-Oriented Programming</td>
            <td>Classes, Inheritance, Polymorphism</td>
        </tr>
        <tr>
            <td>Data Structures</td>
            <td>Arrays, Linked Lists, Stacks, Queues, Trees</td>
        </tr>
        <tr>
            <td>Algorithms</td>
            <td>Searching, Sorting, Complexity</td>
        </tr>
        <tr>
            <td>Web Development</td>
            <td>HTML, CSS, JavaScript</td>
        </tr>
        <tr>
            <td>Databases</td>
            <td>SQL Basics, CRUD Operations</td>
        </tr>

        <!-- Recent Developments -->
        <tr>
            <td rowspan="5">Recent Developments</td>
            <td>Internet of Things (IoT)</td>
            <td>Sensors, Smart Devices, Applications</td>
        </tr>
        <tr>
            <td>Blockchain</td>
            <td>Cryptocurrency, Smart Contracts</td>
        </tr>
        <tr>
            <td>5G & Edge Computing</td>
            <td>Features, Use Cases</td>
        </tr>
        <tr>
            <td>Quantum Computing</td>
            <td>Qubits, Applications</td>
        </tr>
        <tr>
            <td>Green ICT</td>
            <td>Energy Efficiency, Sustainable Computing</td>
        </tr>
    </tbody>
</table>

<a href="sylebus.pdf" target = "_blank">Download Sylebus</a>

<style>
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #00000041; /* thicker border */
    }

    .table-bordered {
        border-collapse: collapse; /* clean look */
    }

    
</style>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include"footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>