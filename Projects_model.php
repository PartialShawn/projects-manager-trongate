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
        // $record_obj = $this->db->get_where($update_id, 'projects');

        
        $params = [
            'slug' => $proj_slug
        ];

        $sql = 'SELECT * FROM projects WHERE slug = :slug';
        $result = $this->db->query_bind($sql, $params, 'object');

        if ($result===false || count($result) == 0) {
            http_response_code(404);
            echo 'Project not found: '.$proj_slug;
            die;
        }

        $project = (array) $result[0];
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
