<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$cntry=$_GET['country'];
if(isset($_GET['context'])){
  $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$cntry%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
}
else{
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$cntry%'");
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


