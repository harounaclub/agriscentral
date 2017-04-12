<?php

foreach ($DATA as $key => $row) {
    if($type == 'equipments') {
?>
    lat= <?php echo $row->equipment; ?>
<?php
} else if($type == 'zones') {
?>
    lat= <?php echo $row->zone_name; ?>
<?php
    }
}
