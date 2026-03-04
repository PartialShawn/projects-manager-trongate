<div class="card">
    <div class="card-heading"><?=$headline?></div>
    <div class="card-body">
        <?php
        echo form_open($form_location, array('class'=>'highlight-errors'));
        echo form_hidden('slug', $slug);

        echo form_label(_l('task title'));
        echo validation_errors('task_title');
        echo form_input('task_title', $task_title, array('placeholder'=>_l('task title placeholder'), 'autocomplete'=>'off'));

        echo form_label(_l('task description'));
        echo validation_errors('description');
        echo form_textarea('description', $description, array('placeholder'=>_l('task title')));

        echo '<label>';
        echo form_checkbox('complete', 1, $complete);
        echo _l('task complete');
        echo '</label>';

        echo '<div class="text-center">';
        echo anchor($_GET['lang']."/project/{$slug}", _l('cancel'), array('class'=>'button alt'));
        if ($update_id > 0) {
            echo anchor($_GET['lang']."/project/{$slug}/task/{$update_id}/confirm_delete", _l('task delete'), array('class'=>'button danger'));
            echo form_submit('submit', _l('task update'));
        } else {
            echo form_submit('submit', _l('task create'));
        }
        echo '</div>';


        echo form_close();
        ?>
    </div>
</div>