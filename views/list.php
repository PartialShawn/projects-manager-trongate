<h1>Projects</h1>
<?= flashdata() ?>
<p><?= anchor('projects/edit', 'Create New Projects', array('class'=>'button alt')) ?></p>

<?php
if (empty($projects)) {
    return;
}
?>



<div class="flex-row">
    <?php
    foreach($projects as $project) { ?>
    <div class="card" style="width: 48%; margin-right: 2%;">
        <div class="card-heading">
            <?= anchor('project/'.out($project->slug), out($project->project_title), ['style'=>'color: white;']) ?>
            <?= anchor('projects-tasks/list/'.out($project->slug), out($project->project_title), ['style'=>'color: white;']) ?>
        </div>
        <div class="card-body text-center">
            <p><?= out($project->description) ?></p>
        </div>
    </div>
    <?php
    }
    ?>
</div>
