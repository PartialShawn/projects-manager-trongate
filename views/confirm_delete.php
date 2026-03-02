<div class="card">
    <div class="card-heading"><?= _l('confirm delete header') ?></div>
    <div class="card-body">
        <p><?= _l('confirm delete project text') ?></p>
        <?php
        echo form_open($form_location);
        echo form_hidden('id', $id);
        echo anchor($_GET['lang'].'/project/'.$slug, _l('cancel'), array('class'=>'button alt'));
        echo form_submit('submit', _l('delete project'), array('class'=>'danger'));
        echo form_close();
        ?>
    </div>
</div>