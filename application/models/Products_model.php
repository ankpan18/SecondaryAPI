<?php

class Products_model extends CI_Model {
    private $table = 'Products';
    private $prod_id;
    function __construct()
    {
        parent::__construct();
        $this->load->model("Images_model");
        $this->prod_id=1;
    }

    public function saveProductBatch($cat_id,$products){
        
        $data =array();
        $imagesdata =array();
        
        for($i=0; $i<count($products); $i++) 
        {
            
            $data[$i] = array('prod_id' => $this->prod_id,
            'sku' =>$products[$i]["sku"],
            'cat_id'=>$cat_id,
            'name'=>$products[$i]["name"],
            'salePrice'=>$products[$i]["salePrice"],
            'digital'=>$products[$i]["digital"],
            'shippingCost'=>$products[$i]["shippingCost"],
            'description'=>$products[$i]["description"],
            'customerReviewCount'=>$products[$i]["customerReviewCount"]
            );

            $imagesdata =array_merge($imagesdata,$this->Images_model->processImagedata($this->prod_id,$products[$i]));
            $this->prod_id++;   
        }
        $this->db->insert_batch($this->table, $data);
        $this->Images_model->saveImageBatch($imagesdata);
    }

    public function saveProduct($cat_id,$product){
        
        $data = array('sku' =>$product["sku"],
            'cat_id'=>$cat_id,
            'name'=>$product["name"],
            'salePrice'=>$product["salePrice"],
            'digital'=>$product["digital"],
            'shippingCost'=>$product["shippingCost"],
            'description'=>$product["description"],
            'customerReviewCount'=>$product["customerReviewCount"]
        );
        $this->db->insert($this->table,$data);

        $data =$this->Images_model->processImagedata($this->prod_id,$product);
        $this->Images_model->saveImageBatch($data);
        $this->prod_id++;   
    } 

    public function truncate(){
        $this->db->where("prod_id!=","NULL")->delete($this->table);
    }

}

?>