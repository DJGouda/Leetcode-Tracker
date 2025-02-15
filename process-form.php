<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // should be REQUEST_METHOD, logic error
  $action = $_POST['action']; // should be $_POST, logic error
  $file_path = 'data/leetcode_tracker.csv'; // '/' not be there in the front, logic error

  if ($action === 'add') {
    $last_id = 0;
    if (file_exists($file_path)) {
      $handle = fopen($file_path, 'r');
      while (($data = fgetcsv($handle)) !== false) {
        if (is_numeric($data[0])) {
          $last_id = max($last_id, (int)$data[0]); // added max() to reject min values
        }
      }
    fclose($handle);
    }

    $id = $last_id + 1;
    $title = $_POST['title'];
    $difficulty = $_POST['difficulty'];
    $link = $_POST['link'];
    $date = $_POST['date']; // there was ;; two semi-colons

    $handle = fopen($file_path, 'a'); // append it instead write mode, logic error
    if ($handle) {
      fputcsv($handle,fields:[$id, $title, $difficulty, $link, $date]);
      fclose($handle); // missed a semi-colon
    }
  } elseif ($action === 'delete') { // logic error 'remove' and 'delete' different in value and action
    $id = $_POST['id']; //should be $_POST instead of $POST

    $entries = [];
    $handle = fopen($file_path, 'r');
    if ($handle) {
      while (($data = fgetcsv($handle)) !== false) {
        if ($data[0] != $id) { // should be != instead of !==, datatype are not same, logic error
          $entries[] = $data;
        }
      }
      fclose($handle);
    }

    $handle = fopen($file_path, 'w');
    if ($handle) {
      foreach ($entries as $entry) {
        fputcsv($handle, $entry);
      }
      fclose($handle);
    }
  }
}

header('Location: index.php');
exit;
