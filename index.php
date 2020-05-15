<?php 
	$errors = "";

	$db = mysqli_connect("localhost", "root", "", "todo");

	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "Anda harus memasukkan tugas";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
    }	
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
    
        mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mau ngapain aja hari ini?</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="heading">
        <h2>Mau ngapain aja hari ini?</h2>
    </div>

    <form method="POST" action="index.php">
    <?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
    <?php } ?>

        <input type="text" name="task" class="task_input">
        <button tpe="submit" class="add_btn" name="submit">Tambah Kegiatan</button>
    </form>

    <table>
	<thead>
		<tr>
			<th>No</th>
			<th>Kegiatan</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
</body>
</html>