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
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $numberError = null;
        $inError = null;
		$outError = null;
		$emailError = null;
		$idError = null;
         
        // keep track post values
        $name = $_POST['FullName'];
        $number = $_POST['number'];
        $in = $_POST['in'];
		$out = $_POST['out'];
		$email = $_POST['email'];
		$id = $_POST['id'];
         
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
		if (empty($email)) {
            $outError = 'Please enter Email Address';
            $valid = false;
        }
         
		 if (empty($id)) {
            $idError = 'Please enter id';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `guestbook3`(`FullName`, `Mobile Number`, `In Time`, `Out Time`, `Email Id`, `Id`) VALUES (?, ?, ?, ?, ?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$number,$in,$out,$email,$id));
			
            Database::disconnect();
			
			
        }
		
    }
	echo "<h2>Row Inserted!!</h2>";
?>
