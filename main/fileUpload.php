<?php

error_reporting(0);
require_once "../classes/AppStart.php";

AppStart::startApp();

$path = "http://localhost";

if (!empty($_FILES['file'])) {
    $fileInfo = $_FILES['file'];
    $file = $fileInfo['name'];
}
else {
    $fileInfo['error'] = '';
    $file = strtr(array_key_first($_POST), '_', '.');
}

if ($fileInfo['error']) {
    //error
} 
else {
    $song = json_decode(file_get_contents("$path/Project/files/$file"), true);
    
    $chords = explode(" ", $song['chords']);
    $durations = explode(" ", $song['duration']);
    $tuning = explode(" ", $song['tuning']);

    $chords = array_map('ucfirst', $chords);
    
    $connection = (new Database())->getConnection();
    $selectChord = $connection->prepare("SELECT `notation` FROM `chords` WHERE name = ?"); 
    $notation = "";
    $tablature = [[]];
    $index = $countDashes = 0;

    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 4; $j++) {
            $tablature[$i][$j++] = $tuning[$i];
            $tablature[$i][$j++] = ' ';
            $tablature[$i][$j++] = '|';
            $tablature[$i][$j++] = '-';
        }
    }

    $index += 4;

    for ($i = 0; $i < count($chords); $i++) {
        $selectChord->execute([$chords[$i]]);
        $notation = $selectChord->fetch()['notation'];

        for ($row = 0; $row < 6; $row++) {
            $tablature[$row][$index] = $notation[$row];
        }

        $index++;
        $dash = intval($durations[$i]);
        $countDashes += $dash;

        for ($col = $index; $col < $index + $dash; $col++) {
            for ($row = 0; $row < 6; $row++) {
                $tablature[$row][$col] = '-';
            }
        }

        $index += $dash;
    }

    $n = 75;
    $allColumns = count($chords) + $countDashes;
    $tablatureRows = ceil($allColumns / $n);

    function printTablature($first, $last, $tablature) {
        for ($i = 0; $i < 6; $i++) {
            for ($j = $first; $j < $last; $j++) {
                echo $tablature[$i][$j] . " ";
            }
            echo "<br>";
        }
        echo "<br>";
    }

    for($iter = 0; $iter < $tablatureRows; $iter++) {
        $iter + 1  < $tablatureRows ? printTablature($iter * $n, ($iter + 1) * $n, $tablature) :
        printTablature($iter * $n, $allColumns, $tablature);
    }

    $loggedUserId = $_SESSION['user_id'];

    $filenames = $connection->prepare("SELECT filename FROM `files` WHERE filename = '$file'");
    $filenames->execute();
    $result = $filenames->fetch();

    if (is_null($result['filename'])) {
        $statement = $connection->prepare("INSERT INTO `files` (owner_id) VALUES (?)");
        $statement->execute([$loggedUserId]);

        $fileId = $connection->lastInsertId();

        //move_uploaded_file($fileInfo['tmp_name'], './files/' . $filename);

        $update = $connection->prepare('UPDATE `files` SET filename = :filename WHERE id = :id');
        $update->execute([
        'filename' => $file,
        'id' => $fileId
        ]);
    }

    $success = true;
}

?>
