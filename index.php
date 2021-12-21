<?php
$connection = require_once("./Connection.php");
$notes = $connection->getNotes();

// echo "<pre>" . print_r($notes) . "</pre>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP 筆記本(CRUD)</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
<div>
    <form class="new-note" action="save.php" method="post">
        <input type="hidden" name="id" value="">
        <input type="text" name="title" placeholder="Note title" autocomplete="off" value="">
        <textarea name="description" cols="30" rows="4"
                  placeholder="Note Description"></textarea>
        <button>
          新增筆記
        </button>
    </form>
    <div class="notes">
        <?php foreach($notes as $note): ?>
        <div class="note">
            <div class="title">
                <a href="#"><?php echo $note['title'];?></a>
            </div>
            <div class="description">
              <?php echo $note['description'];?>
            </div>
            <small><?php echo $note['created_date'];?></small>
            <form action="delete.php" method="post">
              <input type="hidden" name="id" value="">
            <button class="close">X</button>
            </form>
        </div>
      <?php endforeach; ?>
    </div>
</div>
</body>
</html>