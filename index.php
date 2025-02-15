<?php
require_once('templates/header.php'); // syntax error!!, wrong relative path was there before, now fixed.

$questions = array();
$file_path = 'data/leetcode_tracker.csv'; // syntax error!!, wrong relative path was there before, now fixed.

if (file_exists($file_path)) {
  $handle = fopen($file_path, 'r');

  while (($data = fgetcsv($handle)) !== false) {
    list($id, $title, $difficulty, $link, $date) = $data;
    $questions[] = [ // since this is an associative array, it should be in key-value pairs, replaced ':' to '=>', is this a syntax error or runtime error?? well I'm not sure, but yeah can be
      'id' => $id, // syntax error, missed a comma, array!!
      'title' => $title,
      'difficulty' => $difficulty,
      'link' => $link,
      'date' => $date
    ];
  }
  fclose($handle);
}
?>

<div class="table-responsive">
  <div class="card mb-4">
    <div class="card-body">
      <h2 class="card-title">Add New Question</h2>
      <form action="process-form.php" method="POST"> <!--remove '../' which is going to the root directory, index and process-form are in the same file, logic error-->
        <input type="hidden" name="action" value="add">
        <div class="mb-3">
          <label for="title" class="form-label">Problem Title:</label>
          <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="difficulty" class="form-label">Difficulty:</label>
          <select id="difficulty" name="difficulty" class="form-select" required>
            <option value="Easy">Easy</option>
            <option value="Medium">Medium</option>
            <option value="Hard">Hard</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="link" class="form-label">Problem Link:</label>
          <input type="url" id="link" name="link" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="date" class="form-label">Completion Date:</label>
          <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </div>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Difficulty</th>
        <th>Link</th>
        <th>Date Solved</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($questions as $question): ?> <!--runtime error-->
        <tr>
          <td><?= htmlspecialchars($question['id']) ?></td>
          <td><?= htmlspecialchars($question['title']) ?></td>
          <td>
            <span class="badge 
              <?= $question['difficulty'] === 'Easy' ? 'bg-success' : ($question['difficulty'] === 'Medium' ? 'bg-warning' : 'bg-danger') ?>">
              <?= htmlspecialchars($question['difficulty']) ?>
            </span>
          </td>
          <td><a href="<?= htmlspecialchars($question['link']) ?>" target="_blank" class="btn btn-link">View Problem</a></td>
          <td><?= htmlspecialchars($question['date']) ?></td>
          <td>
            <form action="process-form.php" method="POST" class="d-inline"> <!-- logic error, wrong method, should be POST instead of PUT-->
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $question['id'] ?>">
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
</div>

 <?php require_once('templates/footer.php'); ?> <!-- error found, syntax error, what is require_one?? should be require_once!!, awwwww!!! -->