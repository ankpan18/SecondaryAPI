<?php
   
require APPPATH . 'libraries/REST_Controller.php';
class Shop extends REST_Controller {
    
	  
    function __construct() {
       parent::__construct();
    //    $this->load->database();
        $this->load->model('Shop_model');
        header('Access-Control-Allow-Origin: *');
        header("Content-Type:application/json");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method , Authentication");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    }
       
  
	public function index_get()
	{
        /*$postdata = file_get_contents("php://input");
        $request = json_decode($postdata,true); */
        
        $res= array('message'=>'Api is running');
        $this->response($res);
	}

    public function categories_get($limit,$page)
    {
        //Automatically returning result from page one if page number is less than 1
        if ($page<1)
        {
        $page=1;
        }
    //     $this->db->select(' Categories.cat_id as `categoryID`,Categories.name');
    //     // $this->db->select('Count(Products.cat_id)');
    //     $this->db->join('Products', 'Products.cat_id = Categories.cat_id ','left');
    //     $this->db->group_by('Categories.cat_id');
    //     $this->db->order_by('Count(Products.cat_id) DESC');
    //     $this->db->limit($limit, $page*$limit-$limit);
    // 
        
    //     $resp=$this->db->get('Categories')->result();

        $resp=$this->Shop_model->category_data($limit,$page);
        if($resp!="")
        {
        $result = array('page'=>$page,'categories' =>$resp);
         }
         else{
            $result = array('page'=>$page,'message' =>'Server Error','responsecode'=>'500');
         }
         $this->response($result); 
        }
        
        public function products_get($cat_id,$limit,$page)
        {
            
            //JOin
            if ($page<1)
            {

            $page=1;
            }
            // $this->db->select('Products.prod_id,Products.name,Products.sku, Products.salePrice, Products.description, Products.customerReviewCount');
            // $this->db->from('Products');
            // $this->db->where('cat_id', $cat_id);
            // $this->db->limit($limit, $page * $limit - $limit);
            // $this->db->order_by('Products.customerReviewCount DESC');
            // $resp = $this->db->get()->result();

            $resp=$this->Shop_model->product_data($cat_id,$limit,$page);
        
        
        
        if($resp!="")
        {
            // for($i=0;$i<count($resp);$i++){
            //     $product=$resp[$i];
                
            //     $this->db->select('Images.href');
            //     $this->db->from('Images');
            //     $this->db->where('prod_id', $product->prod_id);
            //     $images = $this->db->get()->result();
                
            //     $product->images = $images;
            //     unset($product->prod_id);
            // }
            $resp=$this->Shop_model->images_data($resp);
            $result2 = array('page'=>$page,'products' =>$resp);
        }
        else
        {
            $result2 = array('page'=>$page,'message ' =>"Server Error",'responsecode'=>'500');

        }
        $this->response($result2); 
        
    }

    	
}