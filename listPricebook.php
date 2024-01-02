<div class="container-fluid mt-4">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"><?php echo $page_name;?></h4>

                <div class="page-title-right">
                    <?php //if($this->rbac->display_operation('materialcategory','addMaterialCategory')){?>
                    <a href="<?php echo base_url();?>pricebook/addpricebook"
                        class="btn btn-secondary  btn-sm btn-gradient waves-effect waves-light"><span><i
                                data-feather="plus"></i> Add Price Book</span></a>
                    <?php //} ?>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Search Price Book</h4>
                    <div class="flex-shrink-0 d-none">
                    </div>
                </div>

                <div class="card-body">
                    <div class="live-preview">
                        <form action="#" method="post">
                            <div class="row gy-4">

                                <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                    <div>
                                        <label for="category_name" class="form-label "> Price Book Name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name">
                                        <span class="text-danger small" id="category_name_error"></span>
                                    </div>
                                </div>

                                <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                    <div>
                                        <label for="category_name" class="form-label "> Price Book Code</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name">
                                        <span class="text-danger small" id="category_name_error"></span>
                                    </div>
                                </div>


                                <!-- 
                                <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                    <div>
                                        <label for="dob" class="form-label">From Date</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="<?php echo set_value('dob'); ?>">
                                        <span class="text-danger small"
                                            id="dob_error"><?php echo form_error('dob'); ?></span>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                    <div>
                                        <label for="dob" class="form-label">To Date</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="<?php echo set_value('dob'); ?>">
                                        <span class="text-danger small"
                                            id="dob_error"><?php echo form_error('dob'); ?></span>
                                    </div>
                                </div> -->
                                <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                    <div class="mt-4">
                                        <label for="category_name" class="form-label mt-3"></label>
                                        <button type="submit" class="btn btn-success btn-sm search_btn"
                                            name="search_material_category">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"><?php echo $page_name;?> Details</h4>
                    <div class="flex-shrink-0 d-none">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="hover-rows-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="hover-rows-showcode">
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Price Book Name</th>
                                                <th scope="col">Price Book Code</th>
                                                <th scope="col">Description </th>
                                                <th scope="col">Created Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($price_book)){ foreach($price_book as $PB)  {?>
                                            <tr>
                                                <td><?php if(!empty($PB->pricebookName)){ echo $PB->pricebookName; }?></td>
                                                <td><?php if(!empty($PB->pricebookCode)){ echo $PB->pricebookCode; }?></td>
                                                <td><?php if(!empty($PB->pricebookDescription)){ echo $PB->pricebookDescription; }?></td>
                                                <td><?php if(!empty($PB->createdAt)){ echo $PB->createdAt; }?></td>
                                                <td>
                                                    <a href="<?php echo base_url();?>pricebook/viewPricebookList/<?php echo $this->common_model->encode($PB->id);?>"><i class="ri-eye-fill icons view" title="View">
                                                         </i></a>
                                                    <a href="<?php echo base_url();?>pricebook/editPricebookList/<?php echo $this->common_model->encode($PB->id);?>">
                                                        <i class="ri-edit-2-fill icons view" title="Edit"></i></a>
                                                    <a href="javascript:void(0);" data-url="<?php echo base_url();?>pricebook/deletePricebook/<?php echo $this->common_model->encode($PB->id);?>" class="sa-warning"><i class=" ri-delete-bin-fill icons view" title="Delete"></i></a>
                                                                             
                                                </td>

                                            </tr>
                                        <?php } } ?>
                                            
                                        </tbody>
                                    </table>

                                    <nav class="mt-3 d-block">
                                        <?php echo $this->pagination->create_links(); ?>
                                    </nav>
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                    </div>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>
<!-- container-fluid -->