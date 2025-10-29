<?php require __DIR__.'/AA_Conexion.php';
$player = trim($_POST['player']??'');
$cat_id = (int)($_POST['category_id']??0);
$dif = $_POST['difficulty']??'easy';
$score = (int)($_POST['score']??0);
$max = (int)($_POST['max_score']??15);
$time = (int)($_POST['time_seconds']??0);

if($player && $cat_id){
  $stmt=$cn->prepare("INSERT INTO scores(player,category_id,difficulty,score,max_score,time_seconds) VALUES(?,?,?,?,?,?)");
  $stmt->bind_param('sisiii',$player,$cat_id,$dif,$score,$max,$time);
  $stmt->execute();
}
$cat = $cn->query("SELECT name FROM categories WHERE id=$cat_id")->fetch_assoc()['name'] ?? '';
$top = $cn->query("SELECT player,score,max_score,time_seconds FROM scores WHERE category_id=$cat_id AND difficulty='$dif'
                   ORDER BY score DESC, time_seconds ASC LIMIT 10");
?>
<!doctype html><html lang="es"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Resultados</title>
<link rel="stylesheet" href="../CSS/AA_quiz.css"></head><body>
<header class="wrap"><h1>Resultado – <?=e($cat)?> / <?=e($dif)?></h1></header>
<section class="wrap card center">
  <h2>Puntaje: <?=$score?>/<?=$max?></h2>
  <p>Tiempo total: <?=$time?>s</p>
  <a class="btn" href="AA_index.php">Volver al inicio</a>
</section>

<section class="wrap card">
  <h2>🏆 Ranking de la categoria</h2>
  <table class="rank">
    <thead><tr><th>Jugador</th><th>Puntaje</th><th>Tiempo</th></tr></thead>
    <tbody>
      <?php while($r=$top->fetch_assoc()): ?>
        <tr><td><?=e($r['player'])?></td><td><?=$r['score']?>/<?=$r['max_score']?></td><td><?=$r['time_seconds']?>s</td></tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</section>
</body></html>
