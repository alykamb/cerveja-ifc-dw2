<?php


class DB
{
    private $db = null;
    function __construct()
    {
        $DB_HOST = 'ifc_dw_postgres';
        $DB_NAME = 'dw1';
        $DB_USER = 'postgres';
        $DB_PASSWORD = 'postgres';

        $this->db =
            pg_connect("host=$DB_HOST dbname=$DB_NAME user=$DB_USER password=$DB_PASSWORD");
    }

    public function query($request)
    {
        if (!$result = pg_query($this->db, $request)) {
            return False;
        }
        $combined = array();
        while ($row = pg_fetch_assoc($result)) {
            $combined[] = $row;
        }
        return $combined;
    }

    function __destruct()
    {
        pg_close($this->db);
    }
}
