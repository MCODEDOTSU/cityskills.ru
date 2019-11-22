<?php

class SlidersItems
{
    private $table;

    function __construct($table) {
        $this->table = $table;
    }

    /**
     * Get all slider's items
     * @param $sliderId
     * @return array
     */
    public function getAll($sliderId)
    {
        global $wpdb;
        $result = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM {$this->table} WHERE slider_id = %d ORDER BY `sort`",
            $sliderId
        ));
        return ['status' => 'success', 'result' => $result];
    }

    /**
     * Create new slider's item
     * @param $sliderId
     * @param $sort
     * @param $image
     * @param $title
     * @param $description
     * @param $button
     * @param $link
     * @param $title_style
     * @param $description_style
     * @param $button_style
     * @return array
     */
    public function create($sliderId, $sort, $image, $title, $description, $button, $link, $color)
    {
        global $wpdb;
        $data = [
            'slider_id' => $sliderId,
            'sort' => $sort,
            'image' => $image,
            'title' => $title,
            'description' => $description,
            'button' => $button,
            'link' => $link,
            'color' => $color
        ];
        if($wpdb->insert($this->table, $data, ['%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s']) === false) {
            $result = ['status' => 'error', 'result' => $wpdb->last_query];
        } else {
            $result = ['status' => 'success', 'result' => $wpdb->insert_id];
        }
        return $result;
    }

    /**
     * Edit slider's item
     * @param $sort
     * @param $image
     * @param $title
     * @param $description
     * @param $button
     * @param $link
     * @param $title_style
     * @param $description_style
     * @param $button_style
     * @param $id
     * @return array
     */
    public function update($sort, $image, $title, $description, $button, $link, $color, $id)
    {
        global $wpdb;
        $data = [
            'sort' => $sort,
            'image' => $image,
            'title' => $title,
            'description' => $description,
            'button' => $button,
            'link' => $link,
            'color' => $color,
        ];
        if($wpdb->update($this->table, $data, ['id' => $id], ['%d', '%s', '%s', '%s', '%s', '%s', '%s'], ['%d']) === false) {
            $result = ['status' => 'error', 'result' => $wpdb->last_query];
        } else {
            $result = ['status' => 'success', 'result' => $id];
        }
        return $result;
    }

    /**
     * Delete slider's item
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