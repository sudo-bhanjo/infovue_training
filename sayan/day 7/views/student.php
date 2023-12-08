<!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Student List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="profile" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="<?= base_url('assets/libs/magnific-popup/magnific-popup.css'); ?>" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/css/app.min.css'); ?> " id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">

    <div id="layout-wrapper " style="max-width: 700PX; margin: 0 auto;">
        <div class="main-content" style="margin-left: 0;">
            <div class="page-content" style="padding: 0;">
                <div class="container-fluid">
                    <div class="mt-3 mb-5">
                        <h5 class="mb-3 text-center">Student List</h5>
                        <div class="table-responsive mx-3">
                            <a href="<?= base_url('/students/new'); ?>" class="btn btn-success">Add New</a>
                            <table class="table mb-0 table-bordered ">
                                <tbody>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>class</th>
                                    <th>Roll</th>
                                    <th>Action</th>
                                    <?php foreach ($students as $student) : ?>
                                        <tr>
                                            <td><?= $student['id'] ?></td>
                                            <td><?= $student['name'] ?></td>
                                            <td><?= $student['class'] ?></td>
                                            <td><?= $student['roll'] ?></td>
                                            <td>
                                                <a  href="<?=base_url('students/subjects/'.$student['id'])?>" class="btn btn-primary">add MArks</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    <script src="<?= base_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/libs/metismenu/metisMenu.min.js'); ?>"></script>
    <script src="<?= base_url('assets/libs/simplebar/simplebar.min.js'); ?>"></script>
    <script src="<?= base_url('assets/libs/node-waves/waves.min.js'); ?>"></script>
    <script src="<?= base_url('assets/libs/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/lightbox.init.js'); ?>"></script>
    <script src="<?= base_url('assets/js/app.js'); ?>"></script>
</body>
</html>