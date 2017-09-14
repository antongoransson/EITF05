<!DOCTYPE html>
<html>
<head>
  <title> Shop </title>
</head>
  <body>
    <h1>Shop</h1>
    <a href="login.html">Login</a>
    <a href="register.html">Register</a>
    <br><br>
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      require(__DIR__ . '/db.php');
      $db = new DB();
      if(!$db) {
        echo $db->lastErrorMsg();
      } else {
        $items= $db->getItems();
    }
    ?>
  </body>
    <?php if (count($items) > 0): ?>
      <table>
        <thead>
          <tr>
            <th><?php echo implode('</th><th>', array_keys(current($items))); ?></th>
          </tr>
        </thead>
        <tbody>
      <?php foreach ($items as $row): array_map('htmlentities', $row); ?>
          <tr>
            <td><?php echo implode('</td><td>', $row); ?></td>
          </tr>
      <?php endforeach; ?>
        </tbody>
      </table>
  <?php endif; ?>
</html>
