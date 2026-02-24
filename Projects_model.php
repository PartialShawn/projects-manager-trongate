<?php
/**
 * Projects Model
 * 
 * Handles data operations for project records.
 */
class Projects_model extends Model {


    /**
     * Retrieve and sanitize project data from POST.
     * 
     * @return array<string, mixed>
     */
    public function get_data_from_post(): array {
        $data = [
            'project_title'=>post('project_title', true),
            'slug'=>post('slug', true),
            'description'=>post('description', true),
        ];

        return $data;
    }


    /**
     * Retrive a single record from DB.
     * 
     * @param int $update_id
     * @return array<string, mixed>
     */
    public function get_data_from_db($update_id): array {
        $record_obj = $this->db->get_where($update_id, 'projects');

        if ($record_obj===false) {
            http_response_code(404);
            echo 'Project not found';
            die;
        }

        $project = (array) $record_obj;
        return $project;
    }


    /**
     * Retrieve all project records from DB.
     * 
     * @return array<StdObj>
     */
    public function fetch_projects(): array {
        $projects = $this->db->get('id', 'projects');

            return $projects;
    }
}
