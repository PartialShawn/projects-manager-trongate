<?php
/**
 * Tasks Model
 * 
 * Handles data operations for task records.
 */
class Tasks_model extends Model {


    /**
     * Retrieve and sanitize task data from POST.
     * 
     * @return array<string, mixed>
     */
    public function get_data_from_post(): array {
        $data = [
            'task_title'=>post('task_title', true),
            'description'=>post('description', true),
            'complete'=>(int)(bool)post('complete', true)
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
        $record_obj = $this->db->get_where($update_id, 'projects_tasks');

        if ($record_obj===false) {
            http_response_code(404);
            echo 'Task not found';
            die;
        }

        $task = (array) $record_obj;
        return $task;
    }


    /**
     * Retrieve all task records from DB.
     * 
     * @return array<StdObj>
     */
    public function fetch_tasks(string $proj_slug): array|false {

        $params = [
            'slug' => $proj_slug
        ];

        $sql = 'SELECT t.* FROM projects_tasks AS t
                LEFT JOIN projects AS p ON t.project_id = p.id
                WHERE p.slug = :slug';
        $tasks = $this->db->query_bind($sql, $params, 'object');

        if (empty($tasks)) {
            return false;
        }

        foreach($tasks as $key=>$task) {
            $complete = (int) $task->complete;

            $tasks[$key]->status_icon = ($complete===1)?'✔️':'⬜';
        }

        return $tasks;
    }

    public function insert(array $data, string $slug): bool {
        $project = $this->db->get_one_where('slug', $slug, 'projects');
        $data['project_id'] = $project->id;

        return $this->db->insert($data, 'projects_tasks');
    }
}
