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

        
        $sql = "UPDATE pagina SET ativa = 0 WHERE userid = $userid AND nome = '$nome';";
        echo("Page deleted");
        $db->query($sql);

        
        $db = null;
    }
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    <h3>Back to main menu</h3>
    <form action="index.php" method="post">
    <p><input type="submit" value="Back"/></p>
    </form>

    </body>
</html>
