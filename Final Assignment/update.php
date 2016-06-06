<?php
    
class Database
{
    private static $dbName = 'guestbook' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
     if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $numberError = null;
        $inError = null;
		$outError = null;
         
        // keep track post values
        $name = $_POST['FullName'];
        $number = $_POST['number'];
        $in = $_POST['in'];
		$out = $_POST['out'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($number)) {
            $numberError = 'Please enter mobile number';
            $valid = false;
        
        }
         
        if (empty($in)) {
            $inError = 'Please enter Entry Time';
            $valid = false;
        }
		
		if (empty($out)) {
            $outError = 'Please enter Exit Time';
            $valid = false;
        }
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE guestbook2  set name = ?, number = ?, in =?, out =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$number,$in,$out,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM guestbook2  where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['FullName'];
        $number = $data['number'];
        $in = $data['in'];
        $out = $data['out'];
        $id = $data['id'];
        Database::disconnect();
    }
?>