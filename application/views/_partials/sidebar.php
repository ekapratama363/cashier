<div class="left-sidebar" style="background: #222d32">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" style="background: #222d32">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>

                <li class="nav-label">Home</li>

                <li> 
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Home</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>report/dashboard">Dashboard</a></li>
                    </ul>
                </li>

                <li> 
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-tasks"></i><span class="hide-menu">Master</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <!-- <li><a href="<?php echo base_url(); ?>master_type">Master Type</a></li> -->
                        <!-- <li><a href="<?php echo base_url(); ?>master_group">Master Group</a></li> -->
                        <li><a href="<?php echo base_url(); ?>product_category">Product Category</a></li>
                        <li><a href="<?php echo base_url(); ?>product">Product</a></li>
                        <li><a href="<?php echo base_url(); ?>supplier">Supplier</a></li>
                        <li><a href="<?php echo base_url(); ?>customer">Customer</a></li>
                    </ul>
                </li>

                <li> 
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-folder-open"></i><span class="hide-menu">Transaction</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>product_in/create">Product In Create</a></li>
                        <li><a href="<?php echo base_url(); ?>product_in">Product In List</a></li>
                        <li><a href="<?php echo base_url(); ?>product_out/create">Product Out Create</a></li>
                        <li><a href="<?php echo base_url(); ?>product_out">Product Out List</a></li>
                    </ul>
                </li>

                <li> 
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-gear"></i><span class="hide-menu">System</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>role">Role</a></li>
                        <li><a href="<?php echo base_url(); ?>user">User</a></li>
                    </ul>
                </li>

                <li> 
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-pie-chart"></i><span class="hide-menu">Report</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>report/index/stock">Stock</a></li>
                        <li><a href="<?php echo base_url(); ?>report/index/product_in">Product In</a></li>
                        <li><a href="<?php echo base_url(); ?>report/index/product_out">Product Out</a></li>
                    </ul>
                </li>

                <!-- <li>
                    <a href="mailto:ekapratama363@gmail.com"><i class="fa fa-envelope"></i>
                    <span>Send Error Report</span></a>
                </li> -->
                <!-- END -->
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
<!-- End Left Sidebar  -->   