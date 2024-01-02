<?php 
class Pricebook_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }
	public function GetPriceBookList($limit,$start){
        $this->db->select('*')->from('tbl_pricebook');
        $this->db->limit($limit,$start);
        $this->db->order_by('id','desc');
        return $this->db->get()->result();
    }
    public function ViewPriceBookListById($id){
        return $this->db->where(array('pricebookId'=>$id))->get('tbl_pricebook_list')->result();
    }
    public function ViewPriceBookById($id){
        return $this->db->where(array('id'=>$id))->get('tbl_pricebook')->row();
    }
    

    public function getPriceBookDet()
    {
        return $this->db->get('tbl_pricebook')->result();
        
    }
    public function GetPriceBookListDetail()
    {
        return $this->db->get('tbl_pricebook_list')->result();
       
    }
    public function insertPriceBook($data){

    $this->db->insert('tbl_pricebook',$data);

      return $this->db->insert_id();

    }
    public function insertPriceBookList($data)
    {
        
         return $this->db->insert('tbl_pricebook_list',$data);
    }
    public function insertProductlist($data)
    {

       return $this->db->get('tbl_products',$data)->result();
    }
    public function getPriceBookBasedOnId()
    {
        return $this->db->select('PB.*')->from('tbl_pricebook as PB');
        $this->db->join('tbl_pricebook_list as PBL','PB.id=>PBL.pricebookId');
        $this->db->join('tbl_products as PRD');
        return $this->db->get()->result();
    }
     public function getAllActiveProducts()
     {
        return $this->db->select('PRD.*,GRP.name as group_name,UOM.uom as unit_of_measure')->from('tbl_products as PRD')->join('tbl_group as GRP','GRP.id=PRD.group','left')->join('tbl_uom as UOM','UOM.id=PRD.uom','left')->where(array('PRD.status'=>1))->get()->result();
    }
    public function getPriceBookStatus($id)
    {
        return $this->db->where('id',$id)->get('tbl_pricebook')->result();
    }
    public function getPriceBookListStatus($id)
    {
       return $this->db->where('pricebookId',$id)->get('tbl_pricebook_list')->result();

    }
    public function getPriceBookupdateStatus($id){
        $status="1";
        $resp=$this->db->where('id',$id)->get('tbl_pricebook')->row();
        if(!empty($resp)){$status=$resp->status;}
        return $status;
    }
    
    public function getProductCodeByID($data){
        $productCode="---";
        $resp=$this->db->where('productName',$data)->get('tbl_products')->row();
        if(!empty($resp)){$productCode=$resp->productCode;}
        return $productCode;
    }
     public function getProductsList($id)
    {
        return $this->db->where('id',$id)->get('tbl_products')->result();
    }
    public function updatePriceBook($id,$data)
    {
        return $this->db->where('id',$id)->set($data)->update('tbl_pricebook');
    }

     public function deletePricebook($id){
        $this->db->where('id',$id)->delete('tbl_pricebook');
        $this->db->where('pricebookId',$id)->delete('tbl_pricebook_list');
        return true;
    }
    public function deletePriceBookList($id)
    {
        return $this->db->where('pricebookId',$id)->delete('tbl_pricebook_list');
    }

   

    
}