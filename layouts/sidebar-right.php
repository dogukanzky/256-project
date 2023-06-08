<?php
$friendModel = new FriendsModel($db);
$userModel = new UsersModel($db);
$notificationModel = new NotificationsModel($db);


$friend_requests = $friendModel->findRequests($_SESSION["user_id"]);
$friends = $userModel->getFriends($_SESSION["user_id"], 3);
$notifications = $notificationModel->findAllUserNotifications($_SESSION["user_id"], 3);


function getTimeDifference($givenDate)
{
    $now = time(); // Current Unix timestamp
    $given = strtotime($givenDate); // Given Unix timestamp


    $difference = $now - $given; // Calculate the difference in seconds


    if ($difference < 3600) { // Less than 1 hour
        $minutes = ceil($difference / 60);
        return $minutes . ' minute' . ($minutes > 1 ? 's' : '');
    } elseif ($difference < 86400) { // Less than 24 hours
        $hours = floor($difference / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '');
    } else { // More than 24 hours
        $days = floor($difference / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '');
    }
}


?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark border-start mt-0 position-fixed overflow-y-scroll"
    style="width: 320px;top:81px;height:calc(100% - 81px);right:0;">

    <?php if (count($friend_requests)) { ?>
        <div class="card mb-4 rounded-3 shadow-sm" id="side-bar-friend-requests">
            <div class="card-header py-3">
                <a href="/friend-requests.php" class="text-decoration-none">
                    <h4 class="my-0 fw-normal d-flex align-items-center">
                        <iconify-icon icon="line-md:account-add" width="32" height="32"></iconify-icon>Friend Requests
                    </h4>
                </a>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-1 align-items-center justify-content-center">
                    <div class="list-group w-100">
                        <?php foreach ($friend_requests as $request) { ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center gap-2 p-3 w-100"
                                aria-current="true" data-inviter-id="<?= $request["users.id"] ?>">
                                <a href="/profile.php?id=<?= $request["users.id"] ?>"
                                    class="d-flex gap-1 align-items-center text-decoration-none" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Visit User">
                                    <?php if (isset($request["user.picture"])) { ?>
                                        <img src="<?= $request["user.picture"] ?>" alt="mdo" width="32" height="32"
                                            style="object-fit:cover;" class="rounded-circle">
                                    <?php } else { ?>
                                        <iconify-icon icon="heroicons:rocket-launch-solid" width="32" height="32"
                                            class="text-danger"></iconify-icon>
                                    <?php } ?>
                                    <p class="mb-0" style="font-size:12px">
                                        <?= filter_var($request["users.name"] . " " . $request["users.last_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                                    </p>
                                </a>
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button type="button" data-inviter-id="<?= $request["users.id"] ?>"
                                        class="btn btn-danger rounded-circle p-1 d-flex align-items-center reject-request"><iconify-icon
                                            icon="line-md:menu-to-close-transition" width="16"
                                            height="16"></iconify-icon></button>
                                    <button type="button" data-inviter-id="<?= $request["users.id"] ?>"
                                        class="btn btn-success rounded-circle p-1 d-flex align-items-center accept-request"><iconify-icon
                                            icon="line-md:confirm" width="16" height="16"></iconify-icon></button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if (count($notifications)) { ?>
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <a href="/notifications.php" class="text-decoration-none">
                    <h4 class="my-0 fw-normal d-flex align-items-center">
                        <iconify-icon icon="line-md:bell" width="32" height="32"></iconify-icon>Notifications
                    </h4>
                </a>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-1 align-items-center justify-content-center">
                    <div class="list-group w-100">
                        <?php foreach ($notifications as $notification) { ?>
                            <a href="/notifications.php?id=<?= $notification["id"] ?>"
                                class="list-group-item list-group-item-action d-flex gap-2 ps-1 w-100" aria-current="true">
                                <iconify-icon icon="line-md:circle-to-confirm-circle-transition"
                                    class="text-<?= $notification["is_seen"] == 1 ? "secondary" : "success" ?>" width="24"
                                    height="24"></iconify-icon>
                                <div class="d-flex w-100 justify-content-between gap-1">
                                    <p class="mb-0" style="font-size:12px">
                                        <?= $notification["text"] ?>
                                    </p>
                                    <small class="opacity-50 text-nowrap">
                                        <?= getTimeDifference($notification["created_at"]) ?>
                                    </small>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php if (count($friends)) { ?>
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <a href="/friends.php" class="text-decoration-none">
                    <h4 class="my-0 fw-normal d-flex align-items-center">
                        <iconify-icon icon="line-md:account-small" width="32" height="32"></iconify-icon>Friends
                    </h4>
                </a>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-1 align-items-center justify-content-center">
                    <div class="list-group w-100">
                        <?php foreach ($friends as $friend) { ?>
                            <a href="/profile.php?id=<?= $friend["id"] ?>"
                                class="list-group-item list-group-item-action d-flex align-items-center gap-2 ps-1 w-100"
                                aria-current="true">
                                <?php if ($friend["picture"]) { ?>
                                    <img src="<?= $friend["picture"] ?>" alt="mdo" width="32" height="32" class="rounded-circle"
                                        style="object-fit:cover;">
                                <?php } else { ?>
                                    <iconify-icon icon="heroicons:rocket-launch-solid" width="24" height="24"
                                        class="text-danger"></iconify-icon>
                                <?php } ?>

                                <p class="mb-0">
                                    <?= filter_var($friend["name"] . " " . $friend["last_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                                </p>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>