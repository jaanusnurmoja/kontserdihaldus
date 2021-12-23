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
        $f->values = implode(', ', $vals);
        $f->reorg = $reorg;
        return $f;
    }

    public function queryBuilder($data, $table = 'kava', $lastId=null, $fk=null, $parentTable = null)
    {
        $oneRecord = $this->oneRecord($data);
        $fields = $this->fields($oneRecord, $lastId, $fk);

        $sql = "INSERT INTO $table($fields->names) VALUES($fields->values); \n";
        $sql = str_replace("'{parent_id}'", "(SELECT max(id) FROM $parentTable)", $sql);
            
        if ($this->db()->query($sql) == true)
        {        
            echo '<div class="row-fluid">';
            echo "<p>Uus rida lisatud! $lastId </p>";
            echo "<p>$sql</p>";
            echo '</div>';
        }
        else 
        {
            echo "Viga: " . $sql . "<br>" . $this->db()->error;
        }  
        
        if (!empty($this->related($data)))
        {
            $lastId = '(SELECT max(id) FROM ' . $table . ')';
            foreach ($this->related($data) as $t => $d)
            {
                foreach ($d as $row)
                {
                    $mainFkField = $table . '_id';
                    $this->queryBuilder($row, $t, $lastId, $mainFkField, $table);
                }
            }
        }
        return $sql;
    }
    

    public function insert($data)
    {
        
        if ($this->db()->connect_error) {
            die("Ühenduse loomine ei õnnestunud: " . $this->db()->connect_error);
        }
        $sql = [];
        $this->queryBuilder($data, 'kava');

        $this->db()->close();
    }

    public function select($table, $fields = '*', $where = null, $order = 'id', $limit = null, $group = null)
    {
        $db = $this->db();
        if ($db->connect_error) {
            die("Ühenduse loomine ei õnnestunud: " . $this->db()->connect_error);
        }
        $sql = "SELECT $fields FROM $table";
        $sql .= $where ? " WHERE $where" : '';
        $sql .= $group ? " GROUP BY $group" : '';
        $sql .= " ORDER BY $order";
        $sql .= $limit ? " LIMIT($limit)" : '';
        print_r($sql);
        $data = new LocalData;
        if ($result = $db->query($sql))
        {
            echo '<table style="border:1px solid black; border_collapse:none;">';
            echo '<thead><tr>';
            while ($row = $result->fetch_field())
            {

                $data->setData($row);
                //$key = key($row);
                echo '<th style="border:1px solid black; border_collapse:none;padding:2px;">';
                echo $data->getData()->name;
                echo '</th>';
            }
            echo '</tr></thead>';
            if ($result->num_rows > 0)
            {
                echo '<tbody>';
                while ($row = $result->fetch_object())
                {
                    echo '<tr>';
                    //$data = new LocalData($row);
                    $data->setData($row);
                    foreach ($data->getData() as $k => $v)
                    {
                        if ($k == 'teos_info_txt')
                        {
                            $decoded = json_decode($v);
                            $v = "$decoded->pealkiri<br>
                            $decoded->autorid";
                        }
                        $data->getData()->$k = $v;
                        echo '<td style="border:1px solid black; border_collapse:none;padding:2px;">' . 
                        $data->getData()->$k . 
                        '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tbody>';
            }
            echo '</table>';
        }
    }

}

?>