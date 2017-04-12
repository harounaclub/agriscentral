<script>
    $('#comment_form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this); 
        
        formAction = '/map/addComment';

        postArray = {
            comment_status: $('#comment_status').val(),
            comment: $('#comment').val(),
            address_id : $('#address_id').val(),
        }
        
        $.post(formAction, postArray, function (data) {
            if($.trim(data) == 'yes') {
                $('#coment_div_message').css({ display : 'block'}).html('Your comment has been added  successfully.');
                $(".coment_div").css({ display: 'none'});
            }
        });
         
    });
    
</script>
<?php
    if(!empty($COMMENTS)) {
?>
<div class="panel panel-default" style="margin-left:10px;margin-right: 10px;height:40%; overflow-y:scroll;">
    <div class="panel-heading panel-info"><strong><?php echo $this->lang->line("added_comment") ?> </strong></div>
   <ul class="list-group">
        <?php
            foreach($COMMENTS as $comment) {
        ?>
        <li class="list-group-item" style="padding: 3px 5px">
            <strong><?php echo ucwords($comment->user_name); ?></strong><br />
            <strong><?php echo $this->lang->line("status") ?></strong> - <?php echo $comment->comment_status; ?><br />    
            <?php echo nl2br($comment->comment); ?>
        </li>
        <?php
            }
        ?>
      
   </ul>
</div>
<?php
    }
?>



<div class="alert alert-success" id="coment_div_message" style="display: none; margin:10px">
    
</div>

<div class="col-md-6 coment_div" style="width: 100%;max-height: 25%;">
      
  <div class="panel panel-info">
    <div class="panel-heading"><?php echo $this->lang->line("comment") ?></div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" id="comment_form" name="comment_form" action="">
            <div class="form-group">
                <div class="col-sm-9">
                    <textarea class="input-xlarge" name="comment"  id="comment"  required="required" placeholder="<?php echo $this->lang->line("comment") ?>"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-9">
                    <select name="comment_status" id="comment_status" required="required">
                        <option value=""><?php echo $this->lang->line("status") ?></option>
                        <?php
                        foreach ($COMMENT_STATUS as $row) {
                            ?>
                            <option value="<?php echo $row->comment_status_id ?>"><?php echo $row->comment_status; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="address_id" id="address_id" value="<?php echo ($addressId)? $addressId : NULL ?>" >
            <button type="submit"  id="commentButton" class="btn btn-default"><?php echo $this->lang->line("comment") ?></button>
        </form>


    </div>
  </div>
</div>
 