<?php

class Sliders
{
    private $table;

    function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * Get all Sliders
     * @return array
     */
    public function getAll()
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$this->table} ORDER BY `id`");
        return ['status' => 'success', 'result' => $result];
    }

    /**
     * Get Slider by Id
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        global $wpdb;
        $result = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM {$this->table} WHERE id = %d",
            $id
        ));
        return ['status' => 'success', 'result' => $result];
    }

    /**
     * Create Slider
     * @param $title
     * @return array
     */
    public function create($title, $height, $speed)
    {
        global $wpdb;
        $data = [
            'title' => $title,
            'height' => $height,
            'speed' => $speed
        ];
        if ($wpdb->insert($this->table, $data, ['%s', '%s', '%d']) === false) {
            $result = ['status' => 'error', 'result' => $wpdb->last_query];
        } else {
            $result = ['status' => 'success', 'result' => $wpdb->insert_id];
        }
        return $result;
    }

    /**
     * Save Slider
     * @param $title
     * @param $id
     * @return array
     */
    public function update($title, $height, $speed, $id)
    {
        global $wpdb;
        $data = [
            'title' => $title,
            'height' => $height,
            'speed' => $speed
        ];
        if ($wpdb->update($this->table, $data, ['id' => $id], ['%s', '%s', '%d'], ['%d']) === false) {
            $result = ['status' => 'error', 'result' => $wpdb->last_query];
        } else {
            $result = ['status' => 'success', 'result' => $id];
        }
        return $result;
    }

    /**
     * Remove Slider
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        global $wpdb;
        if ($wpdb->delete($this->table, ['id' => $id], ['%d']) === false) {
            $result = ['status' => 'error', 'result' => $wpdb->last_query];
        } else {
            $result = ['status' => 'success', 'result' => $id];
        }
        return $result;
    }
}