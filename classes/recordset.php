<?php

class DBR_RecordSet {
    private $query = '';
    private $results = array();

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

    private function formatForm(){
		?>
			<div class=wrap>
				<form method="post" action ="">
					<table class="eocdbr">
					<?php foreach ($this->results as $key => $value){
						echo '<tr><th class="eocdbr"><label class="eocdbr" for="'.$key.'">'.$key.': </label></th>'."\n";
						echo '<td class="eocdbr"><input class="eocdbr" type="text" id="'.$key.'" name="'.$key.'" value="'.$value.'" /></td></tr>'."\n";
						}?>
					</table>
					<button type="submit" name="submit">Submit</button>
				</form>
			</div> 
		<?php
	}

	private function writeRecords(){
		foreach($_POST as $key => $value){
			echo "$key => $value<br>";
		}
	}

	public function setQuery($query_string){
        $this->query = $query_string;
    }
     
    public function displayTable(){
        $this->fetchRecordsArray($this->query);
        if(count($this->results) == 0) {
            echo '<em>No rows returned</em>';
        } else {
            echo '<table class="eocdbr"><thead><tr><th class="eocdbr">'.implode('</th><th class="eocdbr">', array_keys(reset($this->results))).'</th></tr></thead><tbody>'."\n";
            foreach($this->results as $result) {
                echo '<tr><td class="eocdbr">'.implode('</td><td>', array_values($result)).'</td></tr>'."\n";
            }
            echo '</tbody></table>';
        }
    }

    public function displayForm(){
        if (!isset($_POST['submit'])) {
            $this->fetchRecordsObject($this->query);
            if(count($this->results) == 0) {
                echo '<em>No rows returned</em>';
            } else {
				$this->formatForm();
            }
        } else {
            $this->writeRecords();
        }
    }
    

}
?>
