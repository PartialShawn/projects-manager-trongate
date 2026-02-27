<div class="card">
    <div class="card-heading">Confirm Delete</div>
    <div class="card-body">
        <p>You are about to delete a project record. This cannot be undone.</p>
        <?php
        echo form_open($form_location);
        echo form_hidden('id', $id);
        echo anchor('project/'.$slug, 'Cancel', array('class'=>'button alt'));
        echo form_submit('submit', 'Delete Project', array('class'=>'danger'));
        echo form_close();
        ?>
    </div>
</div>