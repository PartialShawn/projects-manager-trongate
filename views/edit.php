<h1><?=$headline?></h1>
<div class="card">
    <div class="card-heading">Project Details</div>
    <div class="card-body">
        <?php
        echo form_open($form_location, array('class'=>'highlight-errors'));

        echo form_label('Project Title');
        echo validation_errors('project_title');
        echo form_input('project_title', $project_title, array('placeholder'=>'project title', 'autocomplete'=>'off'));

        echo form_label('Slug');
        echo validation_errors('slug');
        echo form_input('slug', $project_title, array('placeholder'=>'project slug', 'autocomplete'=>'off'));

        echo form_label('Description');
        echo validation_errors('description');
        echo form_textarea('description', $description, array('placeholder'=>'Enter project details here'));

        echo '<div class="text-center">';
        echo anchor('projects', 'Cancel', array('class'=>'button alt'));
        if ($update_id > 0) {
            echo anchor('projects/confirm_delete/'.$update_id, 'Delete project', array('class'=>'button danger'));
        }
        echo form_submit('submit', 'Submit');
        echo '</div>';


        echo form_close();
        ?>
    </div>
</div>