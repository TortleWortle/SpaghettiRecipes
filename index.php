<?php
session_start();
if (!isset($_SESSION['🍝📜'])) $_SESSION['🍝📜'] = [];


$🖊️ = "Content";

// Current objective. (nothing)
$📜 = "";

$✅📜 = false; // shouldRunGoto
$✅💻 = false; // shouldRender


➡📜 :
    if ($✅📜) {
    eval("goto $📜;");
    $✅📜 = false;
}

💻 :
    if ($✅💻) :
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SpaghettiReceeps</title>
</head>
<body>
    <?php echo $🖊️; ?>
</body>
</html>

<?php
goto 🔚;
endif;

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        switch ($_SERVER['PHP_SELF']) {
            case '/api/recipes':
                header('Content-Type: application/json');
                echo json_encode($_SESSION['🍝📜']);
                goto 🔚;

            case '/new':
                ob_start();
                ?>
                <h2>New Recipe</h2>
                <a href="/">Back to main</a>
                <form action="" method="POST">
                    <label for="title">Name</label>
                    <input required type="text" name="title" id="title"/>
                    <label for="Spaghet">Spaghetti</label>
                    <textarea required id="Spaghet" name="spaghetti" id="" cols="30" rows="10" placeholder="Your spaghetti"></textarea>
                    <input type="submit" value="Submit">
                </form>

    <?php
    $🖊️ = ob_get_clean();
    $✅💻 = true;
    goto 💻;

case '/edit':

    if (!isset($_GET['id'])) {
        header("Location: /");
        goto 🔚;
    }
    if ($_GET['id'] + 1 > count($_SESSION['🍝📜'])) {
        header("Location: /");
        goto 🔚;
    }
    ob_start();
    ?>
                <h2>Editing: <?php echo $_SESSION['🍝📜'][$_GET['id']]['title'] ?></h2>
                <a href="/">Back to main</a>
                <form action="/update?id=<?php echo $_GET['id']; ?>" method="POST">
                    <label for="title">Name</label>
                    <input required type="text" name="title" id="title" value="<?php echo $_SESSION['🍝📜'][$_GET['id']]['title'] ?>"/>
                    <label for="Spaghet">Spaghetti</label>
                    <textarea required id="Spaghet" name="spaghetti" id="" cols="30" rows="10" placeholder="Your spaghetti"><?php echo $_SESSION['🍝📜'][$_GET['id']]['spaghetti'] ?></textarea>
                    <input type="submit" value="Submit">
                </form>

    <?php
    $🖊️ = ob_get_clean();
    $✅💻 = true;
    goto 💻;
    break;

case "/":
    ob_start();
    ?>
                <h2>Your Recipes</h2>
                <a href="/new">Add new</a>
    <ul>
        <?php
        $🔞 = 0;
        foreach ($_SESSION['🍝📜'] as $🍝) :
        ?>
        <li>
            <span><a href="/edit?id=<?php echo $🔞 ?>"><?php echo $🍝['title']; ?></a></span>
            <pre>
                <?php echo $🍝['spaghetti']; ?>
            </pre>
        </li>
            <?php
            $🔞++;
            endforeach;
            ?>
    </ul>
    <?php
    $🖊️ = ob_get_clean();
    $✅💻 = true;
    goto 💻;
default:
    header("Location: /");
    goto 🔚;
}
break;

case "POST";
switch ($_SERVER['PHP_SELF']) {
    case '/new':
        $🍝📜 = [];
        $🍝📜['title'] = $_REQUEST['title'];
        $🍝📜['spaghetti'] = $_REQUEST['spaghetti'];

        $🍝📜📜 = $_SESSION['🍝📜'];
        array_push($🍝📜📜, $🍝📜);

        $_SESSION['🍝📜'] = $🍝📜📜;
        header("Location: /");
        goto 🔚;
    case '/update':
        if (empty($_GET['id'])) {
            header("Location: /");
            goto 🔚;
        }
        if ($_GET['id'] + 1 > count($_SESSION['🍝📜'])) {
            header("Location: /");
            goto 🔚;
        }
        $🍝📜 = [];
        $🍝📜['title'] = $_REQUEST['title'];
        $🍝📜['spaghetti'] = $_REQUEST['spaghetti'];

        $_SESSION['🍝📜'][$_GET['id']] = $🍝📜;
        header("Location: /");
        goto 🔚;
        break;
    default:
        echo $_SERVER['PHP_SELF'];
}

break;
}

// For if I maybe want a database which is gonna be stored inside of the index.php file.
// For now I'm gonna cheat with sessions
// DATABASE_START

// DATABASE_STOP

// No New Line

🔚 :
    exit();