<?php
require_once("model/Manager.php");

class CommentManager extends Manager {
    
    // Get all comments from the comments SQL tab
    public function getComments($postId) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    // Set the new comment in the comment SQL tab
    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    
    // Edit a selected comment from the comment SQL tab
    public function editComment($postId, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET comment = ?, comment_date= NOW() WHERE id = ?');
        $affectedLines = $comments->execute(array($comment, $postId));
    
        return $affectedLines;
    }
}