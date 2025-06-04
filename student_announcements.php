<?php
require_once('db3.php'); // Ensure db3.php sets up $conn correctly

$query = "SELECT * FROM uploads";
$result = mysqli_query($conn, $query);
$uploads = [];

while ($row = mysqli_fetch_assoc($result)) {
    $uploads[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Academic Content</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 1000px;
      margin: auto;
    }
    .title {
      font-size: 2rem;
      font-weight: 600;
      margin-bottom: 24px;
    }
    .card {
      background: white;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      padding: 20px;
      margin-bottom: 16px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      transition: box-shadow 0.3s ease;
    }
    .card:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }
    .card-icon {
      margin-right: 16px;
      font-size: 20px;
    }
    .card-info {
      flex-grow: 1;
    }
    .card-title {
      font-weight: 600;
      font-size: 1.1rem;
      margin-bottom: 4px;
    }
    .card-meta {
      color: #6b7280;
      font-size: 0.9rem;
    }
    .badge {
      display: inline-block;
      padding: 4px 8px;
      background-color: #f3f4f6;
      border-radius: 6px;
      font-size: 0.8rem;
      margin-top: 6px;
    }
    .card-action a {
      background-color: #3b82f6;
      color: white;
      text-decoration: none;
      padding: 8px 14px;
      border-radius: 6px;
      font-size: 0.9rem;
    }
    .card-action a:hover {
      background-color: #2563eb;
    }
    .card-content {
      display: flex;
      align-items: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="title">Academic Content</h1>
    <div id="content-list">
      <?php foreach ($uploads as $item): ?>
        <div class="card">
          <div class="card-content">
            <div class="card-icon">
              <?php
                $icons = ['video' => '🎥', 'pdf' => '📄', 'quiz' => '❓'];
                echo isset($icons[$item['content_type']]) ? $icons[$item['content_type']] : '📁';
              ?>
            </div>
            <div class="card-info">
              <div class="card-title"><?= htmlspecialchars($item['title']) ?></div>
              <div class="card-meta"><?= htmlspecialchars($item['description']) ?></div>
              <?php if (!empty($item['schedule_date'])): ?>
                <div class="badge">Scheduled: <?= date("F j, Y", strtotime($item['schedule_date'])) ?></div>
              <?php endif; ?>
            </div>
          </div>
          <div class="card-action">
            <a href="<?= htmlspecialchars($item['file_path']) ?>" target="_blank">
              <?= $item['content_type'] === 'quiz' ? 'Start Quiz' : 'View' ?>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
