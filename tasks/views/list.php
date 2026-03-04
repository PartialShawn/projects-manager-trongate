<h1><?= _l('tasks') ?></h1>
<?= flashdata() ?>
<p>
    <?= anchor($_GET['lang']."/project/{$slug}/task", _l('task create'), array('class'=>'button alt')) ?>
    <?= anchor($_GET['lang']."/project/{$slug}/edit", _l('project edit button'), array('class'=>'button alt')) ?>
</p>

<?php
if (empty($tasks)) {
    return;
}
?>

<table>
    <thead>
        <tr>
            <th><?= _l('task status column') ?></th>
            <th><?= _l('task title column') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($tasks as $task) { ?>
        <tr>
            <td class="text-center"><?= $task->status_icon ?></td>
            <td><?= anchor($_GET['lang']."/project/{$slug}/task/{$task->id}", out($task->task_title)) ?>: <?= out($task->description) ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>