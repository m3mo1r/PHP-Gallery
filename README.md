Leaning coding PHP OOP with Edwin Diaz.

# admin/includes/db.php
----------------------------------------------------------
## connect database
* can use mysqli object alternative custom database object
* affected_rows

# admin/includes/config.php
----------------------------------------------------------
## config file
* constants

# admin/includes/init.php
----------------------------------------------------------
## initialize file
* includes config, db file
* DOCUMENT_ROOT

# admin/includes/user.php
----------------------------------------------------------
* use static keyword
* trick loop pass property value -> db_column name == property name
> get_object_vars -> get array with all properties - values inside class
> array_key_exits -> check key exists in array
> array_shift -> first item
* array[]
* shorter constructor
> array_keys and array_values
> abstract with implode and explode (trick)
> property_exists


# admin/includes/functions.php
----------------------------------------------------------
* function __autoload -> check includes classes auto
* alternative __autoload -> spl_autoload_register
> file_exists -> is_file
> class_exists

# admin/includes/session.php
----------------------------------------------------------
> unset -> delete variable value

# admin/login.php
----------------------------------------------------------
> trim
> htmlentities in form input

# admin/includes/db_object.php
----------------------------------------------------------
## abstraction class
> get_called_class
> static:: -> late static binding

# admin/includes/photo.php
----------------------------------------------------------
> is_array
* handling error when upload
> unlink

# admin/includes/comment.php
----------------------------------------------------------
* explicit id with (int)

# admin/upload.php
----------------------------------------------------------
> join -> convert array to string

# admin/photos.php
----------------------------------------------------------
* trick foreach: endforeach;

# admin/users.php
----------------------------------------------------------
* col-offset
> str_repeat

# admin/js/scripts.js
----------------------------------------------------------
* prop and attr
* pop with split -> get last el of split arr
* location.reload
* confirm

# file permission
----------------------------------------------------------
* read(r - 4) - write(w - 2) - execute(x - 1) - none(- - 0)
* user - group - other
* sudo - chmod - chown

# something
----------------------------------------------------------
* bug load code php before redirect
* separate folder for user and photo
* save photo
* field name just use id
* index in db
* bug in photo.php message -> affected row bug
