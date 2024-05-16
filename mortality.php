
<style>
#pickquery {
     height: 50px;
     width: 150px;
}
</style>

<form action='query.php' size=20px>          
  <input type="submit" id="pickquery" value="Pick another query">
</form>

 <?php
       include 'get-parameters.php';

        //Query for childhood mortality rate
        $sql = "select name, mortalityunder5 from countrydata_table;";
//        $conn = new mysqli($_SESSION['ep'], $_SESSION['un'], $_SESSION['pw'], $_SESSION['db']);
        $conn = mysqli_init();
        mysqli_ssl_set($conn,NULL,NULL, "$sslcert", NULL, NULL);
	mysqli_real_connect($conn, "$host", "$username", "$password", "$db_name", 3306, MYSQLI_CLIENT_SSL);

        if ($conn->connect_error) {
            error_log('Connection error: ' . $conn->connect_error);
            var_dump('Connection error: ' . $conn->connect_error);
        }
        else {

          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              //echo "success";
              echo '<table style="width: 80%">';
              echo '<tr>';
              echo '<th style="text-align:left">Country Name</th>';
              echo '<th style="text-align:left">Childhood Mortality</th>';
              echo '</tr>';

              while($row = $result->fetch_assoc()) {
              //echo '<p>';

              echo '<tr>';
              echo '<td>';
              echo $row["name"];
              echo '&nbsp';
              echo '<td>';
              echo $row["mortalityunder5"];
              echo '&nbsp';
              echo '<br>';
              echo '</tr>';
              }
              echo '</table>';
          }
        }

    ?>
