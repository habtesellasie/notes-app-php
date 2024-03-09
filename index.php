<?php

$connection = require_once "./connection.php";

$connection = new Connection();
$notes = $connection->getNotes();

$currentNote = [
    'id' => '',
    'title' => '',
    'description' => ''
];

if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple notes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            font-family: 'Poppins', sans-serif;

        }

        body {
            background-color: black;
        }

        .container {
            display: flex;
            max-width: 550px;
            margin-inline: auto;
            justify-content: center;
            padding: 1rem 0;
            flex-direction: column;
            margin-top: 5rem;
        }

        .new-note {
            display: flex;
            flex-direction: column;
            gap: 20px;
            font-size: 22px;
        }

        textarea {
            font-size: 20px;
            resize: vertical;
            padding: 10px 10px !important;
            background-color: rgb(94, 201, 237);
            border: none;
            border-radius: 2px;
        }

        .note-title {
            height: 40px;
            padding: 5px 15px !important;
            border: none;
            border-radius: 2px;
            width: 50%;
        }

        .new-note input {
            padding: 5px;
            font-size: 18px;
            background-color: rgb(94, 201, 237);
        }

        .notes {
            margin-top: 1rem;
            color: black;
            display: flex;
            flex-direction: column;
            gap: 20px;
            overflow: scroll;
        }

        .note {
            position: relative;
            background-color: rgb(248, 216, 91);
            border: solid .3px black;
            /* margin-top: 1rem; */
            padding: 30.5px 1rem;
            border-radius: 9px;
        }

        .description {
            padding: 1rem 0;
            font-size: 18px;
        }

        small {
            text-align: right;
            position: absolute;
            right: .6rem;
            bottom: .6rem;
        }

        .delete {
            position: absolute;
            top: 10px;
            background-color: rgb(168, 11, 68);
            right: 10px;
            cursor: pointer;
            width: 30px;
            height: 30px;
            font-size: 17px;
            font-weight: bold;
            border: none;
            color: white;
            padding: 0px 0px 2px 0px;
            border-radius: 50%;
        }

        .edit-button {
            position: absolute;
            top: 12px;
            right: 51px;
            color: darkcyan;
            text-underline-offset: .3rem;
            text-decoration-thickness: 2px;
            font-weight: bold;
        }

        .title a {
            font-size: 22px;
        }

        button {
            padding: 12px 0;
            font-size: 17px;
            color: gray;
            background-color: rgb(94, 201, 237);
            border: none;
            border-radius: 2px;
            width: 56.5%;
            margin-left: auto;
        }

        h2 {
            color: white;
            text-align: center;
        }

        .note__title {
            text-decoration: none;
            color: rgb(168, 11, 68);
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text">
            <h2>Note App</h2>
        </div>
        <form class="new-note" action="create.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $currentNote['id'] ?>">
            <input type="text" class="note-title" name='title' placeholder="Note title" autocomplete="TRUE" value="<?php echo $currentNote['title'] ?>">
            <textarea name="description" id="" cols="30" rows="4" placeholder="Note Description"><?php echo $currentNote['description'] ?></textarea>

            <button type="submit">
                <?php if ($currentNote['id']) : ?>
                    Update Note
                <?php else : ?>
                    Add note
                <?php endif; ?>
            </button>
        </form>

        <div class="notes">
            <?php foreach ($notes as $note) : ?>
                <div class="note">
                    <div class="title">
                        <a class="note__title"><?php echo $note['title'] ?></a>
                    </div>
                    <div class="description">
                        <?php echo $note['description'] ?>
                    </div>
                    <small><?php echo $note['create_date'] ?></small>
                    <form action="delete.php" method="POST" class="">
                        <a href="?id=<?php echo $note['id'] ?>" class="edit-button">Edit note</a>
                        <input type="hidden" name="id" value="<?php echo $note['id'] ?>">
                        <input type="submit" value="x" class="delete">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>