<?php

class Crud
{
    public DB $db;
    public string $table;

    function __construct(DB $db, string $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    public function create($data)
    {
        $sql = "INSERT INTO $this->table (";
        $columns = "";
        $values = "";

        foreach ($data as $key => $value) {
            if (is_object($value) && $value instanceof Field) {
                if ($key == "id") {
                    continue;
                }
                if (isset($value->value)) {
                    $columns .= "$key,";
                    if ($value->type == "text") {
                        $values .= "'$value->value',";
                    } else {
                        $values .= "$value->value,";
                    }
                }
            }
        }

        if (strlen($columns) > 0) {
            $columns = substr($columns, 0, -1);
        } else {
            throw new Exception("Valores inválidos para cadastro de $this->table");
        }
        '
'
        if (strlen($values) > 0) {
            $values = substr($values, 0, -1);
        } else {
            return NUll;
        }

        $sql .= "$columns) VALUES ($values);";

        $this->db->query($sql);
    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        return $this->db->query($sql)[0];
    }

    public function findAll()
    {
        $sql = "SELECT * FROM $this->table";
        return $this->db->query($sql)[0];
    }

    public function findAllPage(int $page = 0, int $perPage = 10)
    {
        $offset = $page * $perPage;
        $sql = "SELECT * FROM $this->table LIMIT $perPage OFFSET $offset";
        return $this->db->query($sql)[0];
    }
};


/*
$result = pg_exec($db_handle, $query);

if ($result) {

echo "The query executed successfully.<br>";

echo "<h3>Print First and last name:</h3>";

for ($row = 0; $row < pg_numrows($result); $row++) {

$firstname = pg_result($result, $row, 'fname');

echo $firstname ." ";

$lastname = pg_result($result, $row, 'lname');

echo $lastname ."<br>";

}

} else {

echo "The query failed with the following error:<br>";

echo pg_errormessage($db_handle);

}
*/