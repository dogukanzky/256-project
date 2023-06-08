<?php

class NotificationsModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function findOne($id, $user_id)
    {
        $sql = "SELECT * FROM notifications WHERE id = ? AND user_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($user_id, $text, $refer_to)
    {
        $sql = "INSERT INTO notifications (text, user_id, refer_to) values (?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$text, $user_id, $refer_to]);
        return $this->db->lastInsertId();
    }
    public function read($id)
    {
        $sql = "UPDATE notifications SET is_seen = 1 WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function findAllUserNotifications($user_id, $limit = 0)
    {
        $sql = "SELECT * FROM notifications WHERE user_id = $user_id ORDER BY created_at DESC";

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}
?>