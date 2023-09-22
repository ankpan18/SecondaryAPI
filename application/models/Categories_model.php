<?php

class Categories_model extends CI_Model {
    private $table = 'Categories';
    function __construct()
    {
        parent::__construct();
        
    }

    public function saveCategory($category){
        
        $data = array('cat_id' =>$category["id"],
        'name'=>$category["name"]
        );
        $this->db->insert($this->table,$data);
    } 

    public function truncate(){
        $this->db->where("cat_id!=","NULL")->delete($this->table);
    }

}

?>