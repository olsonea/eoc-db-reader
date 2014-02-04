<?php

class DBR_RecordSet {
    private $query = '';
    private $results = array();
    private $base_table = '';

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
		echo 'Base Table: ' . $this->base_table . '<br />';
		?>
			<div class=wrap>
				<form method="post" action ="">
					<table class="widefat post fixed">
					<?php 
					echo "\t";
					foreach ($this->results as $key => $value){
						echo '<tr><th class="eocdbr"><label class="eocdbr" for="'.$key.'">'.$key.': </label></th>'."\n"."\t"."\t"."\t"."\t"."\t"."\t"."\t";
						echo '<td class="eocdbr"><input class="eocdbr" type="text" id="'.$key.'" name="'.$key.'" value="'.$value.'" /></td></tr>'."\n"."\t"."\t"."\t"."\t"."\t"."\t";
					}
					echo "\n";
					?>
					</table>
					<button type="submit" name="submit">Submit</button>
				</form>
			</div> 
		<?php
		$_POST['table_name'] = $this->base_table;
		
	}

	private function writeRecords(){
		foreach($_POST as $key => $value){
			echo "$key => $value<br>";
		}
	}

	public function setQuery($query_string){
        $this->query = $query_string;
    }
    
    public function setBaseTable($query_string){
		global $wpdb;
		$explain = array();
		$base_table_query = 'EXPLAIN '. $query_string;
		$explain = $wpdb->get_row($base_table_query,ARRAY_A);
		$this->base_table = $explain["table"];
	}
     
    public function displayTable(){
        $this->fetchRecordsArray($this->query);
        if(count($this->results) == 0) {
			?>
            <em>No rows returned</em>
            <?php
        } else {
            echo '<table class="widefat post fixed"><thead><tr><th class="eocdbr">'.implode('</th><th class="eocdbr">', array_keys(reset($this->results))).'</th></tr></thead><tbody>'."\n";
            foreach($this->results as $result) {
                echo '<tr><td class="eocdbr">'.implode('</td><td>', array_values($result)).'</td></tr>'."\n";
            }
            ?>
            </tbody></table>
            <?php
        }
    }

    public function displayForm(){
        if (!isset($_POST['submit'])) {
			//$this->setBaseTable ($this->query);
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
