<div class="card">
    <div class="card-heading"><?=$headline?></div>
    <div class="card-body">
        <?php
        echo form_open($form_location, array('class'=>'highlight-errors'));

        echo form_label(_l('project title'));
        echo validation_errors('project_title');
        echo form_input('project_title', $project_title, array('placeholder'=>_l('project title'), 'autocomplete'=>'off'));

        echo form_label(_l('project slug'));
        echo validation_errors('slug');
        echo form_input('slug', $slug, array('placeholder'=>_l('project slug'), 'autocomplete'=>'off'));

        echo form_label(_l('project description'));
        echo validation_errors('description');
        echo form_textarea('description', $description, array('placeholder'=>_l('project description placeholder')));

        echo form_hidden('id', $id);

        echo '<div class="text-center">';
        echo anchor($_GET['lang'].'/project/'.$slug, _l('cancel'), array('class'=>'button alt'));
        if ($slug > 0) {
            echo anchor($_GET['lang'].'/project/'.$slug.'/confirm_delete', _l('delete project'), array('class'=>'button danger'));
        }
        echo form_submit('submit', _l('create project button'));
        echo '</div>';


        echo form_close();
        ?>
    </div>
</div>