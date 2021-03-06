<?php
echo $this->Form->create('CloggyBlogTags', array(
    'url' => '/' . Configure::read('Cloggy.url_prefix') . '/module/cloggy_blog/cloggy_blog_tags/add',
    'class' => 'form-horizontal'
));
?>
<fieldset>
    <legend>Add New Tag</legend>

    <?php if (isset($success)) : ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <div class="control-group <?php
    if (isset($errors['tag_name'])) : echo 'error';
    endif;
    ?>">
        <label class="control-label">Tag Name</label>
        <div class="controls">
                <?php echo $this->Form->input('tag_name', array('label' => false, 'placeholder' => 'tag name', 'type' => 'text', 'div' => false)); ?>
            <span class="help-inline"><?php
                if (isset($errors['tag_name'])) : echo $errors['tag_name'][0];
                endif;
                ?></span>
        </div>
    </div>					

    <div class="control-group">
        <div class="controls">				
            <input type="submit" name="submit" value="Add" class="btn btn-primary" />
        </div>
    </div>
</fieldset>
<?php echo $this->Form->end(); ?>