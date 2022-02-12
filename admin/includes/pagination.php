<?php
class Pagination {
//    public $total_items;
//    public $items_per_page;
//    public $current_page;
//            
//    public function __construct($total_items = 0,$items_per_page = 4,$current_page = 1) {
//        $this->total_items    = $total_items;
//        $this->items_per_page = $items_per_page;
//        $this->current_page   = $current_page;
//    }
        public function __construct(
            public $total_items = 0,
            public $items_per_page = 4,
            public $current_page = 1
        ) {}
    
    public function next() { return $this->current_page + 1;}
    public function prev() { return $this->current_page - 1;}
    public function pages() { return ceil($this->total_items / $this->items_per_page);}
    public function has_prev() { return $this->prev() >= 1 ? true : false;}
    public function has_next() { return $this->next() <= $this->pages() ? true : false;}
    public function offset() { return ($this->current_page - 1) * $this->items_per_page;}
}
?>