<?php

class DBR_RecordSet {
    private $query = '';
    private $results = array();

    public function setQuery($query_string){
        $this->query = $query_string;
    }

    private function fetchRecords(){
        global $wpdb;
        $results = $wpdb->get_results($this->query,ARRAY_A);
        $this->results = $results;
    }

    public function displayTable() {
        $this->fetchRecords($this->query);
        if(count($this->results) == 0) {
            echo '<em>No rows returned</em>';
        } else {
                echo '<table><thead><tr><th class="eocdbr">'.implode('</th><th class="eocdbr">', array_keys(reset($this->results))).'</th></tr></thead><tbody>'."\n";
                foreach($this->results as $result) {
                    echo '<tr><td>'.implode('</td><td>', array_values($result)).'</td></tr>'."\n";
                }
                echo '</tbody></table>';
        }
    }
}

//foo

?>
