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
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
                        <h2><i class=""></i> FAQ - Friquently Ask Question</h2>
                        <p class="text-muted">Please fill in all the required information</p>
                    </div>

                    <div class="container">
                        <ul type="none">
                            <div class="row mb-4">
                                <li class="fw-bold">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, excepturi ipsa ratione pariatur eveniet a quidem ullam rerum consequuntur libero. Temporibus architecto rem consectetur, dicta fuga maiores modi? Veniam, aut! Repellat illum perferendis provident neque, vitae velit hic, possimus voluptatum consequuntur nihil quibusdam fugit culpa delectus illo rerum repellendus laudantium?
                            </li>
                            <li class="text-secondary">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum quaerat obcaecati enim nostrum recusandae possimus!
                            </li>
                            </div>
                            <div class="row mb-4">
                                <li class="fw-bold">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, excepturi ipsa ratione pariatur eveniet a quidem ullam rerum consequuntur libero. Temporibus architecto rem consectetur, dicta fuga maiores modi? Veniam, aut! Repellat illum perferendis provident neque, vitae velit hic, possimus voluptatum consequuntur nihil quibusdam fugit culpa delectus illo rerum repellendus laudantium?
                            </li>
                            <li class="text-secondary">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum quaerat obcaecati enim nostrum recusandae possimus!
                            </li>
                            </div>
                            <div class="row mb-4">
                                <li class="fw-bold">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, excepturi ipsa ratione pariatur eveniet a quidem ullam rerum consequuntur libero. Temporibus architecto rem consectetur, dicta fuga maiores modi? Veniam, aut! Repellat illum perferendis provident neque, vitae velit hic, possimus voluptatum consequuntur nihil quibusdam fugit culpa delectus illo rerum repellendus laudantium?
                            </li>
                            <li class="text-secondary">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum quaerat obcaecati enim nostrum recusandae possimus!
                            </li>
                            </div>
                            <div class="row mb-4">
                                <li class="fw-bold">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, excepturi ipsa ratione pariatur eveniet a quidem ullam rerum consequuntur libero. Temporibus architecto rem consectetur, dicta fuga maiores modi? Veniam, aut! Repellat illum perferendis provident neque, vitae velit hic, possimus voluptatum consequuntur nihil quibusdam fugit culpa delectus illo rerum repellendus laudantium?
                            </li>
                            <li class="text-secondary">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum quaerat obcaecati enim nostrum recusandae possimus!
                            </li>
                            </div>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

        <?php include"footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>