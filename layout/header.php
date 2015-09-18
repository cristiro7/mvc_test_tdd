<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php echo $title; ?></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>layout/css/reset.css" />
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>layout/css/style.css" />
</head>
<body>

    <div class='title-box'>
        <a href="<?php echo BASE_PATH; ?>">Case Study to apply TDD with Unit Test and Functional Test</a>
    </div>

    <div class="header">
        <div class="header_left_box">
            <ul id="menu">
                <?php if (Session::get('user_logged_in') == true):?>
                    <li>
                        <a href="<?php echo BASE_PATH; ?>employees/logout">Logout</a>
                    </li>
                <?php endif; ?>

                <!-- For not logged in users -->
                <?php if (Session::get('user_logged_in') == false):?>
                    <li>
                        <a href="<?php echo BASE_PATH; ?>employees/index">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <?php if (Session::get('user_logged_in') == true): ?>
            <div class="header_right_box">
                <div class="namebox">
                    Hello <?php echo Session::get('fullname'); ?> !
                </div>
            </div>
        <?php endif; ?>

        <div class="clear-both"></div>
    </div>
