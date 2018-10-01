<?php

/**
 * Created by PhpStorm.
 * User: Duck
 * Date: 23/12/2016
 * Time: 12:02
 */
$user = new User();
class ForumDennis
{
    private $db;

    function __construct() {
        $this->db = Database::getInstance();
    }

    public function getdb() {
        return $this->db;
    }

    public function getCategories(){
        $sql = "SELECT *
                FROM tbl_forum";
        $records = $this->getdb()->pdo->query($sql);
        $records = $records->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }

    public function createThreadTitle($title, $user_id, $forum_id){
        $sql = "INSERT INTO `tbl_thread` (`thread_subject`, `fk_user_id`, `fk_forum_id`)
        VALUES (:title, :user_id, :forum_id)
         ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(":title",$title);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":forum_id", $forum_id);
        $stmt->execute();
        $lastId = $this->db->pdo->lastInsertId();
        return $lastId;
    }

    public function createThreadPost($message, $user_id, $thread_id)
    {
        $sql = "INSERT INTO `tbl_post` (`post_message`, `fk_user_id`, `fk_thread_id`)
        VALUES (:message, :user_id, :thread_id)
         ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":thread_id", $thread_id);
        $stmt->execute();
    }
    public function createPost($message, $thread_id ,$user_id)
    {
        $dateNow = date('Y-m-d');

        $sql = "INSERT INTO `tbl_post` (`post_message`, `post_date_created` , `fk_thread_id`, `fk_user_id` )
        VALUES (:post_message, :post_date_created , :fk_thread_id, :fk_user_id)
         ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(":post_message", $message);
        $stmt->bindParam(":post_date_created", $dateNow);
        $stmt->bindParam(":fk_thread_id", $thread_id);
        $stmt->bindParam(":fk_user_id", $user_id);
        $stmt->execute();
    }

}