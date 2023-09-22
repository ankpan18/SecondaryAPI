<?php

class Images_model extends CI_Model {
    private $table = 'Images';
    function __construct()
    {
        parent::__construct();
        
    }

    public function processImagedata($prod_id,$product){
        $data =array();
        for($i=0; $i<count($product["images"]); $i++) {
         
            $data[$i] = array(
                'prod_id' => $prod_id, 
                'href' => $product['images'][$i]["href"],
                );
        }

        return $data;
    }

    public function saveImageBatch($data){
        
        $this->db->insert_batch($this->table, $data);
    }

    public function saveImage($prod_id,$href){
        
        $data = array('prod_id' =>$prod_id,
                    'href'=>$href
                );
        $this->db->insert($this->table,$data);
    }

    public function truncate(){
        $this->db->where("prod_id!=","NULL")->delete($this->table);
    }

}

?>