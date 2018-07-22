<?php
include 'connection.php';
error_reporting(0);
$keyword=$_POST["keyword"];
if(!empty($keyword)) {
$query =mysqli_query($link,"SELECT DISTINCT * FROM pastpapers WHERE unit_name LIKE '%$keyword%' OR unit_code LIKE '%$keyword%' LIMIT 0,6");

if(mysqli_num_rows($query)>0) {
?>
<ul id="search-list">
<?php
while ($cols=mysqli_fetch_array($query)) {  
?>
<li onClick="selectsearch('<?php echo $cols["unit_name"]; ?>');"><?php echo $cols["unit_name"]; ?> - <?php echo $cols["unit_code"]; ?> </li>
<?php } ?>
</ul>
<?php } } ?>