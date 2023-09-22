<?php

class Shop_model extends CI_Model {
    // private $cat = 'Categories';
    // private $prod = 'Products';
    // private $img = 'Images';
    // private $prod_id;
    function __construct()
    {
        parent::__construct();
      //  $this->load->model("Images_model");
      //$this->prod_id=1;
    }

    public function category_data($limit,$page) 
    {
        $this->db->select(' Categories.cat_id as `categoryID`,Categories.name');
        // $this->db->select('Count(Products.cat_id)');
        $this->db->join('Products', 'Products.cat_id = Categories.cat_id ','left');
        $this->db->group_by('Categories.cat_id');
        $this->db->order_by('Count(Products.cat_id) DESC');
        $this->db->limit($limit, $page*$limit-$limit);
        
        
        $resp=$this->db->get('Categories')->result();
        if($resp!="")
        {
            return $resp;
        }
        else{
            return NULL;
        }
    }
 
    public function product_data($cat_id,$limit,$page)
    {
        $this->db->select('Products.prod_id,Products.name,Products.sku, Products.salePrice, Products.description, Products.customerReviewCount');
        $this->db->from('Products');
        $this->db->where('cat_id', $cat_id);
        $this->db->limit($limit, $page * $limit - $limit);
        $this->db->order_by('Products.customerReviewCount DESC');
        $resp = $this->db->get()->result();
        if($resp!="")
        {
            return $resp;
        }
        else{
            return NULL;
        }
    }

    public function images_data($resp)
    {
        for($i=0;$i<count($resp);$i++){
            $product=$resp[$i];
            
            $this->db->select('Images.href');
            $this->db->from('Images');
            $this->db->where('prod_id', $product->prod_id);
            $images = $this->db->get()->result();
            
            $product->images = $images;
            unset($product->prod_id);
        }
        if($resp!="")
        {
            return $resp;
        }
        else{
            return NULL;
        }
    }

}

?>