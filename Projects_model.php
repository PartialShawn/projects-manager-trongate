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
            'id'=>post('id', true),
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
    public function get_data_from_db(string $proj_slug): array {
        $result = $this->db->get_one_where('slug', $proj_slug, 'projects');

        if ($result===false) {
            http_response_code(404);
            echo 'Project not found: '.$proj_slug;
            die;
        }

        $project = (array) $result;
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
