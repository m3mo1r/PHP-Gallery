<?php
class Photo extends Db_Object {
    protected static $db_table  = 'photos';
    protected static $db_fields = ['photo_user_id','photo_title', 'photo_caption', 'photo_alt', 'photo_desc', 'photo_fname', 'photo_ftype', 'photo_fsize'];
    public $photo_id;
    public $photo_user_id;
    public $photo_title;
    public $photo_caption;
    public $photo_alt;
    public $photo_desc;
    public $photo_fname;
    public $photo_ftype;
    public $photo_fsize;
    
    public $tmp_name;
    public $dir_name      = "images";
    
    public function set_file($file) {
        if(empty($file) || !$file && !is_array($file)) {
            $this->errros[]    = $this->upload_errors[4];
            return false;
        }
        elseif($file['error'] != 0) {
            $this->errros[]    = $this->upload_errors[$file['error']];
            return false;
        } else {
            $this->photo_fname = basename($file['name']);
            $this->tmp_name    = $file['tmp_name'];
            $this->photo_ftype = $file['type'];
            $this->photo_fsize = $file['size'];
            
            return true;
        }
    }
    
    public function photo_path() { return $this->dir_name . DS . $this->photo_fname;}
    
    public function save() {
        if(isset($this->photo_id))
            $this->update($this->photo_id, 'photo_id');
        else {
            if(!empty($this->errros))
                return false;
            
            if(empty($this->tmp_name) || empty($this->photo_fname)) {
                $this->errros[] = 'The file was not available.';
                return false;
            }
            
            $upload_path        = ADMIN_PATH . DS . $this->photo_path();
            
            if(file_exists($upload_path)) {
                $this->errros[] = 'File has already existed.';
                return false;
            }
            
            if(move_uploaded_file($this->tmp_name, $upload_path)) {
                if($this->create()) {
                    unset($this->tmp_name);
                    return true;
                }
            } else {
                $this->errros[] = 'Directory or file probably has permission problem!';
                return false;
            }
        }
    }
    
    public function delete_photo() {
        if($this->delete($this->photo_id, 'photo_id')) {
            $delete_path = ADMIN_PATH . DS . $this->photo_path();
            return unlink($delete_path) ? true : false;
        } else
            return false;
    }
}
?>