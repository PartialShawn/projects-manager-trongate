<?php

/**
 * Projects Controller
 * 
 * Handles project management CRUD operations for the admin area.
 */

class Projects extends Trongate {

    public function index(): void {
        redirect('projects/list');
    }

    /** Display a list of projects.
     * 
     * @return void
     */
    public function list(): void {
        $this->trongate_security->make_sure_allowed();

        $data = [
            'projects'=>$this->model->fetch_projects(),
            'view_module'=>'projects',
            'view_file'=>'list'
        ];

        $this->templates->admin($data);
    }


    /**
     * Display the create or update project form.
     * 
     * @return void
     */
    public function edit(): void {
        $update_id = segment(3, 'int');
        $submit = post('submit');

        if ($update_id===0 || $submit==='submit') {
            $data = $this->model->get_data_from_post();
        } else {
            $data = $this->model->get_data_from_db($update_id);
        }

        $data['headline'] = ($update_id===0)?'Create Project':'Update Project';
        $data['update_id'] = $update_id;
        $data['form_location'] = str_replace('/edit', '/submit', current_url());
        $data['view_module'] = 'projects';
        $data['view_file'] = 'edit';
        $this->templates->admin($data);
    }

    /**
     * Handle form submission for creating or updating a project.
     * 
     * @return void
     */
    public function submit(): void {
        $this->trongate_security->make_sure_allowed();
        $this->validation->set_rules('project_title', 'project title', 'required|min_length[5]|max_length[55]');
        $this->validation->set_rules('slug', 'slug', 'required|min_length[5]|max_length[32]');
        $this->validation->set_rules('description', 'description', 'required|min_length[3]');

        $result = $this->validation->run();

        if ($result===true) {
            $data = $this->model->get_data_from_post();

            $update_id = segment(3, 'int');
            if ($update_id===0) {
                //create new record.
                $this->db->insert($data, 'projects');
                set_flashdata('The new project was successfully created.');
                } else {
                    // update record
                    $this->db->update($update_id, $data, 'projects');
                    set_flashdata('The project was successfully updated.');
                }
            redirect('projects');
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
        $update_id = segment(3, 'int');
        $this->model->get_data_from_db($update_id); // will say 'project not found' if nonexistant
        

        $data = [
            'update_id' => $update_id,
            'form_location' => str_replace('/confirm_delete', '/submit_confirmation_delete', current_url()),
            'view_module' => 'projects',
            'view_file' => 'confirm_delete'
        ];

        $this->templates->admin($data);
    }

    /**
     * Handle confirmed deletion of a project.
     * 
     * @return void
     */
    public function submit_confirmation_delete(): void {
        $this->trongate_security->make_sure_allowed();

        $update_id = (int) post('update_id');
        $this->db->delete($update_id, 'projects');
        set_flashdata('The project record was successfully deleted.');
        redirect('projects/manage');
    }
}