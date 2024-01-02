<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"><?php echo $page_name;?></h4>

                <div class="page-title-right ">
                    <a href="<?php echo base_url()?>pricebook/listPriceBook"
                        class="btn btn-dark mr-3 btn-gradient waves-effect waves-light"><i
                            class="ri-arrow-left-fill"></i> Back</a>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form method="post" action="<?php echo base_url();?>Pricebook/updatePriceBook" onSubmit="return ValidateEmployee();">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Price Book Details</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md d-none">
                            <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="price_book_code" class="form-label">Price Book Code</label>
                                    <input type="text" name="price_book_code" id="price_book_code" readonly class="form-control"   value="<?php if(!empty($price_book_details)){foreach($price_book_details as $PBD){
                                        echo $PBD->pricebookCode ;} }?>" >
                                         <input type="hidden" value="<?php if(!empty($PBD->id)){ echo $PBD->id; }?>"  name="update_id">
                                    
                                    <span class="text-danger small"
                                        id="price_book_code_error"><?php echo form_error('price_book_code'); ?></span>

                                </div>
                            </div>
                            

                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="price_book_name" class="form-label">Price Book Name</label>
                                    <input type="text"  class="form-control" name="price_book_name" id="price_book_name" readonly value="<?php if (!empty($PBD->pricebookName)) {
                                        echo $PBD->pricebookName ;} ?>">
                                       
                                     
                                    <span class="text-danger small"
                                        id="price_book_name_error"><?php echo form_error('price_book_name'); ?></span>
                                </div>
                            </div>


                            <!--end col-->
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="scheme_code" class="form-label">Scheme Code</label>
                                    <input type="text" class="form-control" name="scheme_code" id="scheme_code">
                                    
                                    <span class="text-danger small" id="scheme_code_error"></span>
                                </div>
                            </div>



                            <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6">
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text"  class="form-control" name="description" id="description" readonly value="<?php if (!empty($PBD->pricebookDescription)) {
                                        echo $PBD->pricebookDescription ;} ?>">
                                   
                                         <span class="text-danger small" id="description_error"></span>
                                </div>

                            </div>

                        </div>
                        <!--end col-->

                    </div>
                    <!--end row-->
              </div>

            </div>
            <div class="col-xxl-12">
             <!-- <span class="mb-4 float-end btn btn-secondary btn-gradient waves-effect waves-light 
              add_price_book"><span> Add</span></span> -->
              <?php $length=count($price_booklist);?>
             </div>
        </div>
         
    </div>


    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                      <input type="hidden" name="last_table_count" id="last_table_count" value="">
                                    <table class="table table-hover align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product Code</th>
                                                <th scope="col">Product SKU</th>
                                                <th scope="col">Product name </th>
                                                <th scope="col">HSN Code</th>
                                                <th scope="col">MRP</th>
                                                <th scope="col">Discount(%)</th>
                                                <th scope="col">Damage Discount(%) </th>
                                                <th scope="col">DP</th>
                                                <th scope="col">BV</th>
                                                <th scope="col">Action</th>                

                                            </tr>
                                        </thead>
                                         <tbody id="addPriceBook">
                                            
                                            <?php 
                                             $i=0;if(!empty($price_booklist)){foreach($price_booklist as $PBL){
                                                $pricebookDet=$this->common_model->getProductByID($PBL->productName);

                                                if(!empty($product_details)){foreach($product_details as $PRD){
                                                     $productDet=$this->common_model->getProductNameByID($PRD->productName);}}
                                                echo "hi".$PBL->id;
                                                echo "id".$PRD->productCode;

                                                
                                                    
                                                ?>
                                                <tr class="<?php echo $i; ?>">
                                                    <td><?php if(!empty($PRD->productCode)){ echo $PRD->productCode;} ?>
                                                        <input type="hidden" class="form-control" value="<?php if(!empty($PRD->id)){ echo $PRD->id;}?>" name="pbl_product_id[]" id="pbl_product_id_<?php echo $i; ?>">
                                                    </td>
                                                    <td><?php if(!empty($PRD->Sku)){ echo $PRD->Sku;} ?>
                                                        <input type="hidden" class="form-control" value="<?php if(!empty($PRD->id)){ echo $PRD->id;}?>" name="pbl_sku[]" id="pbl_sku_<?php echo $i; ?>">
                                                    </td>
                                                    <td><?php if(!empty($PRD->productName)){ echo $PRD->productName;} ?>
                                                        <input type="hidden" class="form-control" value="<?php if(!empty($PRD->productName)){ echo $PRD->productName;}?>" name="pbl_product_name[]" id="pbl_product_name_<?php echo $i; ?>">
                                                    </td>
                                                    <td><?php if(!empty($PRD->HSNCode)){ echo $PRD->HSNCode;} ?>
                                                        
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?php if(!empty($PBL->MRP)){ echo $PBL->MRP; } ?>" name="pbl_mrp[]" id="pbl_mrp_<?php echo $i; ?>"></td>
                                                    <td>
                                                        <input type="text" class="form-control"  value="<?php if(!empty($PBL->discount)){ echo $PBL->discount;} ?>" name="pbl_discount[]" id="pbl_discount_<?php echo $i; ?>" ></td>
                                                    <td>
                                                        <input type="text" class="form-control"  value="<?php if(!empty($PBL->damageDiscount)){ echo $PBL->damageDiscount;} ?>" name="pbl_damagediscount[]" id="pbl_damagediscount_<?php echo $i; ?>">

                                                        </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?php if(!empty($PBL->DPPrice)){ echo $PBL->DPPrice;} ?>" name="pbl_dpprice[]" id="pbl_dpprice_<?php echo $i; ?>">

                                                        </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?php if(!empty($PBL->BV)){ echo $PBL->BV;} ?>" name="pbl_bv[]" id="pbl_bv_<?php echo $i; ?>">

                                                        </td>
                                                        <td><span class='Delete_OST'><i class='ri-delete-bin-2-fill'></i></span></td>
                                                </tr>
                                            <?php } } else{?>
                                                <tr>
                                                    
                                                     <td align="center" colspan="7">No Records Found</td>
                                                </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                    </div>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>


    
    <div class="row">
        <div class="col-12 d-flex justify-content-end  mb-4 ">
            <button type="reset"
                class=" btn btn-dark mr-3 btn-gradient waves-effect waves-light me-2"><span>Clear</span></button>
            <button type="submit" class=" btn btn-secondary btn-gradient waves-effect waves-light"
                name="PriceBook_Inv_Update"><span>Update</span></button>
        </div>
    </div>
    
</div>
</form>

<!-- container-fluid -->
<!--  Extra Large modal example -->
    <div class="modal fade bs-example-modal-xl"  data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                   
                    <h5 class="modal-title" id="myExtraLargeModalLabel">PriceBook List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
            
                        <form action="#" method="post">
                        <div class="row gy-4">
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div >
                                    <label for="price_book_code" class="form-label "> PriceBook Code</label>
                                    <input type="text" class="form-control"  name="price_book_code" id="price_book_code" >
                                    
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div id="pricebook_name">
                                    <label for="price_book_name" class="form-label ">PriceBook Name</label>
                                    <input type="text" class="form-control" id="price_book_name"  name="price_book_name">
                                    <span class="text-danger small" id="price_book_name_error"></span>
                                </div>
                            </div>


                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div id="pricebook_sku">
                                    <label for="price_book_sku" class="form-label ">SKU</label>
                                    <input type="text" class="form-control" id="price_book_sku"  name="price_book_sku">
                                    <span class="text-danger small" id="price_book_sku_error"></span>
                                </div>
                            </div>

                            
                            

                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div class= "mt-4">
                                    <label for="price_book_code" class="form-label mt-3"></label>
                                    <button type="submit" class="btn btn-success btn-sm search_btn" name="search_price_book">Search</button>
                                    <span class="btn btn-secondary btn-sm search_btn" id="insert_inventory">Insert</span>
                                </div>
                            </div>
                        </div>
                        </form>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-12">
                        <div class="table-responsive">
                            <p class="text-center text-danger ft10" id="inv_ins_error_msg"></p>
                            <table class="table table-hover align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Code</th>
                                        <th scope="col">Product SKU</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">HSN Code</th>
                                        <th scope="col">MRP</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">DPPrice</th>
                                        <th scope="col">Damage Discount</th>
                                        <th scope="col">BV</th>
                                       
                                    </tr>
                                </thead>

                                <tbody id="import_data">
                                   
                                   
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                    <!-- <button type="button" class="btn btn-primary ">Insert</button> -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- End of large modal -->

<script>
    $(document).ready(function(){
        $('.add_price_book').click(function(){
           
            $.ajax({
                  type: 'POST',
                  url: baseURL+'ajax/getProductforPricebook',
                  
                  success: function(data) 
                  {
                   
                    const obj = JSON.parse(data);
                    if(obj.status){
                        $('#import_data').html(obj.data);
                        if(obj.msg){
                            $('#insert_inventory').show();
                        }else{
                          $('#insert_inventory').hide();  
                        }
                        $('.bs-example-modal-xl').modal('show');
                    }else{
                        alert('Invalid Data');
                    }
                  }
                });
        });
        $('#insert_inventory').click(function(){
            var checked=$('input[name="pricebook_sel_id[]"]:checked').length;
            var Table='';
            var i=$('#last_table_count').val();
            if(checked > 0){
                $('#inv_ins_error_msg').html('');
                $('input[name="pricebook_sel_id[]"]:checked').each(function(X){
                    var val = $(this).val();
                    var product_id=$('#product_id_'+val).val();
                    var product_name=$('#product_name_'+val).val();
                    var product_sku=$('#product_sku_'+val).val();
                    var product_hsncode=$('#product_hsncode_'+val).val();
                    var product_code=$('#product_code_'+val).val();
                    var pb_mrp=$('#pb_mrp_'+val).val();
                    var pb_discount=$('#pb_discount_'+val).val();
                    var pb_dpprice=$('#pb_dpprice_'+val).val();
                    var pb_damagediscount=$('#pb_damagediscount_'+val).val();
                    var pb_bv=$('#pb_bv_'+val).val();
                    

                    Table+="<tr id='"+i+"'><td><input type='hidden' name='pb_product_id[]' id='pb_product_id_"+i+"' required value='"+product_id+"' class='form-control'><input type='hidden' name='pb_product_name[]' id='pb_product_name_"+i+"' required value='"+product_name+"' class='form-control'><p>"+product_code+"</p></td><td><p>"+product_sku+"</p></td><td><p>"+product_name+"</p></td><td><p>"+product_hsncode+"</p></td><td><input type='text' name='pb_mrp[]' id='pb_mrp_"+i+"'  value='"+pb_mrp+"' class='form-control'></td><td><input type='text' name='pb_discount[]' id='pb_discount_"+i+"'  value='"+pb_discount+"' class='form-control'></td><td><input type='text' name='pb_dpprice[]' id='pb_dpprice_"+i+"'  value='"+pb_dpprice+"' class='form-control'></td><td><input type='text' name='pb_damagediscount[]' id='pb_damagediscount_"+i+"'  value='"+pb_damagediscount+"' class='form-control'></td><td><input type='text' name='pb_bv[]' id='pb_bv_"+i+"'  value='"+pb_bv+"' class='form-control'></td><td><span class='Delete_OST'><i class='ri-delete-bin-2-fill'></i></span></td></tr>";
                    i++;
                });
                $('#last_table_count').val(i);
                $('#addPriceBook').append(Table);
                $('.bs-example-modal-xl').modal('hide');
                
            }else{
                $('#inv_ins_error_msg').html('Please Select Any One Product');
                return false;
            }
        });
           
   });
       
        

</script>