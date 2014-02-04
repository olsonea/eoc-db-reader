<?php

class DBR_Query {
    private $query_string = '';

    public function get_query_string_by_id($query_set_id, $query_type){
        global $wpdb;
        $this->query_string = $wpdb->get_var($wpdb->prepare("SELECT query FROM wp_dbr_queries WHERE query_set_id = %d and query_type = %s;", $query_set_id, $query_type));
        return $this->query_string;
    }

    public function set_query_string($query_set_id, $query_type, $query){
        global $wpdb;
        $result = $wpdb->query($wpdb->prepare("INSERT INTO wp_dbr_queries (query_set_id, query_type, query) VALUES('%d','%s','%s');", $query_set_id, $query_type, $query));
        return $result;
    }
}
?>
