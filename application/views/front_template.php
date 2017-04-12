<html lang="en-us">
    <head>
        <?php $this->load->view('/front_template/include_assets'); ?>
        <?php $this->load->view('/front_template/header') ?>
        <title>Jmap</title>
        <?php
            $module = $this->uri->segment(2);
            $page = $this->uri->segment(3);
            global $ADDRESS_TYPE_IMAGE;
            $data['ADDRESS_TYPES'] = $ADDRESS_TYPES;
        ?>

        <script>
            var address_type_image = <?php echo json_encode($ADDRESS_TYPE_IMAGE)?> 
            var ADDRESS_TYPES = <?php echo json_encode($ADDRESS_TYPES) ?> 
        </script>
    </head>
<body>
    
    <?php $this->load->view('/front_template/navbar'); ?>
    
    <?php  $this->load->view($main_content); ?>
    
    <?php $this->load->view('map/map_legend', $data);?>
   
</body>
</html>
