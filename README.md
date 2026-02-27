# projects-manager-trongate

Example project-based task manager built for Trongate v2 php framework that is suitable for understanding the basics of Trongate. The basic structure of the projects module and the tasks submodule will be familiar to anyone who has seen the task manager Trongate V2.

## Installation

1. Download current snapshot of Trongate (there is no v2 release as for 2026-02-24)
2. In the modules folder add this repo as a submodule
3. Edit `config/config.php` and `config/database.php`
   1. In `config.php` you can set the default module to `projects` and view to `index`
4. Run the SQL in `modules/projects/projects.sql`
5. Run the SQL in `modules/trongate_adminstrators`
6. Edit `modules/templates/views/admin.php` to add a link to `projects`.
7. Add the following to `config/custom_routing.php`:

```php
<?php
$routes = [
    // project module
    'project/(:any)' => 'projects-tasks/list/$1',
    'project/(:any)/edit' => 'projects/edit/$1',
    'project/(:any)/submit' => 'projects/submit/$1',
    'project/(:any)/confirm_delete' => 'projects/confirm_delete/$1',
    'project/(:any)/confirm_delete' => 'projects/confirm_delete/$1/$2',
    'project/(:any)/submit_confirmation_delete' => 'projects/submit_confirmation_delete/$1',
    // task submodule
    'project/(:any)/task' => 'projects-tasks/edit/$1',
    'project/(:any)/task/(:num)' => 'projects-tasks/edit/$1/$2',
    'project/(:any)/task/(:num)/confirm_delete' => 'projects-tasks/confirm_delete/$1/$2',
    'project/(:any)/task/(:num)/submit_confirmation_delete' => 'projects-tasks/submit_confirmation_delete/$1/$2',
    // admin
    'tg-admin' => 'trongate_administrators/login',
    'tg-admin/submit_login' => 'trongate_administrators/submit_login'
];
define('CUSTOM_ROUTES', $routes);
```
   

## Limitations

- `$this->trongate_security->make_sure_allowed();` calls seem to do nothing, but may require the members and join modules.
- It does not use string resources or localization
- Failed database inserts/updates/deletes are not actually checked.
- Loading a non existent project will not cause an error and will allow you to create a task
- Does not delete tasks associated with a project when deleting a project