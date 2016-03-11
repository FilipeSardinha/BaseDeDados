<html>
 <body>
<?php
 $userid = $_REQUEST['userid'];
 $nome = $_REQUEST['nome'];
 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist171035";
 $password = "yadv0110";
 $dbname = $user;
 $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = "SELECT userid from utilizador where userid = $userid;";
 $result = $db->query($sql) ;
 $f = $result->fetch();
 $id = $f['userid'];
 if( $id == NULL ){
   echo("Error: No such user\n");
   break;
 }


 $sql = "SELECT max(pagecounter) as maxpc from pagina;";
 $result = $db->query($sql);
 $f = $result->fetch();
 $pagecounter = $f['maxpc'] + 1;

 $sql = "SELECT max(contador_sequencia) as maxcs from sequencia;";
 $result = $db->query($sql);
 $f = $result->fetch();
 $idseq = $f['maxcs'] + 1;

 date_default_timezone_set("Europe/Lisbon");
 $moment = date('Y-m-d h:i:s', time());

 $sql = "INSERT INTO sequencia (userid, contador_sequencia,moment) VALUES
                  ($userid, $idseq, '$moment');";
 $db->query($sql);

 $sql = "INSERT INTO pagina (userid, pagecounter, nome, idseq, ativa) VALUES
                  ($userid, $pagecounter, '$nome', $idseq , true);";
 echo("New page added");
 $db->query($sql);
 $db = null;
 }
 catch (PDOException $e)
 {
 echo("<p>ERROR: {$e->getMessage()}</p>");
 }
?>
 
    <h3>Back to main menu</h3>
    <form action="index.php" method="post">
    <p><input type="submit" value="Back"/></p>
    </form>

 </body>
</html>
