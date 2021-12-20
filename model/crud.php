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

    public function fields($data, $lastId, $fk) {

        //$valTypes = [];

        $fields = array_keys($data);
        $vals = array_values($data);
        
        for ($i=0;$i<count($vals);$i++)
        {
                if ($fields[$i] == $fk) {$vals[$i] = $lastId;}
                if (!is_int($vals[$i]) && !is_float($vals[$i]) && !is_array($vals[$i]) && substr($vals[$i],0,1) != '@')
                {
                    $vals[$i] = "'$vals[$i]'";
                }

        }

/*
        foreach($data as $key => &$value)
        {
                //$valTypes[] = is_int($v) ? 'i' : (is_double($v) ? 'd' : 's');
                if ($key == $fk) {$value = $lastId;}
                if ($key != $fk & !is_int($value) && !is_float($value) && !is_array($value) && !str_starts_with($value,'@'))
                {
                    $value = "'$value'";
                }
                /*
            echo '<pre>väli: ';
            print_r($f);
            echo ' võõr: </pre>';
            print_r($fk);
            echo '<pre>viimatine: ';
            print_r($lastId);
            echo '</pre>';
            echo '<pre>andmed: ';
            print_r($s);
            echo '</pre>';
            */
            /*
        }
        */
        $f = new stdClass;
        $f->names = str_replace("'", "", implode(', ', $fields));
print_r($f->names);
        $f->values = implode(', ', $vals);
        $f->arrValues = $vals;
        //$f->prep = implode(', ', array_fill(0, count($toSubmit),'?'));
        //$f->valTypes = implode($valTypes);
        return $f;
    }

    public function queryBuilder($data, $table = 'kava', $lastId=null, $fk=null, $parentTable = null, $i=0)
    {
        
        
        $oneRecord = $this->oneRecord($data);
        $fields = $this->fields($oneRecord, $lastId, $fk)->names;
        //$valTypes = $this->fields($data)->valTypes;
        $values = $this->fields($oneRecord, $lastId, $fk)->values;
        //list($vars);
        //$prep = $this->fields($data)->prep;

        $sql = "INSERT INTO $table($fields) VALUES($values); \n";
        //$sql[$i] = "INSERT INTO $table($fields) VALUES($values); \n";
        $lastId = "@$table"."_id";
        $sql .= "SET $lastId = last_insert_id(); \n";
        //$sql[$i] .= "SET $lastId = last_insert_id(); \n";
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
                    $this->queryBuilder($row, $t, $lastId, $mainFkField, $table, $i+1);
                }
            }
        }
            
        if ($this->db()->multi_query($sql) == true)
        {        
            echo "<p>>Uued read lisatud!</p>";
            echo $sql;

        }
        else 
        {
            echo "Viga: " . $sql . "<br>" . $this->db()->error;
        }  
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

    public function submit($data)
    {
        
        if ($this->db()->connect_error) {
            die("Ühenduse loomine ei õnnestunud: " . $this->db()->connect_error);
        }
        $this->queryBuilder($data, 'kava');
        

    }


}

?>