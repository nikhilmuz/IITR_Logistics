<?php
/**
 * Created by PhpStorm.
 * User: nikhil
 * Date: 25/8/18
 * Time: 11:28 PM
 */
define("OFFICE_TABLE_NAME","office");
class Office
{
    private $office_table_name=OFFICE_TABLE_NAME;
    public function __construct($officeid)
    {
        $dbServer = DB_HOST;
        $dbUsername = DB_LOGIN;
        $dbPassword = DB_PASS;
        $dbName = DB_NAME;
        $this->officeid=$officeid;
        $con = mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
        if(mysqli_connect_errno()){
            die("Failed to connect with MySQL: ".mysqli_connect_error());
        }else{
            $this->connect = $con;
        }
        $this->isValid=$this->isValid();

    }

    public function __destruct()
    {
        ($this->connect)->close();
    }

    private function isValid(){
        $query = mysqli_query($this->connect,"SELECT * FROM ".$this->office_table_name." WHERE officeid = '".$this->officeid."'") or die(mysql_error($this->connect));
        if(mysqli_num_rows($query)>0){
            $result = mysqli_fetch_array($query);
            $this->name=$result['name'];
            return true;
        }else{
            return false;
        }
    }
    function getIDbyName($name){
        $query = mysqli_query($this->connect,"SELECT * FROM ".$this->office_table_name." WHERE upper(name) = '".strtoupper($name)."'") or die(mysql_error($this->connect));
        if(mysqli_num_rows($query)>0){
            $result = mysqli_fetch_array($query);
            return $result['officeid'];
        }else{
            (new DB())->telldb($this->office_table_name,array("officeid","name"),array($this->officeid,$name));
            return $this->officeid;
        }
    }
    static function getOffices(){
        return (new DB())->askdb_all(OFFICE_TABLE_NAME,null);
    }
}