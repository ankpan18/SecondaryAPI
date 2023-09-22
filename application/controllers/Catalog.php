<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catalog extends CI_Controller
{
    public $api_token;
    private $ch;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Categories_model');
        $this->load->model('Products_model');
        $this->load->model('Images_model');
        
    }
    private function getCategories($page=1){
        
        $api_url="https://stageapi.monkcommerce.app/task/categories?page=$page&limit=100";
        
        curl_setopt($this->ch, CURLOPT_URL,$api_url);
        $result=curl_exec($this->ch);
        // $response= json_decode(json_encode(json_decode($result)), True);
        $response= json_decode($result,True);
        
        
        return $response['categories'];
    }
    
    
    
    
    private function getProducts($cat_id,$page=1){
        
        $api_url="https://stageapi.monkcommerce.app/task/products?categoryID=$cat_id&page=$page&limit=100";
        // echo $api_url;
        
        curl_setopt($this->ch, CURLOPT_URL,$api_url);
        $result=curl_exec($this->ch);
        // $response= json_decode(json_encode(json_decode($result)), True);
        $response= json_decode($result, True);
        
        return $response["products"];
    }
    
    
    

    public function index() {
        $apikey=$this->db->select("api_key")->where("id",1)->from("config")->get()->result()[0]->api_key;
        
        
        $this->Images_model->truncate();
        $this->Products_model->truncate();
        $this->Categories_model->truncate();
        $cat_page=0;

        

        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: $apikey"
        ));
        
        $start_time = microtime(TRUE);
        
        while(TRUE){
            $cat_page++;
            $categories= $this->getCategories($cat_page);
            if($categories==NULL) break;
            
            print_r(count($categories));
            echo "<br>";
            // print_r($categories);
            foreach($categories as $category)
            {
                $prod_page=0;

                $this->Categories_model->saveCategory($category);
                
                while(TRUE){
                    $prod_page++;
                    $products=$this->getProducts($category["id"],$prod_page);
                    if($products==NULL) break;
                    
                    
                    $this->Products_model->saveProductBatch($category["id"],$products);
                    
                    // foreach($products as $product)
                    // {
                    //     $this->Products_model->saveProduct($category["id"],$product);
                    // }
                    
                }
                
            }

            // break;
        }

        $end_time = microtime(TRUE);
        echo $end_time - $start_time; 
        echo "<br>";
        echo "<br>";        

        curl_close($this->ch);
    }
    
   
}
?>