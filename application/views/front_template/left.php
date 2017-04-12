<?php
$module = $this->uri->segment(1);
$page = $this->uri->segment(2);

?>

<!-- User info -->
<div class="login-info">
    <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 

        <a href="#" id="show-shortcut">
            <img src="/assets/themes/img/avatars/sunny.png" alt="me" class="online" /> 
            <span>
                <?php
                    //dump( $this->session->userdata('user_id'));die;
                    if($this->session->userdata('user_id') !='') {
                        echo $this->session->userdata('user_name');
                    }
                ?>
            </span>
            <i class="fa fa-angle-down"></i>
        </a> 
    </span>
</div>

<nav>
    <ul>
        <li>
            <a href="/user/dashboard" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
        </li>
        <li class="active open">
            <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Super Admin </span></a>
            <ul>
                <li <?php echo ($module == 'brand' ? 'class ="active" ' : '')?>>
                    <a href="/brand">Brand</a>
                </li>
                <li <?php echo ($module == 'seller' ? 'class ="active" ' : '')?>>
                    <a href="/seller">Seller</a>
                </li>
                
                <li <?php echo ($module == 'zone' ? 'class ="active" ' : '')?>>
                    <a href="/zone">Zone</a>
                </li>
                
                <li <?php echo ((($module == 'address') && $page =='') ? 'class ="active" ' : '')?> >
                    <a href="/address">Address</a>
                </li>
                
                <li <?php echo ((($module == 'project') && $page =='') ? 'class ="active" ' : '')?> >
                    <a href="/project">Project</a>
                </li>
                
                <li  <?php echo  ((($module == 'equipment') && $page =='')  ? 'class ="active" ' : '')?>>
                    <a href="/equipment">Equipment</a>
                </li>
                <li <?php echo ((($module == 'address') && $page =='type')  ? 'class ="active" ' : '')?>>
                    <a href="/address/type">Address Type</a>
                </li>
                <li <?php echo ((($module == 'zone') && $page =='type') ? 'class ="active" ' : '') ?>>
                    <a href="/zone/type">Zone Type</a>
                </li>
                <li  <?php echo ((($module == 'equipment') && $page =='type') ? 'class ="active" ' : '') ?>>
                    <a href="/equipment/type">Equipment Type</a>
                </li>
            </ul>
        </li>
        
    </ul>
</nav>
