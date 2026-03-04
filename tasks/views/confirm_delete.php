<div class="card">
    <div class="card-heading"><?= _l('confirm delete header') ?></div>
    <div class="card-body">
        <p><?= _l('task confirm delete text') ?></p>
        <?php
        echo form_open($form_location);
        echo form_hidden('update_id', $update_id);
        echo anchor($_GET['lang']."/project/{$slug}", _l('cancel'), array('class'=>'button alt'));
        echo form_submit('submit', _l('task delete'), array('class'=>'danger'));
        echo form_close();
        ?>
    </div>
</div>