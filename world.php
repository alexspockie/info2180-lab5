<style><?php include 'world.css'; ?></style>
<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$cntry=$_GET['country'];
$cntry="%$cntry%";   // have to do this in order to get the query with LIKE to work
//$cntry=htmlspecialchars($cntry);
if(isset($_GET['context'])){
  $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE ?");
  
  $stmt->execute([$cntry]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
}
else{
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE ?");
  $stmt->execute([$cntry]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<?php if(isset($_GET['context'])){ ?>
  <table>
  <thead>
    <th>Name</th>
    <th>District</th>
    <th>Population</th>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name'];?></td> 
      <td><?= $row['district'];?></td>
      <td><?= $row['population']; ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody> 
</table>
<?php } ?>

<?php if (!isset($_GET['context'])){ ?>
<table>
  <thead>
    <th>Name</th>
    <th>Continent</th>
    <th>Independence Year</th>
    <th>Head of State</th>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name'];?></td> 
      <td><?= $row['continent'];?></td>
      <td><?= $row['independence_year'];?></td>
      <td><?= $row['head_of_state']; ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody> 
</table>
<?php } ?>


