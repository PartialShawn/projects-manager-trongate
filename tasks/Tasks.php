<?php

/**
 * Tasks Controller
 * 
 * Handles task management CRUD operations for the admin area.
 */

class Tasks extends Trongate {

    public function index(): void {
        redirect($_GET['lang'].'/projects-tasks/list/'.segment(3));
    }

    /** Display a list of tasks.
     * 
     * @return void
     */
    public function list(): void {
        $this->trongate_security->make_sure_allowed();
        $slug = segment(3);
        $project = $this->model->get_project($slug);

        $data = [
            'page_title'=>_l('tasks').' - '.$project['project_title'].' - '.WEBSITE_NAME,
            'project'=>$project['project_title'],
            'tasks'=>$this->model->fetch_tasks($project['id']),
            'slug'=>$slug,
            'view_module'=>'projects/tasks',
            'view_file'=>'list'
        ];

        $this->templates->admin($data);
    }


    /**
     * Display the create or update task form.
     * 
     * @return void
     */
    public function edit(): void {
        $slug = segment(3);
        $update_id = segment(4, 'int');
        $submit = post('submit');
        $project = $this->model->get_project($slug);

        if ($update_id===0 || $submit==='submit') {
            $data = $this->model->get_data_from_post();
            $data['headline'] = _l('task create');
            $data['page_title'] = _l('task create').' &centerdot; '.WEBSITE_NAME;
        } else {
            $data = $this->model->get_data_from_db($update_id);
            $data['headline'] = _l('task update');
            $data['page_title'] = $data['task_title'].' &centerdot; '._l('task update').' &centerdot; '.WEBSITE_NAME;
        }

        $data['project'] = $project['project_title'];
        $data['slug'] = $slug;
        $data['update_id'] = $update_id;
        // $data['form_location'] = str_replace('/edit', '/submit', current_url());
        $data['form_location'] = $_GET['lang']."/project/{$slug}/task/{$update_id}/submit";
        $data['view_module'] = 'projects/tasks';
        $data['view_file'] = 'edit';
        $this->templates->admin($data);
    }

    /**
     * Handle form submission for creating or updating a task.
     * 
     * @return void
     */
    public function submit(): void {
        $this->trongate_security->make_sure_allowed();
        $this->validation->set_rules('task_title', 'task title', 'required|min_length[5]|max_length[55]');
        $this->validation->set_rules('description', 'description', 'required|min_length[3]');

        $result = $this->validation->run();

        if ($result===true) {
            $data = $this->model->get_data_from_post();

            $slug = segment(3);
            $update_id = segment(4, 'int');
            
            if ($update_id===0) {
                //create new record.
                $this->model->insert($data, $slug);
                set_flashdata(_l('tasked created'));
            } else {
                // update record
                $this->db->update($update_id, $data, 'projects_tasks');
                set_flashdata(_l('task updated'));
            }
            redirect($_GET['lang']."/project/{$slug}");
        } else {
            $this->edit();
        }
    }

    /**
     * Display the delete confirmation screen.
     * 
     * @return void
     */
    public function confirm_delete(): void {
        $this->trongate_security->make_sure_allowed();
        $slug = segment(3);
        $update_id = segment(4, 'int');
        $this->model->get_data_from_db($update_id); // will say 'task not found' if nonexistant
        

        $data = [
            'update_id' => $update_id,
            'slug' => $slug,
            'form_location' => str_replace('/confirm_delete', '/submit_confirmation_delete', current_url()),
            'view_module' => 'projects/tasks',
            'view_file' => 'confirm_delete'
        ];

        $this->templates->admin($data);
    }

    /**
     * Handle confirmed deletion of a task.
     * 
     * @return void
     */
    public function submit_confirmation_delete(): void {
        $this->trongate_security->make_sure_allowed();
        $slug = segment(3);

        $update_id = (int) post('update_id');
        $this->db->delete($update_id, 'projects_tasks');
        set_flashdata(_l('task deleted message'));
        redirect($_GET['lang']."/project/{$slug}");
    }
}