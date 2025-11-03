<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>🎨 تلوين الأرقام</title>
<style>
body{
    font-family:"Noto Kufi Arabic",sans-serif;
    background:#fffbe6;
    text-align:center;
    padding:20px
}
h1{color:#ff6f61;margin-bottom:10px}
.grid{
    display:grid;
    grid-template-columns:repeat(6,60px);
    gap:5px;
    justify-content:center;
    margin-bottom:12px
}
.cell{
    width:60px;
    height:60px;
    background:#fff;
    border-radius:6px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    cursor:pointer;
    box-shadow:0 3px 6px rgba(0,0,0,0.1);
    transition:0.2s
}
.palette{
    display:flex;
    justify-content:center;
    gap:8px;
    margin-bottom:10px;
    flex-wrap:wrap
}
.color{
    width:40px;
    height:40px;
    border-radius:8px;
    cursor:pointer;
    border:3px solid transparent;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
    color:white
}
.selected{border:3px solid #000}
#msg{margin-top:10px;font-weight:700;color:#198754}
button{
    margin-top:12px;
    padding:8px 14px;
    border-radius:8px;
    background:#ff6f61;
    color:white;
    border:0;
    cursor:pointer
}
</style>
</head>
<body>
<h1>🎨 تلوين الأرقام</h1>
<p>اختر الرقم من لوحة الأرقام، ثم اضغط على المربعات المطابقة لتلوينها!</p>

<div class="palette" id="palette"></div>
<div class="grid" id="grid"></div>
<div id="msg"></div>
<button id="resetBtn">إعادة اللعبة</button>

<script>
// --- جلب عناصر DOM ---
const palette = document.getElementById('palette');
const grid = document.getElementById('grid');
const msg = document.getElementById('msg');
const resetBtn = document.getElementById('resetBtn');

// --- إعدادات اللعبة من Controller ---
const minRange = {{ $min_range }};
const maxRange = {{ $max_range }};
const totalCells = 6 * 6; // 36 مربع
let gridNumbers = [];
let selectedNumber = minRange;

// --- دالة توليد لون ديناميكي لكل رقم ---
function getColor(n){
    const hue = (n * 35) % 360; // اللون حسب الرقم
    return `hsl(${hue}, 80%, 50%)`;
}

// --- إنشاء لوحة الأرقام ---
for(let n = minRange; n <= maxRange; n++){
    const btn = document.createElement('div');
    btn.className = 'color';
    btn.style.background = getColor(n);
    btn.textContent = n;
    btn.addEventListener('click', () => {
        document.querySelectorAll('.color').forEach(d => d.classList.remove('selected'));
        btn.classList.add('selected');
        selectedNumber = n;
    });
    palette.appendChild(btn);
}
document.querySelector('.color')?.classList.add('selected');

// --- إنشاء الشبكة ---
function initGrid(){
    grid.innerHTML = '';
    msg.textContent = '';
    gridNumbers = [];

    for(let i = 0; i < totalCells; i++){
        const n = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        gridNumbers.push(n);
    }

    gridNumbers.forEach(num => {
        const cell = document.createElement('div');
        cell.className = 'cell';
        cell.dataset.number = num;
        cell.textContent = num;
        cell.addEventListener('click', () => {
            if(Number(cell.dataset.number) === selectedNumber){
                cell.style.background = getColor(selectedNumber);
                cell.textContent = '';
                cell.style.color = 'transparent';
                checkWin();
            } else {
                cell.style.border = '2px solid red';
                setTimeout(()=>cell.style.border='none',500);
            }
        });
        grid.appendChild(cell);
    });
}

// --- تحقق من الفوز ---
function checkWin(){
    const undone = Array.from(document.querySelectorAll('.cell')).filter(c => c.textContent !== '');
    if(undone.length === 0){
        msg.textContent = '🎉 أحسنت! تم تلوين كل الأرقام بنجاح';
    }
}

// --- زر إعادة اللعبة ---
resetBtn.addEventListener('click', initGrid);

// --- بدء اللعبة ---
initGrid();
</script>
</body>
</html>
