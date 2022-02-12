<?php
class Comment extends Db_Object {
    protected static $db_table  = 'comments';
    protected static $db_fields = ['comment_photo_id', 'comment_author', 'comment_body', 'comment_photo', 'comment_date'];
    
    public $comment_id;
    public $comment_photo_id;
    public $comment_author;
    public $comment_body;
    public $comment_date;
    
    public static function create_comment($photo_id, $author, $body) {
        if(!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment                   = new self;
            $comment->comment_photo_id = (int)$photo_id;
            $comment->comment_author   = $author;
            $comment->comment_body     = $body;
            $comment->comment_date     = date("Y-m-d H:i:s");
            
            return $comment;
        } else
            return false;
    }
    
    public static function find_photo_comments($photo_id = 0) {
        global $db;
        $db_table  = self::$db_table;
        $photo_id  = $db->escape($photo_id);
        
        $sql  = "SELECT * FROM {$db_table} ";
        $sql .= "WHERE comment_photo_id = {$photo_id} ";
        $sql .= "ORDER BY comment_id ASC ";
        
        return self::find_rows($sql);
    }
    
    public function save() { $this->create();}
    
}
?>