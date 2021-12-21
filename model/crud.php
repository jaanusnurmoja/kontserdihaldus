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

     public function firstRestructor($key, $row, $table = 'kava')
    {
        foreach ($row as $field => &$value)
        {
            if ($field == 'jrk')
            {
                $value = $key;
            }
            
            if ($field == $table.'_id')
            {
                $value = '(SELECT max(id) FROM ' . $table . ')';
            }
            if (is_array($value))
            {
                $newlist = array_values($value);

                foreach ($newlist as $key => &$row)
                {
                    $newlist[$key] = $this->firstRestructor($key, $row, $field);
                }

                $value = $newlist;

            }

        }
        //$row = array_merge($row, $arrays);
        return $row;
    }
     
    public function related($data) 
    {
        return array_filter($data, function ($item) {
            return is_array($item);
        });
    }

    public function oneRecord($data) 
    {
        return array_filter($data, function ($item) {
            return !is_array($item);
        });
    }
  
    public function fields($data, $lastId, $fk) {

        //$valTypes = [];

        $fields = array_keys($data);
        $vals = array_values($data);
        $reorg = [];
        for ($i=0;$i<count($vals);$i++)
        {
            if (!is_int($vals[$i]) && !is_float($vals[$i]) && !is_array($vals[$i]) && $fields[$i] != $fk)
            {
                $vals[$i] = "'$vals[$i]'";
            }
            if ($fields[$i] == $fk)
            {
                $vals[$i] = $lastId;
            }
            $reorg[$i] = new stdClass;
            $reorg[$i]->field = $fields[$i];
            $reorg[$i]->value = $vals[$i];
        }

        $f = new stdClass;
        $f->names = str_replace("'", "", implode(', ', $fields));
//print_r($f->names);
        $f->values = implode(', ', $vals);
        $f->reorg = $reorg;
        return $f;
    }

    public function queryBuilder($data, $table = 'kava', $lastId=null, $fk=null, $parentTable = null)
    {
        if ($parentTable) {$lastId = '(SELECT max(id) FROM ' . $parentTable . ')';}
        $oneRecord = $this->oneRecord($data);
        $fields = $this->fields($oneRecord, $lastId, $fk);
        //$valTypes = $this->fields($data)->valTypes;
        //list($vars);
        //$prep = $this->fields($data)->prep;
            echo '<pre> ';
            print_r($fields->reorg);
            echo '</pre> ';

        $sql = "INSERT INTO $table($fields->names) VALUES($fields->values); \n";
        $sql = str_replace("'{parent_id}'", "(SELECT max(id) FROM $parentTable)", $sql);
        //$sql[] = "INSERT INTO $table($fields) VALUES($values); \n";
        //$lastId = "@$table"."_id";
        //$sql .= "SET $lastId = last_insert_id(); \n";
            echo '<pre> ';
            echo $sql;
            echo '</pre> ';
            
        if ($this->db()->query($sql) == true)
        {        

            echo "<p>Uus rida lisatud! ". $lastId ."</p>";
        }
        else 
        {
            echo "Viga: " . $sql . "<br>" . $this->db()->error;
        }  
        
        if (!empty($this->related($data)))
        {
        echo '<pre> ';
        print_r("Andmed $table alamate kohta olemas!");
        echo '</pre>';
            foreach ($this->related($data) as $t => $d)
            {
                foreach ($d as $row)
                {
                    $mainFkField = $table . '_id';
                    //echo '<pre> ';
                    //print_r("Mis on $table pk?");
                    //echo '</pre>';
                    $this->queryBuilder($row, $t, $lastId, $mainFkField, $table);
                }
            }
        }
        return $sql;
    }
    

    public function submit($data)
    {
        
        if ($this->db()->connect_error) {
            die("Ühenduse loomine ei õnnestunud: " . $this->db()->connect_error);
        }
        $sql = [];
        $this->queryBuilder($data, 'kava');

        $this->db()->close();
/*
        
*/
    }


}

?>