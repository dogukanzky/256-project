<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
if (!isset($_SESSION["user_id"])) {
    header("Location: /login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    $postsModel = new PostsModel($db);
    $res = $postsModel->getFeed($_SESSION["user_id"], $page, $size);

    header("Content-Type: application/json");
    echo json_encode($res);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>
    <div class="d-flex flex-column align-items-center gap-3" id="post-list">
        <a href="new-post.php"
            class="btn btn-outline-primary border border-2 border-primary d-flex align-items-center justify-content-center"
            style="width:600px;border-style:dashed!important;"><iconify-icon icon="line-md:plus" width="24"
                height="24"></iconify-icon> Create New
            Post</a>
    </div>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
    <script src="/src/common/js/feed/render.js" crossorigin="anonymous"></script>
    <script src="/src/common/js/feed/fetch.js" crossorigin="anonymous"></script>
    <?php
    if (isset($_GET) && isset($_GET["alert"])) {
        ?>
        <script>
            $(function () {
                showToast({
                    title: "",
                    description: "<?= $_GET["alert"] == 1 ? "Post deleted successfully!" : "" ?>",
                    color: "<?= $_GET["alert"] == 1 ? "danger" : "" ?>"
                });
            });
        </script>
    <?php } ?>
</body>

</html>