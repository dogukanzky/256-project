<?php

class CommentsModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function findOne($id, $user_id = 0)
    {
        $sql = "SELECT c.*,u.picture as \"user.picture\", u.name as \"user.name\",
        u.last_name as \"user.last_name\" FROM comments c JOIN users u ON c.user_id = u.id WHERE c.id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $success = $this->db->query("DELETE FROM comments WHERE id = $id");
        return $success;
    }
    public function create($user_id, $post_id, $text)
    {
        $sql = "INSERT INTO comments (text, user_id, post_id) values (?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$text, $user_id, $post_id]);
        return $this->db->lastInsertId();
    }
    public function update($id, $text)
    {
        $sql = "UPDATE comments SET text = ? WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$text]);
        return $this->db->lastInsertId();
    }

    public function findPostComments($post_id)
    {
        $sql = "SELECT c.* ,u.picture as \"user.picture\", u.name as \"user.name\",
        u.last_name as \"user.last_name\" FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = $post_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkUserOwnComment($user_id, $comment_id)
    {

        $comment = $this->findOne($comment_id);

        return $comment["user_id"] == $user_id;

    }

}
?>