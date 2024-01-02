<?php
class Pricebook extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->common_model->check_login();

		$this->load->model("pricebook_model");
		$this->load->model("inventory_model");
	}

	public function listPriceBook(){

		$data['page_name']='List Price Book';
		$data['sub_page']='pricebook/listPricebook';
		$config['base_url'] = base_url()."pricebook/listPriceBook"; 
		$config['total_rows'] = $this->common_model->getTotalRecords('tbl_pricebook','');
		$config['per_page'] = PAGINATION_COUNT; 
		$config=$this->common_model->paginationStyle($config);
		$this->pagination->initialize($config); 
		$lmt=0;
		$lmt=$this->uri->segment(3);
		
		$data['price_book'] = $this->pricebook_model->GetPriceBookList($config['per_page'],$lmt);
		$this->load->view('user_index',$data);
	}
	public function viewPricebookList($id){
		$id=$this->common_model->decode($id);
        $data['page_name']='List Price Book';
		$data['sub_page']='pricebook/viewPricebookList';
		$data['price_book_details']=$this->pricebook_model->ViewPriceBookById($id);
		$data['price_booklist'] = $this->pricebook_model->ViewPriceBookListById($id);
		$this->load->view('user_index',$data);
	
	}
	public function addPriceBook(){
        $data['page_name']='Add Price Book';
		$data['sub_page']='pricebook/addPriceBook';
		$data['price_book']=$this->pricebook_model->getPriceBookDet();
		$data['price_book_list']=$this->pricebook_model->GetPriceBookListDetail();

		$count=$this->common_model->get_general_settings('Pricebook_Count');
		
		$this->load->view('user_index',$data);
    }
    public function editPriceBookList($id){
		$id=$this->common_model->decode($id);
        $data['page_name']='Edit Price Book';
		$data['sub_page']='pricebook/editPriceBookList';
		$data['product_details']= $this->pricebook_model->getAllActiveProducts();
		$data['price_book_details']=$this->pricebook_model->getPriceBookStatus($id);
		$data['price_booklist'] = $this->pricebook_model->getPriceBookListStatus($id);
		$this->load->view('user_index',$data);
	}
	
    public function deletePricebook($id){
    	$id=$this->common_model->decode($id);
		$data=$this->pricebook_model->getPriceBookStatus($id);
		$data_st=$this->pricebook_model->getPriceBookListStatus($id);
		$logs=array('data'=>$data,'data_st'=>$data_st,'deleted_id'=>$id);
		$this->common_model->CommentsLog(json_encode($logs));
		$this->pricebook_model->deletePricebook($id);
    	$array=array('status'=>true,'Mess'=>'Deleted Successfully!');
    	echo json_encode($array);exit;
    }

   

    public function createPriceBook()
    {
    	if(isset($_POST['PriceBook_Inv']))
    	{
    		$price_book_code=$this->security->xss_clean($this->input->post('price_book_code'));
    		$price_book_name=$this->security->xss_clean($this->input->post('price_book_name'));
    		$scheme_code=$this->security->xss_clean($this->input->post('scheme_code'));
    		$description=$this->security->xss_clean($this->input->post('description'));


    		$last_table_count=$this->security->xss_clean($this->input->post('last_table_count'));
			$pb_product_id=$this->security->xss_clean($this->input->post('pb_product_id'));
    		$product_code=$this->security->xss_clean($this->input->post('product_code'));
    		
    		$product_sku=$this->security->xss_clean($this->input->post('product_sku'));

			$product_name=$this->security->xss_clean($this->input->post('product_name'));

			$product_name=$this->security->xss_clean($this->input->post('pb_product_name'));
    		$product_hsncode=$this->security->xss_clean($this->input->post('product_hsncode'));
    		$pb_mrp=$this->security->xss_clean($this->input->post('pb_mrp'));
    		$pb_discount=$this->security->xss_clean($this->input->post('pb_discount'));
    		$pb_dpprice=$this->security->xss_clean($this->input->post('pb_dpprice'));
    		$pb_damagediscount=$this->security->xss_clean($this->input->post('pb_damagediscount'));
    		$pb_bv=$this->security->xss_clean($this->input->post('pb_bv'));
    		 
    		$i=0;$len=count($pb_product_id);
    		if (!empty($price_book_code)) {
    			$status_code='1';
    			}else{
    				$status_code='0';
    			}

    		$count=$this->common_model->get_general_settings('Pricebook_Count');
    		$price_book=array(
    			'pricebookCode'=>$price_book_code,
    			'pricebookName'=>$price_book_name,
    			'pricebookDescription'=>$description,
    			'createdBy'=>$this->session->userdata('user_id'),
    			'createdAt'=>date('Y-m-d h:i:s'),	
    			'status'=>$status_code,
    			
				);
    			$pricebook_tbl= $this->pricebook_model->insertPriceBook($price_book);

    			
    			for($i=0;$i<$len;$i++){
    				$pricebooklist=array(

    				'pricebookId'=>$pricebook_tbl,
    				'productName'=>$product_name[$i],
    				'productId'=>$pb_product_id[$i],
    				
    				'MRP'=>$pb_mrp[$i],
					'discount'=>$pb_discount[$i],
					'DPPrice'=>$pb_dpprice[$i],
					'damageDiscount'=>$pb_damagediscount[$i],
					'BV'=>$pb_bv[$i],		
					'updatedAt'=>date('Y-m-d h:i:s'),
				);
				 $this->pricebook_model->insertPriceBookList($pricebooklist);

    		}
    	
    		$this->common_model->updateEmpCount('Pricebook_Count');
			$this->session->set_flashdata('success','PriceBook Created Successfully');
            redirect(base_url().'pricebook/listPriceBook');
        }
		 else {
			$this->session->set_flashdata('error','Invalid Request');
            redirect(base_url().'pricebook/listPriceBook');
		}

    	}
    	public function updatePriceBook()
    	{
    		if(isset($_POST['PriceBook_Inv_Update']))
    		{
    		$price_book_code=$this->security->xss_clean($this->input->post('price_book_code'));
    		$update_id=$this->security->xss_clean($this->input->post('update_id'));
    		$price_book_name=$this->security->xss_clean($this->input->post('price_book_name'));
    		$scheme_code=$this->security->xss_clean($this->input->post('scheme_code'));
    		$description=$this->security->xss_clean($this->input->post('description'));

    		$last_table_count=$this->security->xss_clean($this->input->post('last_table_count'));

    		$pbl_product_id=$this->security->xss_clean($this->input->post('pbl_product_id'));
    		$pbl_product_name=$this->security->xss_clean($this->input->post('pbl_product_name'));
    		$pbl_mrp=$this->security->xss_clean($this->input->post('pbl_mrp'));
    		$pbl_discount=$this->security->xss_clean($this->input->post('pbl_discount'));
    		$pbl_dpprice=$this->security->xss_clean($this->input->post('pbl_dpprice'));
    		$pbl_damagediscount=$this->security->xss_clean($this->input->post('pbl_damagediscount'));
    		$pbl_bv=$this->security->xss_clean($this->input->post('pbl_bv'));

    		$i=0;$len=count($pbl_product_id);
    		if(empty($update_id)){
    			
				$this->session->set_flashdata('warning','Something Went Wrong');
            	redirect(base_url().'PriceBook/listPriceBook');exit;
			}
			

			$old_status=$this->pricebook_model->getPriceBookupdateStatus($update_id);

			$price_book=array(
    			'pricebookCode'=>$price_book_code,
    			'pricebookName'=>$price_book_name,
    			'pricebookDescription'=>$description,
    			'createdBy'=>$this->session->userdata('user_id'),
    			'createdAt'=>date('Y-m-d h:i:s'),	
    			'status'=>'1',
    			
				);
    			$this->pricebook_model->updatePriceBook($update_id,$price_book);
				$this->pricebook_model->deletePriceBookList($update_id);
				if(!empty($update_id)){
					if(empty($len)){
    			echo $update_id;
				$this->session->set_flashdata('warning','No Records is to be updated add records');
            	redirect(base_url().'PriceBook/listPriceBook');exit;
			}
			else{
				for($i=0;$i<$len;$i++){
					$pricebooklist=array(
    				'pricebookId'=>$update_id,
    				'productName'=>$pbl_product_name[$i],
    				'productId'=>$pbl_product_id[$i],
    				'MRP'=>$pbl_mrp[$i],
					'discount'=>$pbl_discount[$i],
					'DPPrice'=>$pbl_dpprice[$i],
					'damageDiscount'=>$pbl_damagediscount[$i],
					'BV'=>$pbl_bv[$i],		
					'updatedAt'=>date('Y-m-d h:i:s'),	
    				);
    		 	 $this->pricebook_model->insertPriceBookList($pricebooklist);
			}}

    			
    		}
    		$this->session->set_flashdata('success','PriceBook Updated Successfully');
            redirect(base_url().'pricebook/listPriceBook');

    		}
    	}
	
}