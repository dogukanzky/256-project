<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
$userModel = new UsersModel($db);
$friends = $userModel->getFriends($_SESSION["user_id"]);
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
                icon="line-md:account-small"></iconify-icon>Friends
        </h1>
    </div>
    <div class="container">
        <div class="row row-cols-2">
            <?php foreach ($friends as $friend) { ?>
                <div class="col my-1" data-user-id="<?= $friend["id"] ?>">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 text-decoration-none">
                                <?php if (isset($friend["picture"]) && $friend["picture"]) { ?>
                                    <img src="<?= $friend["picture"] ?>" alt="mdo" width="32" height="32"
                                        style="object-fit:cover;" class="rounded-circle">
                                <?php } else { ?>
                                    <iconify-icon icon="heroicons:rocket-launch-solid" width="32" height="32"
                                        class="text-danger"></iconify-icon>
                                <?php } ?>
                                <a href="/profile.php?id=<?= $friend["id"] ?>"
                                    class="d-flex align-items-stretch gap-2 text-decoration-none" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Visit Page"><?= filter_var($friend["name"] . " " . $friend["last_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></a>
                                <div class="d-flex justify-content-end flex-grow-1">
                                    <button class="btn btn-danger d-flex align-items-center gap-1 removeFriend"
                                        data-user-id="<?= $friend["id"] ?>" type="button"><iconify-icon
                                            icon="line-md:account-delete"></iconify-icon>Remove
                                        Friend</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>






    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
    <script>
        $(".removeFriend").on("click", "", function () {
            const id = $(this).attr("data-user-id");

            showDeleteModal({
                title: "Are you sure you want to remove friend?",
                onAccept: function () {
                    $.ajax({
                        method: "DELETE",
                        url: "/friend-requests.php", // PHP script to handle the removal of friend
                        data: {
                            inviter_id: id
                        }
                    }).done(function (data, res, opt) {
                        if (res === "success") {
                            showToast({
                                title: "",
                                description: "Friend removed successfully!",
                                color: "success",
                            });
                            $(`[data-user-id=${id}]`).remove();
                        }
                    });
                },
            });



        });
    </script>
</body>

</html>