<? class Db
{
    private $connect;
    private static $db;
    /******************************************************************** */
    private function  __construct($options = null)
    {
        if ($options == null) {
            global $config;
            $s = $config['db']['host'];
            $u =  $config['db']['user'];
            $p = $config['db']['pass'];
            $db =  $config['db']['dbname'];
        } else {
            $s = $options['host'];
            $u = $options['user'];
            $p = $options['pass'];
            $db = $options['dbname'];
        }
        // Create connection
        $this->connect = new mysqli($s, $u, $p, $db);
        // Check connection
        if ($this->connect->connect_error) {
            echo "Connection failed: " . $this->connect->connect_error;
        }
    }
    /******************************************************************** */
    public static function getInstance($options = null)
    {
        if (self::$db == null) {
            self::$db = new Db($options);
        }
        return self::$db;
    }
    /******************************************************************** */
    public function getConnection()
    {
        return $this->connect;
    }
    /******************************************************************** */
    public function close()
    {
        $this->connect->close();
    }
    /******************************************************************** */
    public function first($sql)
    {
        $result = $this->query($sql);
        if ($result == null) {
            return null;
        } else {
            return $result[0];
        }
    }
    /******************************************************************** */
    public function query($sql)
    {
        $result = $this->connect->query($sql);
        $records = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        } else {
            return null;
        }
        return $records;
    }
    /******************************************************************** */
    public function insert($sql)
    {
        $result = $this->connect->query($sql);
        return $result;
    }
    /******************************************************************** */
    public function modify($sql)
    {
        $rowAffect = $this->connect->query($sql);
        return $rowAffect;
    }
    /******************************************************************** */
}
