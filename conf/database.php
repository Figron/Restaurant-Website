<?php
class Database {
  public $conn;

  public function getConnection(){
    $conn = mysqli_connect("localhost","root","Drbk085VTeopiQ45","restaurant") or die("Couldn't connect");
    $this->conn = $conn;
         return $conn;
}
function runQuery($query) {
  $result = mysqli_query($this->conn,$query);
  while($row=mysqli_fetch_assoc($result)) {
    $resultset[] = $row;
  }
  if(!empty($resultset))
    return $resultset;
}

function numRows($query) {
  $result  = mysqli_query($this->conn,$query);
  $rowcount = mysqli_num_rows($result);
  return $rowcount;
}
}
 ?>
