<html>
<head>
  <title> shop </title>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
print "testing";
$db = new SQLite3("test.db");

print "didn't die";
?>
</body>
</html>
