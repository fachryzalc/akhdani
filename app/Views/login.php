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
    <script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="title" data-title="<?= session()->getFlashdata('title'); ?>"></div>
        <div class="text" data-text="<?= session()->getFlashdata('text'); ?>"></div>
        <div class="icon" data-icon="<?= session()->getFlashdata('icon'); ?>"></div>
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
                                        <h1 class="h4 text-gray-900 mb-4 mt-2">Akhdani | <?= $title; ?></h1>
                                    </div>
                                    <form class="user" method="post" action="/auth/proseslogin">
                                        <div class="input-group mb-4">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                        </div>
                                        <div class="input-group mb-4">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="width:90%">
                                            <i class="fas fa-eye-slash form-control bg-gray-400 pr-4" style="cursor: pointer"></i>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/auth/register">Create an Account!</a>
                                    </div>
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

    <script>
        const flashTitle = $('.title').data('title');
        const flashText = $('.text').data('text');
        const flashIcon = $('.icon').data('icon');
        var ic = null;

        if (flashIcon) {
            ic = $('.icon').data('icon')
        } else {
            ic = 'success'
        }

        if (flashTitle) {
            swal({
                title: flashTitle,
                text: flashText,
                icon: ic
            })
            ic = null;
        } else {
            ic = null;
        }

        const togglePassword = document.querySelector(".fas");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>