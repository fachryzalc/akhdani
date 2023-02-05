<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Akhdani - <?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('http://localhost:8080/assets'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('http://localhost:8080/assets'); ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-10 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="<?= base_url('http://localhost:8080/assets'); ?>/img/sidebar.jpeg" alt="">
                                        <h1 class="h4 text-gray-900 mb-4 mt-2">Akhdani | Register</h1>
                                    </div>
                                    <form class="user" action="/auth/prosesregister" method="post">
                                        <div class="input-group mb-4 has-validation">
                                            <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= old('nama'); ?>">
                                            <div class="invalid-feedback">
                                                <?= validation_show_error('nama') ?>
                                            </div>
                                        </div>
                                        <div class="input-group mb-4">
                                            <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Username" value="<?= old('username'); ?>">
                                            <div class="invalid-feedback">
                                                <?= validation_show_error('username') ?>
                                            </div>
                                        </div>
                                        <div class="input-group mb-4">
                                            <input type="password" class="form-control <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                                            <div class="invalid-feedback">
                                                <?= validation_show_error('password') ?>
                                            </div>
                                        </div>
                                        <div class="input-group mb-4">
                                            <input type="password " class="form-control <?= (validation_show_error('passwordv')) ? 'is-invalid' : ''; ?>" id="passwordv" name="passwordv" placeholder="Konfirmasi Password">
                                            <div class="invalid-feedback">
                                                <?= validation_show_error('passwordv') ?>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">Register</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('http://localhost:8080/assets'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('http://localhost:8080/assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('http://localhost:8080/assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('http://localhost:8080/assets'); ?>/js/sb-admin-2.min.js"></script>

</body>

</html>