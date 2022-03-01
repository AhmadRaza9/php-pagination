<?php require_once "init.php";?>

<?php

$allphotos = "SELECT * FROM photos";
$t_photos = mysqli_query($connection, $allphotos);

$total_photos = mysqli_num_rows($t_photos);
$result_per_page = 3;

$total_pages = ceil($total_photos / $result_per_page);

if (!isset($_GET['page'])) {
    $page = 1;
    $_GET['page'] = 1;
} else {
    $page = $_GET['page'];
}

$this_page_result = ($page - 1) * $result_per_page;

$query = "SELECT * FROM photos LIMIT " . $this_page_result . "," . $result_per_page;
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed" . mysqli_error($connection));
}

function nexts()
{
    return $_GET['page'] + 1;
}

function previous()
{
    return $_GET['page'] - 1;

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main">
<?php while ($photo = mysqli_fetch_array($result)): ?>
<?php

$title = $photo['title'];
$image = $photo['image'];

?>

<div class="inner-main">
    <div class="title">
        <h4><?php echo $title; ?></h4>
    </div>
    <div class="img">
        <img src="images/<?php echo $image; ?>" alt="">
    </div>
</div>
<?php endwhile;?>

</div>
<div class="pagination">

    <?php if (previous()): ?>
    <a class="pagination_count" href="?page=<?php echo previous(); ?>">Previous</a>
    <?php endif;?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($_GET['page'] == $i) {?>
            <a href="?page=<?php echo $i; ?>" class="pagination_count bg-active"><?php echo $i; ?></a>
        <?php } else {?>
            <a href="?page=<?php echo $i; ?>" class="pagination_count"><?php echo $i; ?></a>
        <?php }?>
    <?php endfor;?>

    <?php if ($total_pages >= nexts()): ?>
        <?php if (nexts()): ?>
        <a class="pagination_count" href="?page=<?php echo nexts(); ?>">Next</a>
        <?php endif;?>
    <?php endif;?>
</div>
</body>
</html>
