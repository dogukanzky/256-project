<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>
    <div class="toast <?= isset($_GET["register"]) && $_GET["register"] == "ok" ? "show" : "hide" ?>  position-fixed"
        style="top:10px;right:10px;z-index:4;" 0 role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">User Created Successfully!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>

    </div>

    <div class="d-flex flex-column align-items-center gap-3">
        <?php for ($number = 0; $number < 3; $number++) { ?>

            <div class="card" style="width: 600px;">
                <div class="card-header">
                    <div href="#" class="d-flex align-items-center gap-2 text-decoration-none">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <div class="d-flex flex-column">
                            <a href="#" class="d-flex align-items-stretch gap-2 text-decoration-none">Name Lastname</a>
                            <small class="text-body-secondary">1 Jun, 2023</small>
                        </div>
                    </div>
                </div>
                <img src="/src/images/background.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem sint ipsam
                        inventore ea? Iusto debitis sequi placeat mollitia, ex velit harum nesciunt ea sunt provident dicta
                        incidunt assumenda soluta molestias.</p>
                    <a href="#" class="btn btn-dark text-danger">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="line-md:heart-filled" width="24" height="24"></iconify-icon>
                            Like
                        </div>
                    </a>
                    <a href="post-detail" class="btn btn-dark text-info">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="line-md:email-twotone" width="24" height="24"></iconify-icon>
                            Comment
                        </div>
                    </a>
                    <a href="#" class="btn btn-dark text-warning">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="line-md:telegram" width="24" height="24"></iconify-icon>
                            Share
                        </div>
                    </a>
                </div>
            </div>


        <?php } ?>
    </div>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
</body>

</html>