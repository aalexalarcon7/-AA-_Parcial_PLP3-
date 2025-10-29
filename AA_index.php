<?php require __DIR__.'/AA_Conexion.php';
$cats = $cn->query("SELECT * FROM categories");
$top = $cn->query("SELECT s.player, c.name cat, s.difficulty, s.score, s.max_score, s.time_seconds
                   FROM scores s JOIN categories c ON c.id=s.category_id
                   ORDER BY s.score DESC, s.time_seconds ASC LIMIT 10");
?>
<!doctype html><html lang="es"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>QuizMaster</title>
<link rel="stylesheet" href="../CSS/AA_quiz.css"></head><body>
<header class="wrap"><h1>🎮 QuizMaster</h1></header>

<section class="wrap card">
  <h2>Comenzar</h2>
  <form action="AA_game.php" method="get" class="grid">
    <input name="player" placeholder="Tu nombre" required>
    <select name="category_id" required>
      <option value="" disabled selected>Elige categoria</option>
      <?php while($c=$cats->fetch_assoc()): ?>
        <option value="<?=$c['id']?>"><?=e($c['name'])?></option>
      <?php endwhile; ?>
    </select>
    <select name="difficulty" required>
      <option disabled selected>Dificultad</option>
      <option value="easy">Fácil</option>
      <option value="medium">Media</option>
      <option value="hard">Difícil</option>
    </select>
    <button>¡Jugar!</button>
  </form>
</section>

<section class="wrap card">
  <h2>🏆 Mejores puntajes</h2>
  <table class="rank">
    <thead><tr><th>Jugador</th><th>Categoria</th><th>Dif.</th><th>Puntaje</th><th>Tiempo</th></tr></thead>
    <tbody>
    <?php while($r=$top->fetch_assoc()): ?>
      <tr><td><?=e($r['player'])?></td><td><?=e($r['cat'])?></td>
      <td><?=e($r['difficulty'])?></td><td><?=$r['score']?>/<?=$r['max_score']?></td>
      <td><?=$r['time_seconds']?>s</td></tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>
</body></html>
