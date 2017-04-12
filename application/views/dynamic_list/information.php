<?php
//dump($DETAILS);
if (!empty($DETAILS) && count($DETAILS) > 0) {
    ?>
        <h2><?php echo $this->lang->line("details") ?></h2>
        <ul class="list-group">
            <?php
            foreach ($DETAILS as $row) {
                ?>
                <?php
                if (!empty($row->address) && $row->address!= '') {
                    ?>
                    <li class="list-group-item"><strong><?php echo $this->lang->line("address") ?></strong> : <?php echo $row->address ?></li>
                    <?php
                }
                ?>
                    
                <?php
                if (!empty($row->address_type) && $row->address_type != '') {
                    ?>
                    <li class="list-group-item"><strong><?php echo $this->lang->line("address_type") ?></strong> : <?php echo $row->address_type ?></li>
                    <?php
                }
                ?>


                <?php
                if (!empty($row->location) && $row->location != '') {
                    ?>
                    <li class="list-group-item"><strong><?php echo $this->lang->line("location") ?> </strong> : <?php echo $row->location ?></li>
                    <?php
                }
                ?>

                <?php
                if (!empty($row->state) && $row->state != '') {
                    ?>
                    <li class="list-group-item"><strong><?php echo $this->lang->line("state") ?> </strong>: <?php echo $row->state ?></li>
                    <?php
                }
                ?>
                    
                    
                <?php
                if (!empty($row->country) && $row->country != '') {
                    ?>
                    <li class="list-group-item"><strong><?php echo $this->lang->line("country") ?> </strong>: <?php echo $row->country ?></li>
                    <?php
                }
                ?>
                <?php
                if (!empty($row->zone_name) && $row->zone_name != '') {
                    ?>
                    <li class="list-group-item"><strong><?php echo $this->lang->line("zone") ?> </strong>: <?php echo $row->zone_name ?></li>
                    <?php
                }
                ?>
                    
                <?php
                if (!empty($row->zipcode) && $row->zipcode != '') {
                    ?>
                    <li class="list-group-item"><strong><?php echo $this->lang->line("zipcode") ?> </strong>: <?php echo $row->zipcode ?></li>
                    <?php
                }
                ?>   
                <?php
                if (!empty($row->latitude) && $row->latitude != '') {
                    ?>
                    <li class="list-group-item"><strong><?php echo $this->lang->line("latitude") ?> </strong>: <?php echo $row->latitude ?></li>
                    <?php
                }
                ?>  
                <?php
                if (!empty($row->longitude) && $row->longitude != '') {
                    ?>
                    <li class="list-group-item"><strong><?php echo $this->lang->line("longitude") ?> </strong>: <?php echo $row->longitude ?></li>
                    <?php
                }
                ?>  
                    
                <?php
            }
            ?>
        </ul>
    <?php
} else {
    ?>
        <ul class="list-group">
            <li class="list-group-item"><?php echo $this->lang->line("no_information") ?></li>
        </ul>
    
    <?php
}
?>