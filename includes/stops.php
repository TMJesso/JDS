<?php

class Stops extends Common
{

    protected static $table_name = "stops";

    protected static $db_fields = array(
        'id',
        'stops_id',
        'st_id',
        'description',
        'address',
        'stop_time',
        'shelter',
        'direction'
    );

    /**
     * Stops
     *
     * @var int 11 auto_increment
     */
    public $id;

    /**
     * Stops
     *
     * @var string 12 binary primary (stops_id, stop_time)
     */
    public $stops_id;

    /**
     * Stops
     *
     * @var string 12 binary
     */
    public $st_id;

    /**
     * Stops
     *
     * @var string 100
     */
    public $description;

    /**
     * Stops
     *
     * @var string 50
     */
    public $address;

    /**
     * Stops
     *
     * @var int 2 (minutes on the hour)
     */
    public $stop_time;

    /**
     * Stops
     *
     * 0 - (false) shelter<br>
     *
     * 1 - (true) shelter
     *
     * @var boolean (0/1)
     */
    public $shelter;

    /**
     * Stops
     *
     * @var string enum(Transer, East bound, West bound, North bound, South bound)
     */
    public $direction;

    public static function get_stop_by_st_id($id = '')
    {
        if (! has_presence($id)) {
            return false;
        }
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE st_id = '{$id}' ";
        return self::find_by_sql($sql);
    }

    public static function get_stop_by_stops_id($id = '')
    {
        if (! has_presence($id)) {
            return false;
        }
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE stops_id = '{$id}' ";
        $row = self::find_by_sql($sql);
        return ($row) ? array_shift($row) : false;
    }

    public static function get_all_stops_with_shelters($logic = true)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE ";
        if ($logic) {
            $sql .= "shelter ";
        } else {
            $sql .= "NOT shelter ";
        }
        $sql .= "ORDER BY st_id, stop_time ";
        return self::find_by_sql($sql);
    }
}

?>
