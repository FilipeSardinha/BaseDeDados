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

 /* $sql = "SELECT userid from utilizador where userid = $userid;";
 $result = $db->query($sql) ;
 $f = $result->fetch();
 $id = $f['userid'];
 if( $id == NULL ){
   echo("Error: No such user\n");
   break;
 }


 $sql = "SELECT pagecounter from pagina where pagecounter = $pagecounter and userid = $userid;";
 $result = $db->query($sql) ;
 $f = $result->fetch();
 $pg = $f['pagecounter'];

 if($pg == NULL){
   echo("Error: No such page\n");
   break;
 }
*/
 $sql = "SELECT pagecounter from pagina where nome = '$nome' and userid = $userid;";
 $result = $db->query($sql) ;
 $f = $result->fetch();
 $pagecounter = $f['pagecounter'];
// echo($nome);
 

 $sql = "SELECT RP.regid, R.nome from reg_pag RP, registo R  where RP.userid = $userid and pageid = $pagecounter and R.regcounter = RP.regid;";

 $result = $db->query($sql);

 echo("<table border=\"0\" cellspacing=\"5\">\n");
 foreach($result as $row)
 {
 echo("<tr>\n");
 echo("<td>{$row['regcounter']}</td>\n");
 echo("<td>{$row['nome']}</td>\n");
 echo("</tr>\n");
 }
 echo("</table>\n");


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
