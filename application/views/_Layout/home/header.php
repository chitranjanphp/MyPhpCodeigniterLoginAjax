<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css"); ?>">
    <script src="<?= base_url("assets/js/jquery-3.6.1.min.js"); ?>"></script>
    <script src="<?= base_url("assets/js/jquery.validate.min.js"); ?>"></script>
    <style type="text/css">
        .error{
                margin-top: 6px;
                margin-bottom: 0;
                color: #fff;
                background-color: #D65C4F;
                display: table;
                padding: 5px 8px;
                font-size: 11px;
                font-weight: 600;
                line-height: 14px;
          }
          .errorMessage {
                color: red;
                background-color: #FEEFB3;
            }
         
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Login Application</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <?php if (!empty($this->session->userdata('USER_ID')) && $this->session->userdata('USER_ID') > 0) { ?>
                <!-- User isLogin -->
            <li class="nav-item active">
                 <a href="<?= base_url('User/res_list') ?>" class="nav-link">Register List</a>
            </li>
            <?php } else { ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php } ?>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <?php if (!empty($this->session->userdata('USER_ID')) && $this->session->userdata('USER_ID') > 0) { ?>
                    <!-- User isLogin -->
                    <a href="<?= base_url('User/Panel') ?>" class="btn btn-primary my-2 my-sm-0">User Panel</a> &nbsp;
                    <a href="<?= base_url('User/logout') ?>" class="btn btn-danger my-2 my-sm-0">Logout</a>
                <?php } else { ?>
                    <!-- User not Login -->
                    <a href="<?= base_url('User/signup') ?>" class="btn btn-info my-2 my-sm-0">Register</a> &nbsp;
                    <a href="<?= base_url('User/ajax_login') ?>" class="btn btn-success my-2 my-sm-0">Login</a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <br>