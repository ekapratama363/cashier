<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <!-- <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Invitation</a></li>
                <li class="breadcrumb-item active">testimony</li>
            </ol>
        </div> -->
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        
        <?php if($this->session->flashdata('success') != NULL) { ?>
            <div class="alert alert-success alert-dismissible">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <p class="text-white"><?php echo $this->session->flashdata('success'); ?></p>
            </div>
        <?php } ?>

        
        <?php if($this->session->flashdata('failed') != NULL) { ?>
            <div class="alert alert-warning alert-dismissible">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <p class="text-dark"><?php echo $this->session->flashdata('failed'); ?></p>
            </div>
        <?php } ?>
        
        <div class="card">
            <div class="card-body">
                <form id="formPrintOrMutlipleDelete" action="<?php echo base_url(); ?>product/print_or_multiple_delete" method="post">  
                    
                    <div class="box-header with-border">
                        <!-- for type submit delete or print -->
                        <input type="hidden" name="type" id="type">
                        <a href="<?php echo base_url(); ?>product_out/create" class="btn btn-primary btn-sm" title="Add User"><i class="fa fa-plus"></i></a>
                    
                        <button id="deleteAll" type="button" class="btn btn-danger btn-sm" title="Multiple Delete" name="multiple_delete"><i class="fa fa-trash"></i></button>
                    </div>
                            
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%"><input type="checkbox" id="checkAll" class="customcheck"></th>        
                                    <th style="width: 5%">No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <!-- <th>Icon</th> -->
                                    <th>Category</th>
                                    <th>Image</th>
                                    <!-- <th>Page</th> -->
                                    <th style="width: 5%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <!-- End Container fluid  -->
</div>

<script src="<?php echo base_url(); ?>assets/js/lib/jquery/jquery.min.js"></script>

<!-- Data Table -->
<script>
    $(document).ready(function(){
        $('#myTable').dataTable({
            // "scrollY": "400px",
            // "scrollX": "700px",
            // "scrollX": true,
            //"scrollCollapse": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            // "responsive": true,
            // "scrollCollapse": true,
            // "columnDefs": [    
            //    {                                 
            //        "targets": '_all',
            //        "render": $.fn.dataTable.render.text()
            //    }    
            //  ], 
            //"scrollCollapse": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>product/ajax_list_product",
                "dataType": "json",
                "type": "POST",
                // "data": {
                //     _token: "{{csrf_token()}}",
                // }
            },
            "columns": [
                {"data": "check_box"},
                {"data": "no"},
                {"data": "title"},
                {"data": "description"},
                // {"data": "icon"},
                {"data": "category"},
                {"data": "image"},
                // {"data": "page"},
                {"data": "action"},
            ],
            columnDefs : [
                // { 
                //     "className": "invoice", 
                //     "targets" : [0, 3],//first column / numbering column
                // }
                { "orderable": false, "targets": [0] },
                // { "orderable": true, "targets": [1, 2, 3] }
            ],   
            "order": [],  

        });

    });
</script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

    /* Get the checkboxes values based on the class attached to each check box */
    $("#deleteAll").click(function() {
        getValueUsingClassDelete();

        // console.log(getValueUsingClassDelete());
    });
    $("#printAll").click(function() {
        getValueUsingClassPrint();

        // console.log(getValueUsingClassPrint());
    });
			
    function getValueUsingClassDelete(){
        // type for submit delete
        $("#type").val("delete");

        /* declare an checkbox array */
        let chkArray = [];
        
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".checkboxes:checked").map(function() {
            chkArray.push($(this).val());
        });
        
        /* we join the array separated by the comma */
        let selected;
        selected = chkArray.join(',') ;
        
        /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
        if(selected.length > 0){
            let act = confirm('Are you sure delete this data?');
            (act === true) ? formFunction() : false;
        }else{
            return alert("Please at least check one of the checkbox");	
        }

		function formFunction() {
		    document.getElementById("formPrintOrMutlipleDelete").submit();
		}
    } 

    function getValueUsingClassPrint(){
        // type for submit print
        $("#type").val("print");

        /* declare an checkbox array */
        let chkArray = [];
        
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".checkboxes:checked").map(function() {
            chkArray.push($(this).val());
        });
        
        /* we join the array separated by the comma */
        let selected;
        selected = chkArray.join(',') ;
        
        /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
        if(selected.length == 0) {
            return alert("Please at least check one of the checkbox");	
        } else {
            formFunction()
        }

		function formFunction() {
		    document.getElementById("formPrintOrMutlipleDelete").submit();
		}
    } 
</script>


