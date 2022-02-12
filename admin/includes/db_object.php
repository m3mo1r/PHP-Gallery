<?php
class Db_Object {
    public $errros        = [];
    public $upload_errors = [
        UPLOAD_ERR_OK         => "There is no error.",
        UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize directives.",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the max_file_size directives.",
        UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION  => "The PHP extension stopped the file uploading."
    ];
    
    public static function find_rows($sql) {
        global $db;
        $res = $db->query_db($sql);
        $res_array = [];
        while($row = $res->fetch_assoc()) {
            $res_array[] = static::instantation($row);
        }
        
        return $res_array;
    }
    
    public static function find_all() { return static::find_rows("SELECT * FROM " . static::$db_table . " ");}
    public static function find_by_id($id, $field_id) {
        $db_table = static::$db_table;
        $res_array = static::find_rows("SELECT * FROM {$db_table} WHERE {$field_id} = {$id} LIMIT 1 ");
        return !empty($res_array) ? array_shift($res_array) : false;
    }
    
    public static function instantation($found_row) {
        global $db;
        $called_class = get_called_class();
        $res = new $called_class;
        
        foreach($found_row as $property => $value) {
            if($res->has_property($property))
                $res->$property = $db->escape($value);
        }
        return $res;
    }
    
    private function has_property($prop) {
        $obj = get_object_vars($this);
        return array_key_exists($prop, $obj);
    }
    
    protected function properties() {
        global $db;
        
        $properties = [];
        foreach(static::$db_fields as $db_field) {
            if(property_exists($this, $db_field))
                $properties[$db_field] = $db->escape($this->$db_field);
        }
        return $properties;
    }
    
    public function create() {
        global $db;
        $properties       = $this->properties();
        $db_column_values = implode("', '", array_values($properties));
        $db_column_keys   = implode(', ', array_keys($properties));
        $db_name          = static::$db_table;
        
        $sql  = "INSERT INTO {$db_name} ({$db_column_keys}) ";
        $sql .= "VALUES ('{$db_column_values}') ";
        
        if($db->query_db($sql)) {
//            $this->user_id = $db->get_insert_id();
            return true;
        } else
            return false;
    }
    
    public function update($id, $field_id) {
        global $db;
        $properties         = $this->properties();
        $property_pairs     = [];
        foreach($properties as $key => $value)
            $property_pairs[] = "{$key} = '{$value}'";
        
        $db_column          = implode(', ', $property_pairs);
        $db_name            = static::$db_table;
        
        $sql  = "UPDATE {$db_name} SET {$db_column} ";
        $sql .= "WHERE {$field_id} = {$id} ";
        
        $db->query_db($sql);
        return $db->get_affected_rows() === 1 ? true : false;
    }
    
    public function delete($id, $field_id) {
        global $db;
    
        $sql  = "DELETE FROM " . static::$db_table . " ";
        $sql .= "WHERE {$field_id} = '{$id}' LIMIT 1 ";
        
        $db->query_db($sql);
        return $db->get_affected_rows() === 1 ? true : false;
    }
    
    public function save() {}
    
    public static function index() {
        global $db;
        $sql = "SELECT * FROM " . static::$db_table . " ";
        $res = $db->query_db($sql);
        
        return $res->num_rows;
    }
}
?>