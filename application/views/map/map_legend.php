<?php
global $ADDRESS_TYPE_IMAGE;
?>

<div class="container info">

    <div class="info-head">
        <?php echo $this->lang->line('legends') ?>
        <img class="bas" src="/assets/dist/img/fleche_bas.png" alt="Bas" title="Down" >
        <img class="haut" src="/assets/dist/img/fleche_haut.png" alt="Haut" title="Up" style="display:none">
    </div>
    <div class="info-content" style="display:none">
        <?php
        for ($i = 0; $i < count($ADDRESS_TYPES); $i++) {
            $link = $ADDRESS_TYPE_IMAGE[$ADDRESS_TYPES[$i]->address_type_slug];
            ?>
            <div><img src="<?php echo $link; ?>" height="28px" width="28px"><?php echo $ADDRESS_TYPES[$i]->address_type; ?></div>
            <?php
        }
        ?>
    </div>
</div>
