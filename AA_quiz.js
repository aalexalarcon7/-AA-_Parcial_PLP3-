let data = [], idx = 0, score = 0, max = 0, totalTime = 0;
let timePerQ = 20, timer = timePerQ, tick;

const qEl = document.getElementById('question');
const optEl = document.getElementById('options');
const timerEl = document.getElementById('timer');
const progEl = document.getElementById('progress');
const nextBtn = document.getElementById('nextBtn');

fetch(API).then(r=>r.json()).then(json=>{
  data = json.items; max = data.length;
  render();
});

function render(){
  if(idx >= data.length){ finish(); return; }
  const q = data[idx];
  qEl.textContent = q.question;
  progEl.textContent = `${idx+1}/${max}`;
  optEl.innerHTML = '';
  nextBtn.disabled = true;

  for(const key of ['A','B','C','D']){
    const b = document.createElement('button');
    b.className = 'opt';
    b.textContent = `${key}) ${q.options[key]}`;
    b.onclick = ()=> choose(key);
    optEl.appendChild(b);
  }
  resetTimer();
}

function choose(key){
  const q = data[idx];
  stopTimer();
  const btns = [...document.querySelectorAll('.opt')];
  btns.forEach(b=> b.disabled = true);
  btns.forEach(b=>{
    if(b.textContent.startsWith(q.answer)) b.classList.add('ok');
    if(b.textContent.startsWith(key) && key !== q.answer) b.classList.add('bad');
  });
  if(key === q.answer) score++;
  nextBtn.disabled = false;
}

nextBtn.onclick = ()=>{ idx++; render(); };

function resetTimer(){
  timer = timePerQ; timerEl.textContent = timer;
  stopTimer();
  tick = setInterval(()=>{
    timer--; totalTime++;
    timerEl.textContent = timer;
    if(timer <= 0){ stopTimer(); choose(''); } // tiempo agotado: marca correcto y sigue
  },1000);
}
function stopTimer(){ if(tick) clearInterval(tick); }

function finish(){
  document.getElementById('scoreField').value = score;
  document.getElementById('maxField').value = max;
  document.getElementById('timeField').value = totalTime;
  document.getElementById('endForm').submit();
}
