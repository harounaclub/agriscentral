    <?php $attribute_key = $this->uri->segment(1);?>
    <?php $name = $this->uri->segment(2);?>
    
    <script type="text/javascript">
        var name = "<?php echo $name; ?>";
        var attribute_key = "<?php echo $attribute_key; ?>" ;
    </script>
    
    <script type="text/javascript">
        var customIcons = {
            'Site client': {
              icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
            },
            'Site centraux': {
              icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
            }
        };
    </script>
    