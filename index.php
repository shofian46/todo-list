<?php include 'db.php'; ?>

<?php
if (isset($_POST['add_post'])) {
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $query = mysqli_query($connection, "INSERT INTO tasks (name, status, date)
                        VALUES('$name','pending',now())");

  header("Location: index.php");
}

if (isset($_GET['edit'])) {
  $task_id = $_GET['edit'];
  $query = mysqli_query($connection, "UPDATE `tasks` SET status='done' WHERE tasks_id='$task_id'");
  header("Location: index.php");
}

if (isset($_GET['delete'])) {
  $task_id = $_GET['delete'];
  $query = mysqli_query($connection, "DELETE FROM `tasks` WHERE tasks_id='$task_id'");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo-List App</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- Icon Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body class="bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Apps | Todo List</h1>
      </div>
    </div>
    <div class="row my-2 mx-auto">
      <div class="col-md-6">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded border-0">
          <div class="card-body">
            <h3>Form Add Tasks</h3>
            <form action="" method="post">
              <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Input your tasks" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" name="add_post" class="btn btn-sm btn-primary btn-block">Add Tasks</button>
              </div>
            </form>
            <h3>List tasks</h3>
            <ul class="list-group">
              <?php
              $query = mysqli_query($connection, "SELECT * FROM tasks WHERE status='pending'");
              while ($row = mysqli_fetch_array($query)) {
                $name = $row['name'];
                $tasks_id = $row['tasks_id'];
              ?>
                <li class="list-group-item my-1">
                  <?php echo $name; ?>
                  <div class="float-right">
                    <a href="index.php?edit=<?php echo $tasks_id ?>" class="btn btn-transparent btn-sm btn-outline" data-toggle="tooltip" data-placement="top" title="Mark your task when it's done">
                      <i class="bi bi-check-circle text-success"></i>
                    </a>
                    <a href="index.php?delete=<?php echo $tasks_id ?>" class="btn btn-transparent btn-sm btn-outline" data-toggle="tooltip" data-placement="top" title="Delete your assignment if you write it wrong">
                      <i class="bi bi-trash2 text-danger"></i>
                    </a>
                  </div>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded border-0">
          <div class="card-body">
            <h3>List Tasks Finish</h3>
            <ul class="list-group">
              <?php
              $query = mysqli_query($connection, "SELECT * FROM tasks WHERE status='done' ");
              while ($row = mysqli_fetch_array($query)) {
              ?>
                <li class="list-group-item">
                  <?php echo $row['name'] ?>
                  <div class="float-right"><span class="badge badge-primary badge-sm"><?php echo $row['status'] ?></span></div>
                </li>
              <?php
              } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script>
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
</body>

</html>