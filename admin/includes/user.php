<?php
class User extends Db_Object {
    protected static $db_table  = 'users';
    protected static $db_fields = ['user_name', 'user_password', 'user_firstname', 'user_lastname', 'user_photo'];
    public $user_id;
    public $user_name;
    public $user_password;
    public $user_firstname;
    public $user_lastname;
    public $user_photo;
    
    public $tmp_name;
    public $dir_name      = 'images';
    public $placeholder   = 'http://placehold.it/62&text=photo';
    
    public static function verify_user($usr, $pwd) {
        global $db;
        $usr = $db->escape($usr);
        $pwd = $db->escape($pwd);
        
        $sql  = "SELECT * FROM " . self::$db_table . " ";
        $sql .= "WHERE user_name = '{$usr}' AND user_password = '{$pwd}' ";
        $user = parent::find_rows($sql);
        return !empty($user) ? array_shift($user) : false;
    }
    
    public function constructor($name, $password, $firstname, $lastname) {
        global $db;
        $this->user_name      = $db->escape($name);
        $this->user_password  = $db->escape($password);
        $this->user_firstname = $db->escape($firstname);
        $this->user_lastname  = $db->escape($lastname);
    }
    
    public function set_file($file) {
        if(empty($file) || !$file && !is_array($file)) {
            $this->errros[] = $this->upload_errors[4];
            return false;
        }
        elseif($file['error']  != 0) {
            $this->errros[]     = $this->upload_errors[$file['error']];
            return false;
        } else {
            $this->user_photo   = basename($file['name']);
            $this->tmp_name     = $file['tmp_name'];
            return true;
        }
    }
    
    public function photo_path() { return $this->dir_name . DS . $this->user_photo;}
    public function user_photo_path() { return !empty($this->user_photo) ? $this->photo_path() : $this->placeholder;}
    
    public function save_photo() {
        if(!empty($this->errros))
            return false;

        if(empty($this->tmp_name) || empty($this->user_photo)) {
            $this->errros[] = 'The file was not available.';
            return false;
        }

        $upload_path        = ADMIN_PATH . DS . $this->photo_path();
        if(file_exists($upload_path)) {
            $this->errros[] = 'File has already existed.';
            return false;
        }

        if(move_uploaded_file($this->tmp_name, $upload_path)) {
            unset($this->tmp_name);
            return true;
        } else {
            $this->errros[] = 'Directory or file probably has permission problem!';
            return false;
        }
    }
    
    public function save() { return isset($this->user_id) ? $this->update($this->user_id, 'user_id') : $this->create();}
    
    public function delete_user() {
        if($this->delete($this->user_id, 'user_id')) {
            if(!empty($this->user_photo)) {
                $delete_path = ADMIN_PATH . DS . $this->photo_path();
                return unlink($delete_path) ? true : false;
            } else
                return true;
        } else
            return false;
    }
    
    public function ajax_save($user_id, $user_photo) {
        $this->user_id = $user_id;
        $this->user_photo = $user_photo;
        $this->save();
    }
    
    public function get_user_photos() {
        return Photo::find_rows("SELECT * FROM photos WHERE photo_user_id = {$this->user_id}");
    }
}
?>