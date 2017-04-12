<script>
       $('#commentForm').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
          // handle the invalid form...
          console.log('Not validate');
        } else {
            e.preventDefault();
          // everything looks good!
            formAction = '/map/addComment';
            
            postArray = {
                comment_status: $('#comment_status').val(),
                comment: $('textarea#comment').val(),
                address_id : $('#address_id').val(),
            }
            
            $.post(formAction, postArray, function (data) {
                if($.trim(data) == 'yes') {
                    buildTabContent('comments', '', '');
                }
                
            });
        }
    });
    
</script>

<form method="post" id="commentForm" class="bv-form">
    <fieldset>
        <legend>
            <?php echo $this->lang->line("comment_form") ?>
        </legend>
        
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 selectContainer has-feedback">
                    <label class="control-label"><?php echo $this->lang->line("status") ?></label>
                    
                    <select name="comment_status" id="comment_status" class="form-control" required>
                        <option value="">Select <?php echo $this->lang->line("status") ?></option>
                        <?php
                            foreach ($COMMENT_STATUS as $row) {
                        ?>
                            <option value="<?php echo $row->comment_status_id ?>"><?php echo $row->comment_status; ?></option>
                        <?php
                            }
                        ?>
                        
                    </select></div>
            </div>
            <div class="help-block with-errors"></div>
        </div>
    </fieldset>

    <fieldset>
        <div class="form-group">
            <label class="control-label"><?php echo $this->lang->line("comment") ?></label>
            <textarea rows="8" name="comment" id="comment" required="required" placeholder="<?php echo $this->lang->line("comment") ?>" class="form-control"></textarea>
        </div>
    </fieldset>

    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="address_id" id="address_id" value="<?php echo ($address_id) ? $address_id : NULL ?>" >
                <button type="submit" class="btn btn-primary addButton" id="addCommentButton">
                    <i class="fa fa-comment"></i>
                    <?php echo $this->lang->line("comment") ?>
                </button>
            </div>
        </div>
    </div>

</form>
