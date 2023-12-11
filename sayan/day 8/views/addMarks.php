<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Add New Student</title>
</head>

<body>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 mt-4">

                <div class="d-flex justify-content-end mb-2">
                    <a class="btn btn-warning" href="<?= base_url(); ?>"> <i class="fas fa-angle-left"></i> Back</a>
                </div>
                <table class="table mb-0 table-bordered ">
                    <tbody>
                        <th>Name</th>
                        <th>class</th>
                        <th>Section</th>
                        <th>Roll</th>
                        <tr>
                            <td><?= $student[0]['name'] ?></td>
                            <td><?= $student[0]['class'] ?></td>
                            <td><?= $student[0]['sec'] ?></td>
                            <td><?= $student[0]['id'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table mb-0 table-bordered mt-3">
                    <tbody>
                        <th>sub_a</th>
                        <th>sub_b</th>
                        <th>sub_c</th>
                        <th>sub_d</th>
                        <th>Action</th>
                        <?php foreach ($marks as $mark) : ?>
                            <tr>
                                <td><?= $mark['sub_a'] ?></td>
                                <td><?= $mark['sub_b'] ?></td>
                                <td><?= $mark['sub_c'] ?></td>
                                <td><?= $mark['sub_d'] ?></td>
                                <td>
                                    <a href="<?= base_url('students/removeMarks/' . $mark['id'] . '/' . $mark['student_id']) ?>" class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- new -->
                <div class="row mt-2">
                    <div class="col-xl-12 d-flex justify-content-center">
                        <div class="card" style="max-width: 500px;">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Add Marks</h4>
                                <form method="post" action="<?= base_url('students/newMarks/' . $student[0]['id']); ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-email-input" class="form-label">sub_a</label>
                                                <input class="form-control" name="sub_a" type="number" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">sub_b</label>
                                                <input class="form-control" name="sub_b" type="number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-email-input" class="form-label">sub_c</label>
                                                <input class="form-control" name="sub_c" type="number" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">sub_d</label>
                                                <input class="form-control" name="sub_d" type="number" />
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-success w-100"> Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- new -->
                <!-- <form method="post" action="<?= base_url('students/newMarks/' . $student[0]['id']); ?>">

                    <div class="form-group">
                        <label>Sub_a</label>
                        <input class="form-control" name="sub_a" type="number">
                    </div>

                    <div class="form-group">
                        <label>Sub_b</label>
                        <input class="form-control" name="sub_b" type="number" />
                    </div>
                    <div class="form-group">
                        <label>Sub_c</label>
                        <input class="form-control" name="sub_c" type="number">
                    </div>
                    <div class="form-group">
                        <label>Sub_d</label>
                        <input class="form-control" name="sub_d" type="number">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Submit </button>
                    </div>

                </form> -->


            </div>
        </div>
    </div>




</body>

</html>