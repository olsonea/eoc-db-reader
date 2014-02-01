<?php

class DBR_RecordSet {
    private $query = '';
    private $results = array();

    public function setQuery($query_string){
        $this->query = $query_string;
    }

    private function fetchRecordsArray(){
        global $wpdb;
        $results = $wpdb->get_results($this->query,ARRAY_A);
        $this->results = $results;
    }

    private function fetchRecordsObject(){
        global $wpdb;
        $results = $wpdb->get_row($this->query,OBJECT);
        $this->results = $results;
    }
     
    public function displayTable(){
        $this->fetchRecordsArray($this->query);
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

    public function displayForm(){
        if (!isset($_POST['submit'])) {
            $this->fetchRecordsObject($this->query);
            if(count($this->results) == 0) {
                echo '<em>No rows returned</em>';
            } else { ?>
                <div class=wrap>
					<form method="post" action ="">
						<table>
						<?php foreach ($this->results as $key => $value){
							echo '<tr><th><label class="eocdbr" for="'.$key.'">'.$key.': </label></th>'."\n";
							echo '<td><input class="regular-text" type="text" id="'.$key.'" name="'.$key.'" value="'.$value.'" /></td></tr>'."\n";
							}?>
						</table>
						<button type="submit" name="submit">Submit</button>
					</form>
                </div> <?php
            }
        } else {
            foreach($_POST as $key => $value){
				echo "$key => $value<br>";
			}   
        }
    }
}
?>
