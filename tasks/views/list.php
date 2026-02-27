<h1>Manage Tasks</h1>
<?= flashdata() ?>
<p>
    <?= anchor("project/{$slug}/task", 'Create New Task', array('class'=>'button alt')) ?>
    <?= anchor("project/{$slug}/edit", 'Edit Project', array('class'=>'button alt')) ?>
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
            <td><?= anchor("project/{$slug}/task/{$task->id}", out($task->task_title)) ?>: <?= out($task->description) ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>