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
   

## Limitations

- `$this->trongate_security->make_sure_allowed();` calls seem to do nothing, but may require the members and join modules.
- It does not use string resources or localization
- Failed database inserts/updates/deletes are not actually checked.