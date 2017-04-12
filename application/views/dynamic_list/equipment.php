<style>
    .onButton {
        background-color: green;font-size: 18px;float:right;
    }
    .offButton {
        background-color: red;font-size: 18px;float:right;
    }
</style>
<?php


//dump($EQUIPMENTS['results']);
if (!empty($EQUIPMENTS['results']) && count($EQUIPMENTS['results']) > 0) {
?>
    
   <div class="row-fluid">
        <h2>Equipments</h2>
        <ul class="list-group">
            
            <?php
            foreach ($EQUIPMENTS['results'] as $key => $row) {
                $status = trim($row->address_equipment_status);
            ?>
            <li class="list-group-item">
                <?php
                    if(isset($status) && $status !=''){
                ?>
                <div style="float:right;width: 18%"><span class="label label-as-badge <?php echo ($status == 1) ? 'onButton' : 'offButton' ?>"><?php echo ($status == 1) ? 'UP ':'DOWN';?></span></div>
                <?php
                    }
                ?>
                    <?php
                    if (!empty($row->equipment) && $row->equipment != '') {
                        ?>
                        <strong><?php echo $this->lang->line("equipment") ?></strong> : <?php echo $row->equipment ?><br />
                        <?php
                    }
                    ?>
                    <?php
                    if (!empty($row->ip) && $row->ip != '') {
                        ?>
                        <strong>IP</strong> : <?php echo $row->ip ?><br />
                        <?php
                    }
                    ?>


                    <?php
                    if (!empty($row->date_of_installation) && $row->date_of_installation != '') {
                        ?>
                        <strong><?php echo $this->lang->line("installed_on") ?> </strong> : <?php echo $row->date_of_installation ?><br />
                        <?php
                    }
                    ?>

                    <?php
                    if (!empty($row->serial_number) && $row->serial_number != '') {
                        ?>
                        <strong><?php echo $this->lang->line("serial_number") ?> </strong>: <?php echo $row->serial_number ?><br />
                        <?php
                    }
                    
                    ?>
                    <?php
                        if(!empty($row->since)) {
                    ?>
                        <span class="badge">Since : <?php echo $row->since; ?></span>
                    <?php
                        }
                    ?>    
                    <?php
                    if (!empty($row->brand_name) && $row->brand_name != '') {
                        ?>
                        <strong><?php echo $this->lang->line("brand") ?> </strong>: <?php echo $row->brand_name ?><br />
                        <?php
                    }
                    ?>
                </li>
                <?php
            }
            ?>
        </ul>
    <?php
} else {
    ?>
        <ul class="list-group">
            <li class="list-group-item"><?php echo $this->lang->line("no_equipment") ?></li>
        </ul>
    
    <?php
}
 
 
?>