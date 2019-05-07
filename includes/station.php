<?php

class Station extends Common
{

    protected static $table_name = "station";

    protected static $db_fields = array(
        'id',
        'st_id',
        'line',
        'start_time',
        'end_time',
        'end'
    );

    /**
     * Station
     *
     * @var int 11 auto_increment
     */
    public $id;

    /**
     * Station
     *
     * @var string 12 primary
     */
    public $st_id;

    /**
     * Station
     *
     * @var string enum (Red, Blue, Yellow, Green, Orange)
     *     
     * @default Red
     */
    public $line;

    /**
     * Station
     *
     * @var string time (hh:mm:ss)
     */
    public $start_time;

    /**
     * Station
     *
     * @var string time (hh:mm:ss)
     */
    public $end_time;

    /**
     * Station
     *
     * @var string time (hh:mm:ss)
     *     
     */
    public $end;

    public static function get_all_stations_by_line()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY line";
        return self::find_by_sql($sql);
    }

    public static function get_station_by_id($id = '')
    {
        if (! has_presence($id)) {
            return false;
        }
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE st_id = '{$id}'";
        $row = self::find_by_sql($sql);
        return ($row) ? array_shift($row) : false;
    }

    public static function get_statin_by_line($line = '')
    {
        if (! has_presence($line)) {
            return false;
        }
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE line = '{$line}'";
        $row = self::find_by_sql($sql);
        return ($row) ? array_shift($row) : false;
    }
}

?>


