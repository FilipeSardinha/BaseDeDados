<html>
 <body>
<?php
 $userid = $_REQUEST['userid'];
 $tnome = $_REQUEST['tnome'];
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

 $sql = "SELECT typecnt from tipo_registo where userid = $userid and nome = '$tnome';";
 $result = $db->query($sql) ;
 $f = $result->fetch();
 $tc = $f['typecnt'];
 $typecnt = $f['typecnt'];
 if( $tc == NULL ){
   echo("Error: No such type\n");
   break;
 }


 $sql = "SELECT max(campocnt) as maxcc from campo;";
 $result = $db->query($sql);
 $f = $result->fetch();
 $campocnt = $f['maxcc'] + 1;

 $sql = "SELECT max(contador_sequencia) as maxcs from sequencia;";
 $result = $db->query($sql);
 $f = $result->fetch();
 $idseq = $f['maxcs'] + 1;

 date_default_timezone_set("Europe/Lisbon");
 $moment = date('Y-m-d h:i:s', time());

 $sql = "INSERT INTO sequencia (userid, contador_sequencia,moment) VALUES
                  ($userid, $idseq, '$moment');";
 $db->query($sql);

 $sql = "INSERT INTO campo (userid, typecnt, campocnt, nome, idseq, ativo) VALUES
                  ($userid, $typecnt, $campocnt, '$nome', $idseq , true);";
 $db->query($sql);
 echo("New field added");
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
