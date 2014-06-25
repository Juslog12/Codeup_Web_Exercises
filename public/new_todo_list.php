<?php
//1. Establish DB Connection
//2. Check if something was posted
//  a. is item being added?  => Add todo
//  b. is item being removed? => Remove it
//  c. is item being uploaded? => Add todos
//3. Query DB for total todo count.
//4. Determine pagination values.
//5. Query for todos on current pages.

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=todo_list_dbo', 'justin', 'Maslog12');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

/*$query = 'CREATE TABLE new_todo_list 
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    todo_item TEXT NOT NULL, 
    PRIMARY KEY (id)
)';


$dbc->exec($query);
*/


define ('DEFAULT_LIMIT', 10);

if(!empty($_POST))
{
    //$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'justin', 'Maslog12');

    //$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    if (!empty($_POST['todo_item']))
    {
        $stmt = $dbc->prepare('INSERT INTO new_todo_list (todo_item) VALUES (:todo_item)');
        $stmt->bindValue(':todo_item', $_POST['todo_item'], PDO::PARAM_STR);

        $stmt->execute();
    }
    elseif (!empty($_POST['remove'])) 
    {
        $stmt = $dbc->prepare('DELETE FROM new_todo_list WHERE id = :id');
        $stmt->bindValue(':id', $_POST['remove'], PDO::PARAM_INT);

        $stmt->execute();
    }
}


function getItems($dbc) 
{
   //return $dbc->query('SELECT * FROM national_parks LIMIT 4 OFFSET ' . getOffset())->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $dbc->prepare('SELECT * FROM new_todo_list LIMIT :limit OFFSET :offset');
    $stmt->bindValue(':limit', DEFAULT_LIMIT, PDO:: PARAM_INT);
    $stmt->bindValue(':offset', getOffset(), PDO:: PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOffset()
{ 
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    return (($page - 1) * DEFAULT_LIMIT); 
}

$count = $dbc->query('SELECT count(*) FROM new_todo_list')->fetchcolumn();
$numPages = ceil($count/DEFAULT_LIMIT);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1;





?>

<html>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<head>
    <title>New Todo List</title>
</head>
<body>
    <h2 align = "center">Todo List</h2>
    <table class="table table-hover" align= "center" border = black 1px solid>
        <th>Id</th>
        <th>Todo Item</th>
        <? foreach(getItems($dbc) as $rows): ?>
        <tr>
            <td><?= $rows['id'] ?></td>   
            <td><?= $rows['todo_item'] ?><button class="btn btn-danger btn-sm pull-right btn-remove" data-todo="<?= $rows['id']; ?>">Remove</button></td>
        </tr>
        <? endforeach; ?>   
    </table>
    <? if ($page >= 2) : ?>
        <button type="button" class="btn btn-default"><a href="?page=<?=$prevPage; ?>">previous</a></button>
    <? endif ?> 
    <? if($page < $numPages) : ?>
    <button type="button" class="btn btn-default"><a href="?page=<?=$nextPage; ?>">next</a></button>
<? endif ?>

<h3>Add New Item</h3>
<form method="POST" type="text/css" enctype="multipart/form-data" action="new_todo_list.php">
   
    <p>
        <label for="todo_item">Todo Item</label>
        <input id="todo_item" name="todo_item" type="text" autofocus = "autofocus"></input>
    </p>
    <p> 
        <input type="submit" value="Add">       
    </p>
</form> 
 

<h3>Upload File</h3>

<form method="POST" enctype="multipart/form-data">
    <p>
        <label for="file1">File to upload: </label>
        <input type="file" id="file1" name="file1">
    </p>
    <p>
        <input type="submit" value="Upload">
    </p>
</form>

<form id="remove-form" action="new_todo_list.php" method="post">
    <input id="remove-id" type="hidden" name="remove" value="">
</form>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>

$('.btn-remove').click(function () 
{
    var todoId = $(this).data('todo');
    if (confirm('Are you sure you want to remove item ' + todoId + '?')) 
    {
        $('#remove-id').val(todoId);
        $('#remove-form').submit();
    }
});

</script>


</body>
</html>