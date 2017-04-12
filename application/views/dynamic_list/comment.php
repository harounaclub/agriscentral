<script>
    $(document).ready(function() {
        $(".addButton").click(function(e) {
            getCommentForm(addressId);
        }); 
    }); 
</script>
<div class="text-right">
    <a class="btn btn-primary addButton" style="margin:5px">Add</a>
</div>
<?php
//dump($COMMENTS);
if (!empty($COMMENTS['results'])) {
    ?>

    <h2><?php echo $this->lang->line("added_comment") ?> </h2>
    <ul class="list-group">
        <?php
        foreach ($COMMENTS['results'] as $comment) {
            ?>
            <li class="list-group-item">
                <div><strong><?php echo $this->lang->line("name") ?> : </strong><?php echo ucwords($comment->user_name); ?></div>
                <div><strong><?php echo $this->lang->line("status") ?></strong> : <?php echo $comment->comment_status; ?>
                <div><strong><?php echo $this->lang->line("comments") ?></strong> : <?php echo nl2br($comment->comment); ?></div>
            </li>
            <?php
        }
        ?>

    </ul>
    <div class="">
        <div >
            <div>
            <?php
                    $uri = '';
                    buildPagination($COMMENTS['param'], $uri);
            ?>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <ul class="list-group">
        <li class="list-group-item"><?php echo $this->lang->line("no_commnet") ?></li>
    </ul>
    
    <?php
}
?>
