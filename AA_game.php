<?php require __DIR__.'/AA_Conexion.php';
$player = e($_GET['player'] ?? '');
$cat_id = (int)($_GET['category_id'] ?? 0);
$dif = e($_GET['difficulty'] ?? 'easy');

if($player==='' || $cat_id===0){ header('Location: AA_index.php'); exit; }
$cat = $cn->query("SELECT name FROM categories WHERE id=$cat_id")->fetch_assoc()['name'] ?? '';
?>
<!doctype html><html lang="es"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Juego - QuizMaster</title>
<link rel="stylesheet" href="../CSS/AA_quiz.css"></head><body>
<header class="wrap"><h1>🎮 <?=e($cat)?> · <?=e($dif)?></h1>
<div class="info"><span id="timer">20</span>s · <span id="progress">1/15</span> · Jugador: <?=e($player)?></div></header>

<main class="wrap card">
  <div id="question">Cargando…</div>
  <div id="options" class="grid4"></div>
  <div class="actions">
    <button id="nextBtn" disabled>Siguiente ▶</button>
  </div>
</main>

<form id="endForm" action="AA_results.php" method="post" style="display:none">
  <input name="player" value="<?=e($player)?>">
  <input name="category_id" value="<?=$cat_id?>">
  <input name="difficulty" value="<?=e($dif)?>">
  <input id="scoreField" name="score">
  <input id="maxField" name="max_score">
  <input id="timeField" name="time_seconds">
</form>

<script>
const API = `AA_api_questions.php?category_id=<?=$cat_id?>&difficulty=<?=$dif?>`;
</script>
<script src="../JS/AA_quiz.js"></script>
</body></html>
