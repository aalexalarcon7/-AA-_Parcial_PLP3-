<?php require __DIR__.'/AA_Conexion.php';
$cat = (int)($_GET['category_id'] ?? 0);
$dif = $_GET['difficulty'] ?? 'easy';
$limit = 15;

$stmt = $cn->prepare("SELECT id, question, opt_a, opt_b, opt_c, opt_d, correct
                      FROM questions WHERE category_id=? AND difficulty=?
                      ORDER BY RAND() LIMIT ?");
$stmt->bind_param('isi', $cat, $dif, $limit);
$stmt->execute();
$res = $stmt->get_result();

$qs = [];
while($q = $res->fetch_assoc()){
  $qs[] = [
    'id' => (int)$q['id'],
    'question' => $q['question'],
    'options' => ['A'=>$q['opt_a'],'B'=>$q['opt_b'],'C'=>$q['opt_c'],'D'=>$q['opt_d']],
    'answer'  => $q['correct']  // se valida en cliente para feedback inmediato
  ];
}
header('Content-Type: application/json');
echo json_encode(['items'=>$qs,'max'=>$limit]);
