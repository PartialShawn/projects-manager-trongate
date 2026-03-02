<div class="card">
    <div class="card-heading"><?= _l('confirm delete header') ?></div>
    <div class="card-body">
        <p><?= _l('confirm delete project text') ?></p>
        <?php
        echo form_open($form_location);
        echo form_hidden('update_id', $update_id);
        echo anchor($_GET['lang']."/project/{$slug}", 'Cancel', array('class'=>'button alt'));
        echo form_submit('submit', 'Delete Task', array('class'=>'danger'));
        echo form_close();
        ?>
    </div>
</div>