<?php

class DBR_Query {
    private $query_string = '';

    public function get_query_string_by_id($query_id){
        global $wpdb;
        $this->query_string = $wpdb->get_var($wpdb->prepare("SELECT query FROM wp_eocdbr_queries WHERE query_id = %d;", $query_id));
        return $this->query_string;
    }

    public function set_query_string($query){
        global $wpdb;
        $result = $wpdb->query($wpdb->prepare("INSERT INTO wp_eocdbr_queries (query) VALUES ('%s');", $query));
        return $result;
    }

}
?>
