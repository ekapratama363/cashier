
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
                        <h4 class="m-b-0 text-white">Category Detail</h4>
                    </div>
                    <div class="card-body">
                        <?php echo form_open_multipart($this->uri->segment(1) . '/store'); ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <br>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="">Choose Type</option>
                                                        <option value="Char">Char</option>
                                                        <option value="Date">Date</option>
                                                        <option value="Time">Time</option>
                                                        <option value="Numeric">Numeric</option>
                                                        <option value="List">List</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="lengthInput">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Length</label>
                                                    <input type="number" class="form-control" name="length">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="decimalInput">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Decimal</label>
                                                    <input type="number" class="form-control" name="decimal">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="valueInput">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Value</label>
                                                    <input type="text" class="form-control" name="value" placeholder='separate with ","'>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="checkbox" name="reading_indicator">

                                                    <label>Reading Indicator</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
    
                                        <div class="table-responsive m-t-40">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">Type</th>
                                                        <th class="text-center">Length</th>
                                                        <th class="text-center">Decimal</th>
                                                        <th class="text-center">Value</th>
                                                        <th class="text-center">Reading Indicator</th>
                                                        <th style="width: 5%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">Color</td>
                                                        <td class="text-center">Char</td>
                                                        <td class="text-right">10</td>
                                                        <td class="text-right"></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td>
                                                            <a onclick="" class="btn btn-danger btn-sm delete-list">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">Merk</td>
                                                        <td class="text-center">List</td>
                                                        <td class="text-right"></td>
                                                        <td class="text-right"></td>
                                                        <td class="text-center">Adidas, Nike, New Balance</td>
                                                        <td class="text-center"></td>
                                                        <td>
                                                            <a onclick="" class="btn btn-danger btn-sm delete-list">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">Size</td>
                                                        <td class="text-center">List</td>
                                                        <td class="text-right"></td>
                                                        <td class="text-right"></td>
                                                        <td class="text-center">M, L, XL, XXL</td>
                                                        <td class="text-center"></td>
                                                        <td>
                                                            <a onclick="" class="btn btn-danger btn-sm delete-list">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <!-- <a href="<?php echo base_url() . $this->uri->segment(1); ?>/index"><button type="button" class="btn btn-inverse">Cancel</button></a> -->
                            </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->

<script src="<?php echo base_url(); ?>assets/js/lib/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {

        $('#lengthInput').hide();
        $('#decimalInput').hide();
        $('#valueInput').hide();

        $('#type').change(function() {
            var val = $(this).val();

            console.log(val)

            if(val == 'Char') {
                $('#lengthInput').show();
                $('#decimalInput').hide();
                $('#valueInput').hide();
                // length show
            } else if(val == 'Numeric') {
                $('#lengthInput').show();
                $('#decimalInput').show();
                $('#valueInput').hide();
                // length and decimal show
            }else if(val == 'List') {  
                $('#lengthInput').hide();
                $('#decimalInput').hide();
                $('#valueInput').show();
                // val show
            } else {
                $('#lengthInput').hide();
                $('#decimalInput').hide();
                $('#valueInput').hide();
            }
        })
    })
</script>