<?php

/**
 * Tasks Controller
 * 
 * Handles task management CRUD operations for the admin area.
 */

class Tasks extends Trongate {

    public function index(): void {
        redirect('projects-tasks/list/'.segment(3));
    }

    /** Display a list of tasks.
     * 
     * @return void
     */
    public function list(): void {
        $this->trongate_security->make_sure_allowed();
        $slug = segment(3);

        $data = [
            'tasks'=>$this->model->fetch_tasks($slug),
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

        if ($update_id===0 || $submit==='submit') {
            $data = $this->model->get_data_from_post();
        } else {
            $data = $this->model->get_data_from_db($update_id);
        }

        $data['headline'] = ($update_id===0)?'Create Task':'Update Task';
        $data['slug'] = $slug;
        $data['update_id'] = $update_id;
        $data['form_location'] = str_replace('/edit', '/submit', current_url());
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
                set_flashdata('The new task was successfully created.');
            } else {
                // update record
                $this->db->update($update_id, $data, 'projects_tasks');
                set_flashdata('The task was successfully updated.');
            }
            redirect('projects-tasks/list/'.$slug);
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
        set_flashdata('The task record was successfully deleted.');
        redirect('projects-tasks/list/'.$slug);
    }
}