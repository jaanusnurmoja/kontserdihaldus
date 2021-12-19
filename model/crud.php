<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once('localData.php');

class Crud
{

	protected function db()
	{
		$cnf = parse_ini_file('../config/connection.ini');
		$conn = new mysqli($cnf["servername"], $cnf["username"], $cnf["password"], $cnf["dbname"]);
		return $conn;
	}

    public function submit($data)
    {
        //SELECT max(id) FROM $table;";
/*
        $stmt = $this->db()->prepare("INSERT INTO $table($fields) VALUES($prep)"); //Fetching all the records with input credentials
        $stmt->bind_param("$valTypes", implode(', ',$vars)); //Where s indicates string type. You can use i-integer, d-double
        var_dump($stmt);
        $stmt->execute();
        $result = $stmt->affected_rows;
        $stmt->close();
        INSERT INTO kava(title, description, concert_date, start_time, duration, calc_duration) VALUES('ahaha bbbbb asd', '', '', '', '', '00:05:00'); SET @last_id_kava = last_insert_id();
INSERT INTO esitus(kava_id,jrk) VALUES(@last_id_kava, 10);
INSERT INTO esitus(kava_id,jrk) VALUES(@last_id_kava, 20);
INSERT INTO esitus(kava_id,jrk) VALUES(@last_id_kava, 10)
 */     
       
        if ($this->db()->connect_error) {
            die("Ühenduse loomine ei õnnestunud: " . $this->db()->connect_error);
        }
        $sql= $this->queryBuilder($data);
        
            if ($this->db()->multi_query($sql) == true) {
                echo "Andmed lisatud!";
                echo '<p>' . $sql . '</p>';
                //print_r($this->related($data));
                //$lastId = $this->db()->insert_id;
            } else {
                echo "Viga: " . $sql . "<br>" . $this->db()->error;
            }        


        $this->db()->close();
  
    }
    public function queryBuilder($data, $table = null, $f = null, $sql=null, $parentTable = null)
    {
       
        if ($table == null) $table = 'kava';
        $sql .= '';
        if ($f == null) {
            $f = $this->fields($data->fieldsToSubmit, $parentTable);
        }
        
        $fields = str_replace("'", "", $f->names);
        //$valTypes = $this->fields($data)->valTypes;
        $values = $f->values;
        //list($vars);
        //$prep = $this->fields($data)->prep;
        $i = 0;
        echo '<p>' . $i . ' - ' . $table . ', ' . $values . ', parent:' . $parentTable . ' fp:' . $f->parent . ' fväli: ' . $f->vali . '</p>';

        $sql .= "INSERT INTO $table($fields) VALUES($values); \n";

        if (isset($data->related))
        {
            $sql .= "SET @last_id_$table = last_insert_id(); \n"; 
            //$q = $sql;
            foreach ($data->related as $t => $d)
            {
                foreach ($d as $row)
                {
                    $i +=1; 
                    $f = $this->fields($row->fieldsToSubmit, $table);
                    print_r($f);
                    $sql .= $this->queryBuilder($row, $t, $f, null, $table);
                }
            }
        }
        return $sql;

    }


    public function fields($data, $parent = null) {
        
        //$valTypes = [];
        $f = new stdClass;
        //$f->toSubmit = $toSubmit;
        $f->vali = '';
        foreach($data as &$v)
        {
            echo key($data);
            //$valTypes[] = is_int($v) ? 'i' : (is_double($v) ? 'd' : 's');
            if (key($data) != $parent.'_id')
            {
                if (!(is_int($v) || is_double($v)))
                {
                    $v = "'$v'";
                }
            }
            else 
            {
                $v = "@last_id_$parent";
            }
           
        }
        $f->names = implode(', ', array_keys($data));
        $f->parent = $parent;
        $f->values = implode(', ', array_values($data));

        
        //if (isset($grouped->related)) {$f->related = $grouped->related;}

        //$f->arrValues = array_values($toSubmit);
        //$f->prep = implode(', ', array_fill(0, count($toSubmit),'?'));
        //$f->valTypes = implode($valTypes);
        return $f;
    }

    public function toSubmitAndRelated($data) 
    {
        $f = new stdClass;
        $f->fieldsToSubmit = array_filter($data, function ($item) {
            return !is_array($item);
        });
        $related = array_filter($data, function ($item) {
            return is_array($item);
        });
        if ($related) {
            
            foreach ($related as $table => &$rows) {
                foreach ($rows as $row => $values)
                {
                    $related[$table][$row] = $this->toSubmitAndRelated($values);
                }
            }
            $f->related = $related;
        }

        return $f;
    }
}

?>