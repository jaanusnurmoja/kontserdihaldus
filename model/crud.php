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

    public function fields($data, $parent = null) {
        $toSubmit = array_filter($data, function ($item) {
            return !is_array($item);
        });
        $valTypes = [];
        foreach($toSubmit as $k => &$v)
        {
            //$valTypes[] = is_int($v) ? 'i' : (is_double($v) ? 'd' : 's');
            if ($parent != null && $k == $parent.'_id')
            {
                $v = "@last_id_$parent";
            }
            if ($k != $parent.'_id' && !is_int($v) && !is_double($v))
            {
                $v = "'$v'";
            }
        }
        $f = new stdClass;
        $f->names = implode(', ', array_keys($toSubmit));
        $f->toSubmit = $toSubmit;
        $f->values = implode(', ', array_values($toSubmit));
        $f->arrValues = array_values($toSubmit);
        //$f->prep = implode(', ', array_fill(0, count($toSubmit),'?'));
        //$f->valTypes = implode($valTypes);
        return $f;
    }

    public function queryBuilder($data, $table = 'kava', $sql=null, $parentTable = null)
    {
        
        $fields = $this->fields($data, $parentTable)->names;
        //$valTypes = $this->fields($data)->valTypes;
        $values = $this->fields($data, $parentTable)->values;
        //list($vars);
        //$prep = $this->fields($data)->prep;

        $sql .= "INSERT INTO $table($fields) VALUES($values); \n
        SET @last_id_$table = last_insert_id(); \n"; 
        if (!empty($this->related($data)))
        {
            foreach ($this->related($data) as $t => $d)
            {
                foreach ($d as $row)
                {
                    $sql .= $this->queryBuilder($row, $t, null, $table);
                }
            }
        }
        return $sql;

    }
    public function related($data) 
    {
        return array_filter($data, function ($item) {
            return is_array($item);
        });
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
            die("Ühenduse loomine ei õnnestunud: " . $conn->connect_error);
        }
        $sql=$this->queryBuilder($data, 'kava');
        

            print_r($sql);

        if ($this->db()->query($sql) == true) {
            echo "Uued read lisatud!";
            echo '<pre>';
            //print_r($this->related($data));
            echo '</pre>';
            //$lastId = $this->db()->insert_id;
        } else {
            echo "Viga: " . $sql . "<br>" . $this->db()->error;
        }        
  
    }


}

?>