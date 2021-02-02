<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <!-- <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Invitation</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('user') }}">Degree</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div> -->
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-lg-12">

                <?php if(validation_errors()) { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p class="text-white"><?php echo validation_errors(); ?></p>
                    </div>
                <?php } ?>

                <?php if($this->session->flashdata('success') != NULL) { ?>
                    <div class="alert alert-success alert-dismissible">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p class="text-white"><?php echo $this->session->flashdata('success') ?></p>
                    </div>
                <?php } ?>

                <?php if($this->session->flashdata('failed') != NULL) { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p class="text-white"><?php echo $this->session->flashdata('failed') ?></p>
                    </div>
                <?php } ?>

                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Create</h4>
                    </div>
                    <div class="card-body">
                        <?php echo form_open_multipart('product/store'); ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="title" value="<?php echo set_value('title'); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <input type="text" class="form-control" name="description" value="<?php echo set_value('description'); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Icon</label>
                                                    <input type="text" class="form-control" name="icon" value="<?php //echo set_value('icon'); ?>">
                                                </div>
                                            </div>
                                        </div> -->
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image</label><br />
                                                    <input type="file" name="image" id="image">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    
                                                    <select class="form-control" name="category" id="category" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="<?php echo base_url(); ?>product/index"><button type="button" class="btn btn-inverse">Cancel</button></a>
                            </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->
</div>
<!-- End Page wrapper  -->

<script src="<?php echo base_url(); ?>assets/js/lib/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $("#category").select2({
            placeholder: 'Choose Category',
            width: '100%',
			allowClear: true,
            ajax: {
                url:  "<?php echo base_url(); ?>product_category/ajax_product_category",
                dataType: 'json',
                type: 'GET',
                delay: 250,
                processResults: function (data) {
                // console.log(data);
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.category,
                                id: item.id
                            }
                        })
                    }
                }
            }
        })
    });
</script>