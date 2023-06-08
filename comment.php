<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
$commentModel = new CommentsModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle GET request
    header("Location: /index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["user_id"])) {
    // Get the inviter and invited IDs
    extract($_POST);
    $user_id = $_SESSION["user_id"];

    $new_id = $commentModel->create($user_id, $post_id, $text);
    $new_comment = $commentModel->findOne($new_id);
    $new_comment["is_owned"] = $new_comment["user_id"] == $user_id;
    header("Content-Type: application/json");
    echo json_encode($new_comment);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'PATCH' && isset($_SESSION["user_id"])) {
    // Get the inviter and invited IDs
    parse_str(file_get_contents('php://input'), $_PATCH);
    extract($_GET);

    $canEdit = $commentModel->checkUserOwnComment($_SESSION["user_id"], $id);
    if ($canEdit) {
        $commentModel->update($id, $_PATCH["text"]);
        header("HTTP/1.1 200 OK");
    } else {
        header("HTTP/1.1 400 Unauthorized");
    }
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_SESSION["user_id"])) {
    parse_str(file_get_contents('php://input'), $_DELETE);
    extract($_GET);
    $canDelete = $commentModel->checkUserOwnComment($_SESSION["user_id"], $id);

    if ($canDelete) {
        $commentModel->delete($id);
        header("HTTP/1.1 200 OK");
    } else {
        header("HTTP/1.1 400 Unauthorized");
    }

    exit();
}

?>