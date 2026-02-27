<div class="card">
    <div class="card-heading"><?=$headline?></div>
    <div class="card-body">
        <?php
        echo form_open($form_location, array('class'=>'highlight-errors'));

        echo form_label('Project Title');
        echo validation_errors('project_title');
        echo form_input('project_title', $project_title, array('placeholder'=>'project title', 'autocomplete'=>'off'));

        echo form_label('Project Slug');
        echo validation_errors('slug');
        echo form_input('slug', $slug, array('placeholder'=>'project slug', 'autocomplete'=>'off'));

        echo form_label('Description');
        echo validation_errors('description');
        echo form_textarea('description', $description, array('placeholder'=>'Enter project details here'));

        echo form_hidden('id', $id);

        echo '<div class="text-center">';
        echo anchor('project/'.$slug, 'Cancel', array('class'=>'button alt'));
        if ($slug > 0) {
            echo anchor('project/'.$slug.'/confirm_delete', 'Delete project', array('class'=>'button danger'));
        }
        echo form_submit('submit', 'Submit');
        echo '</div>';


        echo form_close();
        ?>
    </div>
</div>