<html>
 <body>
<?php
 $userid = $_REQUEST['userid'];
 $tname = $_REQUEST['tname'];
 $nome = $_REQUEST['nome'];
 $valor = $_REQUEST['valor'];
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

 $sql = "SELECT typecnt from tipo_registo where userid = $userid and nome = '$tname';";
 $result = $db->query($sql);
 $f = $result->fetch();
 $typecounter = $f['typecnt'];
echo("<p>$sql</p>");

 $sql = "SELECT max(regcounter) as maxrc from registo;";
 $result = $db->query($sql);
 $f = $result->fetch();
 $regcounter = $f['maxrc'] + 1;
echo("<p>$sql</p>");
 $sql = "SELECT max(contador_sequencia) as maxcs from sequencia;";
 $result = $db->query($sql);
 $f = $result->fetch();
 $idseq = $f['maxcs'] + 1;
echo("<p>$sql</p>");
 date_default_timezone_set("Europe/Lisbon");
 $moment = date('Y-m-d h:i:s', time());
 
 $sql = "INSERT INTO sequencia (userid, contador_sequencia,moment) VALUES
                  ($userid, $idseq, '$moment');";
 $db->query($sql);
echo("<p>$sql</p>");
 $sql = "INSERT INTO registo (userid, typecounter, regcounter, nome, idseq, ativo) VALUES
                  ($userid, $typecounter, $regcounter,'$nome', $idseq , true);";
 $db->query($sql);
echo("<p>$sql</p>");
 $sql = "SELECT max(campocnt) as maxcc from campo;";
 $result = $db->query($sql);
 $f = $result->fetch();
 $maxcc = $f['maxcc'] + 1;
echo("<p>$sql</p>");
 $sql = "SELECT max(contador_sequencia) as maxcs from sequencia;";
 $result = $db->query($sql);
 $f = $result->fetch();
 $idseq = $f['maxcs'] + 1;
echo("<p>$sql</p>");
 date_default_timezone_set("Europe/Lisbon");
 $moment = date('Y-m-d h:i:s', time());
 
 $sql = "INSERT INTO sequencia (userid, contador_sequencia, moment) VALUES
                  ($userid, $idseq, '$moment');";
 $db->query($sql);
 $sql = "INSERT INTO campo (userid, typecnt, campocnt, nome, idseq, ativo) VALUES
                  ($userid, $typecounter, $maxcc, $idseq, '$nome', true);";
 $db->query($sql);
echo("<p>$sql</p>");
 $sql = "SELECT max(contador_sequencia) as maxcs from sequencia;";
 $result = $db->query($sql);
 $f = $result->fetch();
 $idseq = $f['maxcs'] + 1;
echo("<p>$sql</p>");
 date_default_timezone_set("Europe/Lisbon");
 $moment = date('Y-m-d h:i:s', time());
 
 $sql = "INSERT INTO sequencia (userid, contador_sequencia,moment) VALUES
                  ($userid, $idseq, '$moment');";
 $db->query($sql);
 $sql = "INSERT INTO valor (userid, typeid, campoid, regid, valor, idseq, ativo) VALUES
                  ($userid, $typecounter, $regcounter, $maxcc, '$valor', $idseq, true);";
 $db->query($sql);
 echo("<p>$sql</p>");
 

 //-------------------------------------
 /*
 $sql = "SELECT campocnt from campo where userid = $userid and typecnt = $typecounter;";
 $result = $db->query($sql);

 foreach($result as $row){
   $sqlr = "INSERT INTO valor (userid, typeid, campoid, regid, valor, idseq, ativo) VALUES
                    ($userid, $typecounter, $row['campocnt'], $regcounter,'', $idseq , true);";

 }*/
 //-------------------------------------


 echo("New register added");
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
