<!doctype html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>مطابقة الأرقام — Math&Play</title>
<style>
body{font-family: Arial, "Noto Kufi Arabic", sans-serif; background:#fffbf0; padding:20px; text-align:center}
h1{margin-bottom:8px}
.game{display:flex;gap:18px;flex-wrap:wrap;justify-content:center}
.numbers{display:flex;flex-wrap:wrap;gap:10px;max-width:420px;justify-content:center;margin-bottom:12px}
.num-card{width:64px;height:64px;background:#fff;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:26px;box-shadow:0 4px 8px rgba(0,0,0,.08);cursor:grab;border:3px solid transparent}
.num-card:active{cursor:grabbing}
.dropzone{width:140px;height:120px;background:linear-gradient(180deg,#ffffff,#f2f7ff);border-radius:12px;box-shadow:0 6px 12px rgba(0,0,0,.06);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:8px}
.dropzone .count{font-size:18px;margin-top:6px;color:#444}
.dropzone.correct{border:3px solid #2ecc71}
.dropzone.wrong{border:3px solid #ff6b6b}
.objects{display:flex;flex-wrap:wrap;gap:6px;justify-content:center}
.obj{width:28px;height:28px;border-radius:6px;background:#ffd166;display:inline-flex;align-items:center;justify-content:center;font-size:14px}
#message{margin-top:14px;font-weight:600}
.controls{margin-top:10px}
button{padding:8px 12px;border-radius:8px;border:0;box-shadow:0 2px 4px rgba(0,0,0,.08);cursor:pointer;background:#4f46e5;color:white}
</style>
</head>
<body>
<h1>اللعبة: وصل الرقم للمجموعة الصحيحة</h1>
<p>اسحب الرقم وأسقطه على المجموعة التي تحتوي نفس عدد العناصر.</p>

<div class="numbers" id="numbers"></div>
<div class="game" id="zones"></div>
<div id="message"></div>
<div class="controls">
  <button id="resetBtn">إعادة ترتيب</button>
</div>

<script>
// إعداد اللعبة ديناميكيًا من Laravel
const minRange = {{ $lesson_game->game_settings->min_range ?? 1 }};
const maxRange = {{ $lesson_game->game_settings->max_range ?? 9 }};
const numbersEl = document.getElementById('numbers');
const zonesEl = document.getElementById('zones');
const message = document.getElementById('message');

// توليد مصفوفة الأرقام
let nums = [];
for(let i=minRange;i<=maxRange;i++) nums.push(i);

// خلط المصفوفة
function shuffle(a){ return a.sort(()=>Math.random()-0.5); }

// إنشاء اللعبة
function create() {
    numbersEl.innerHTML=''; zonesEl.innerHTML=''; message.textContent='';

    const shuffledNums = shuffle([...nums]);
    shuffledNums.forEach(n=>{
        const c = document.createElement('div');
        c.className='num-card';
        c.draggable=true;
        c.id='num-'+n;
        c.textContent=n;
        c.addEventListener('dragstart', e=>{
            e.dataTransfer.setData('text/plain', n);
        });
        numbersEl.appendChild(c);
    });

    const shuffledZones = shuffle([...nums]);
    shuffledZones.forEach(n=>{
        const z = document.createElement('div');
        z.className='dropzone';
        z.dataset.answer = n;

        const objs = document.createElement('div'); objs.className='objects';
        for(let i=0;i<n;i++){
            const o = document.createElement('div'); o.className='obj'; o.textContent='🍎';
            objs.appendChild(o);
        }
        const label = document.createElement('div'); label.className='count'; label.textContent='كم؟';
        z.appendChild(objs); z.appendChild(label);

        z.addEventListener('dragover', e=> e.preventDefault());
        z.addEventListener('drop', e=>{
            e.preventDefault();
            const dragged = e.dataTransfer.getData('text/plain');
            if(!dragged) return;
            if(Number(dragged) === Number(z.dataset.answer)){
                z.classList.remove('wrong'); z.classList.add('correct');
                const card = document.getElementById('num-'+dragged);
                if(card) card.draggable=false, card.style.opacity=.4, card.style.cursor='default';
                checkWin();
            } else {
                z.classList.remove('correct'); z.classList.add('wrong');
                setTimeout(()=> z.classList.remove('wrong'),700);
            }
        });

        zonesEl.appendChild(z);
    });
}

function checkWin(){
    const total = document.querySelectorAll('.dropzone').length;
    const correct = document.querySelectorAll('.dropzone.correct').length;
    if(total === correct){
        message.textContent = 'أحسنت! كل الأرقام في أماكنها 🎉';
    } else {
        message.textContent = `مبارك — ${correct} من ${total} صحيحة`;
    }
}

document.getElementById('resetBtn').addEventListener('click', create);

// بدء اللعبة
create();
</script>
</body>
</html>
