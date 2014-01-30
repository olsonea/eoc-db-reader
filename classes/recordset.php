<?php

class RecordSet {
    public $query = '';

    public function setQuery($query_string){
        $this->query = $query_string;
    }

    private function fetchRecords( $query ){
        global $wpdb;
        $results = $wpdb->get_results($query,ARRAY_A);
        return $results;
    }

    public function displayTable() {
        $results = $this->fetchRecords($this->query);
        if(count($results) == 0) {
            echo '<em>No rows returned</em>';
        } else {
                echo '<table><thead><tr><th class="eocdbr">'.implode('</th><th class="eocdbr">', array_keys(reset($results))).'</th></tr></thead><tbody>'."\n";
                foreach($results as $result) {
                    echo '<tr><td>'.implode('</td><td>', array_values($result)).'</td></tr>'."\n";
                }
                echo '</tbody></table>';
        }
    }
}

?>
