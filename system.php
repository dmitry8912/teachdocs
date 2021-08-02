<?php
    require_once "db.php";
    global $db;
    // Аутентификация пользователя
    if(!empty($_GET['action']) && $_GET['action'] == 'login')
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        foreach ($db as $user)
        {
            if($user['email'] == strtolower($email) && $user['password'] == $password)
            {
                session_id($user['id']);
                session_start();
                $_SESSION['isAuthenticated'] = true;
                $_SESSION['user_data'] = $user;
                header('location: system.php');
            }
        }
    }

    // Поднимаем сеесию.
    session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>TeachDocs</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
</head>

<body class="text-center">

<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">TeachDocs</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link" href="/">Главная</a>
                <?php if(empty($_SESSION['isAuthenticated'])): ?>
                    <a class="nav-link active" href="/system.php">Войти в систему</a>
                <?php else: ?>
                    <a class="nav-link active" href="#"><?php echo $_SESSION['user_data']['email']; ?></a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <?php if(!empty($_SESSION['isAuthenticated'])): ?>
    <main role="main" class="inner cover">
        <ul class="list-group">
            <?php
                foreach($_SESSION['user_data']['docs'] as $doc):
            ?>
            <li class="list-group-item">
                <?php
                    echo $doc;
                ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </main>
    <?php endif; ?>

    <?php if(empty($_SESSION['isAuthenticated'])): ?>
    <form action="/system.php?action=login" method="POST">
        <div class="form-group mb-1">
            <input type="email" class="form-control form-control-lg" name="email" aria-describedby="emailHelp" placeholder="Введите ваш логин">
        </div>
        <div class="form-group mb-1">
            <input type="password" class="form-control form-control-lg" name="password" placeholder="Пароль">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
    <?php endif; ?>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>TeachDocs created by <a href="https://t.me/dmitry8912">@dmitry8912</a>, <a href="https://github.com/dmitry8912/teachdocs">github repo</a>.</p>
        </div>
    </footer>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
