<h1>Manage Tasks</h1>
<?= flashdata() ?>
<p>
    <?= anchor('projects-tasks/edit/'.$slug, 'Create New Task', array('class'=>'button alt')) ?>
    <?= anchor('projects/edit/'.$slug, 'Edit Project', array('class'=>'button alt')) ?>
</p>

<?php
if (empty($tasks)) {
    return;
}
?>

<table>
    <thead>
        <tr>
            <th>Status</th>
            <th>Task</th>
        </tr>
    </thead>    
    <tbody>
        <?php
        foreach($tasks as $task) { ?>
        <tr>
            <td class="text-center"><?= $task->status_icon ?></td>
            <td><?= anchor('projects-tasks/edit/'.$slug.'/'.$task->id, out($task->task_title)) ?>: <?= out($task->description) ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>