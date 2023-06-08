<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: /index.php");
    exit();
}

if (isset($_GET["id"])) {
    $nm = new NotificationsModel($db);
    $notification = $nm->findOne($_GET["id"], $_SESSION["user_id"]);
    if (!$notification) {
        header("Location: /index.php");
        exit();
    }
    if ($notification["user_id"] == $_SESSION["user_id"]) {
        $nm->read($_GET["id"]);



        header("Location: {$notification["refer_to"]}");
        exit();
    }
}

$notificationModel = new NotificationsModel($db);
$notifications = $notificationModel->findAllUserNotifications($_SESSION["user_id"]);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>

    <div class="mb-3 ms-3">
        <h1 class="display-6 fw-bold d-flex align-items-center gap-2"> <iconify-icon
                icon="line-md:bell"></iconify-icon>Notifications
        </h1>
    </div>
    <div class="container">

        <?php foreach ($notifications as $notification) { ?>
            <div class="card m-2">
                <div class="card-body">
                    <a href="/notifications.php?id=<?= $notification["id"] ?>"
                        class="list-group-item list-group-item-action d-flex gap-2 ps-1 w-100" aria-current="true">
                        <iconify-icon icon="line-md:circle-to-confirm-circle-transition"
                            class="text-<?= $notification["is_seen"] == 1 ? "secondary" : "success" ?>" width="24"
                            height="24"></iconify-icon>
                        <div class="d-flex w-100 justify-content-between gap-1">
                            <p class="mb-0">
                                <?= $notification["text"] ?>
                            </p>
                            <small class="opacity-50 text-nowrap">
                                <?= getTimeDifference($notification["created_at"]) ?>
                            </small>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>





    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
</body>

</html>