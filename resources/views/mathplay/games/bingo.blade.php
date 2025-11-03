<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 بنغو الجمع - {{ $lesson_game->lesson->name }}</title>
    <style>
        /* ===== التنسيقات الأساسية ===== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            direction: rtl;
        }

        .container {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
        }

        /* ===== رأس اللعبة ===== */
        .game-header {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .game-header::before {
            content: "🎯";
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 120px;
            opacity: 0.1;
            transform: rotate(25deg);
        }

        .lesson-info {
            font-size: 1.3em;
            margin-bottom: 12px;
            opacity: 0.95;
            font-weight: bold;
        }

        h1 {
            font-size: 2.8em;
            margin-bottom: 20px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .instructions {
            background: rgba(255, 255, 255, 0.25);
            padding: 15px;
            border-radius: 15px;
            margin-top: 20px;
            font-size: 1.2em;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .range-info {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.4);
        }

        /* ===== منطقة اللعبة ===== */
        .game-area {
            padding: 40px;
            background: #f8f9fa;
            min-height: 500px;
            position: relative;
        }

        .question-section {
            background: white;
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #3498db;
            text-align: center;
        }

        .question-display {
            font-size: 2.5em;
            font-weight: bold;
            color: #e74c3c;
            margin: 20px 0;
            padding: 20px;
            border: 3px dashed #3498db;
            border-radius: 15px;
            background: #f8f9fa;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            font-size: 1.3em;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
        }

        /* ===== لوحة البنغو ===== */
        .bingo-section {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #27ae60;
        }

        .bingo-board {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }

        .bingo-board td {
            border: 4px solid #3498db;
            width: 33.33%;
            height: 100px;
            text-align: center;
            font-size: 1.6em;
            font-weight: bold;
            cursor: pointer;
            background: white;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .bingo-board td::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
        }

        .bingo-board td:hover {
            background: #e3f2fd;
            transform: scale(1.05);
            z-index: 2;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .bingo-board td.marked {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.2);
            pointer-events: none;
            animation: cellPop 0.5s ease;
        }

        .bingo-board td.marked::after {
            content: "✓";
            position: absolute;
            top: 5px;
            left: 5px;
            font-size: 1.2em;
            color: rgba(255, 255, 255, 0.8);
        }

        @keyframes cellPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .bingo-board td.bingo-line {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            animation: bingoCelebrate 0.8s ease;
        }

        @keyframes bingoCelebrate {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.1) rotate(-3deg); }
            75% { transform: scale(1.1) rotate(3deg); }
        }

        /* ===== التغذية الراجعة ===== */
        .feedback {
            min-height: 80px;
            margin: 25px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .message {
            font-size: 1.5em;
            font-weight: bold;
            padding: 18px 30px;
            border-radius: 50px;
            text-align: center;
            transition: all 0.4s ease;
            max-width: 85%;
            backdrop-filter: blur(10px);
        }

        .message.success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            animation: messageBounce 0.6s ease;
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.4);
        }

        .message.error {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            animation: messageShake 0.6s ease;
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
        }

        .message.info {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        @keyframes messageBounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            80% { transform: translateY(-5px); }
        }

        @keyframes messageShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* ===== لوحة النقاط ===== */
        .score-board {
            background: white;
            padding: 25px;
            border-radius: 20px;
            margin-top: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border: 3px solid #f39c12;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            background: #f8f9fa;
            min-width: 140px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 2px solid #3498db;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 2.2em;
            font-weight: bold;
            color: #e74c3c;
            display: block;
            margin-top: 8px;
        }

        .stat-label {
            color: #7f8c8d;
            font-weight: bold;
            font-size: 1.1em;
        }

        .progress-section {
            margin: 20px 0;
        }

        .progress-container {
            width: 100%;
            background: #e0e0e0;
            border-radius: 10px;
            margin: 15px 0;
            overflow: hidden;
            height: 14px;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            width: 0%;
            transition: width 0.6s ease;
        }

        /* ===== الكونفيتي ===== */
        .celebration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
            display: none;
        }

        .confetti {
            position: absolute;
            width: 14px;
            height: 14px;
            opacity: 0;
            border-radius: 2px;
        }

        @keyframes confettiFall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* ===== التكيف مع الشاشات الصغيرة ===== */
        @media (max-width: 768px) {
            .container {
                margin: 10px;
            }

            .game-header {
                padding: 20px;
            }

            h1 {
                font-size: 2.2em;
            }

            .question-display {
                font-size: 2em;
                padding: 15px;
            }

            .bingo-board td {
                height: 80px;
                font-size: 1.3em;
            }

            .controls {
                gap: 15px;
            }

            .btn {
                padding: 12px 25px;
                font-size: 1.1em;
            }

            .stats {
                gap: 15px;
            }

            .stat-item {
                min-width: 120px;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .game-area {
                padding: 25px;
            }

            .bingo-board td {
                height: 70px;
                font-size: 1.1em;
            }

            .question-display {
                font-size: 1.6em;
            }

            .message {
                font-size: 1.2em;
                padding: 15px 25px;
            }

            .stats {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- رأس اللعبة -->
        <div class="game-header">
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
            <h1>🎯 بنغو الجمع مع الحمل</h1>
            <div class="instructions">
                <p>حل مسائل الجمع ثم ابحث عن الإجابة في لوحة البنغو</p>
                <div class="range-info">المدى: {{ $min_range }} إلى {{ $max_range }}</div>
            </div>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- قسم السؤال -->
            <div class="question-section">
                <div id="question-display" class="question-display">---</div>

                <div class="controls">
                    <button id="generate-btn" class="btn btn-primary">🔄 توليد سؤال جديد</button>
                    <button id="hint-btn" class="btn btn-warning">💡 عرض التلميح</button>
                    <button id="new-game-btn" class="btn btn-success">🎮 لعبة جديدة</button>
                </div>
            </div>

            <!-- لوحة البنغو -->
            <div class="bingo-section">
                <h3 style="text-align: center; color: #2c3e50; margin-bottom: 20px;">لوحة البنغو</h3>
                <table id="bingo-board" class="bingo-board">
                    <!-- سيتم تعبئة لوحة البنغو بالجافاسكريبت -->
                </table>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback">
                <div id="message" class="message info">انقر على "توليد سؤال جديد" لبدء اللعبة!</div>
            </div>

            <!-- لوحة النقاط -->
            <div class="score-board">
                <div class="stats">
                    <div class="stat-item">
                        <span class="stat-label">النقاط</span>
                        <span id="score" class="stat-value">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">الصفوف المكتملة</span>
                        <span id="completed-rows" class="stat-value">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">المستوى</span>
                        <span id="level" class="stat-value">1</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">الإجابات الصحيحة</span>
                        <span id="correct-answers" class="stat-value">0</span>
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-container">
                        <div id="progress-bar" class="progress-bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // ===== تهيئة المتغيرات =====
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        const operationType = '{{ $operation_type }}'; // addition

        let currentQuestion = '';
        let currentAnswer = 0;
        let score = 0;
        let completedRows = 0;
        let currentLevel = 1;
        let correctAnswersCount = 0;
        const boardSize = 3;
        let boardValues = [];
        let markedCells = Array(boardSize).fill(0).map(() => Array(boardSize).fill(false));
        let bingoLines = [];

        // ===== العناصر =====
        const questionDisplay = document.getElementById('question-display');
        const messageElement = document.getElementById('message');
        const scoreElement = document.getElementById('score');
        const completedRowsElement = document.getElementById('completed-rows');
        const levelElement = document.getElementById('level');
        const correctAnswersElement = document.getElementById('correct-answers');
        const progressBar = document.getElementById('progress-bar');
        const bingoBoard = document.getElementById('bingo-board');
        const celebrationElement = document.getElementById('celebration');

        // ===== الدوال الأساسية =====

        // توليد عدد عشوائي ضمن المدى المحدد
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // توليد مسألة جمع مع حمل
        function generateAdditionWithCarry() {
            let num1, num2;
            let hasCarry = false;

            // التأكد من وجود حمل في المسألة
            do {
                num1 = generateRandomNumber();
                num2 = generateRandomNumber();

                // التحقق من وجود حمل في أي منزلة
                let temp1 = num1;
                let temp2 = num2;
                hasCarry = false;

                while (temp1 > 0 || temp2 > 0) {
                    const digit1 = temp1 % 10;
                    const digit2 = temp2 % 10;

                    if (digit1 + digit2 >= 10) {
                        hasCarry = true;
                        break;
                    }

                    temp1 = Math.floor(temp1 / 10);
                    temp2 = Math.floor(temp2 / 10);
                }
            } while (!hasCarry);

            currentAnswer = num1 + num2;
            currentQuestion = `${num1.toLocaleString('ar-EG')} + ${num2.toLocaleString('ar-EG')}`;

            return currentAnswer;
        }

        // خلط المصفوفة (Fisher-Yates)
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // إعداد لوحة البنغو
        function setupBingoBoard() {
            // توليد 9 إجابات فريدة لمسائل الجمع مع حمل
            const answers = new Set();
            while (answers.size < boardSize * boardSize) {
                const answer = generateAdditionWithCarry();
                answers.add(answer);
            }

            boardValues = Array.from(answers);
            shuffleArray(boardValues);

            // إعادة تعيين الخلايا المعلَّمة
            markedCells = Array(boardSize).fill(0).map(() => Array(boardSize).fill(false));
            bingoLines = [];

            // بناء لوحة البنغو
            bingoBoard.innerHTML = '';
            let valueIndex = 0;

            for (let i = 0; i < boardSize; i++) {
                const row = bingoBoard.insertRow();
                for (let j = 0; j < boardSize; j++) {
                    const cell = row.insertCell();
                    const value = boardValues[valueIndex++];

                    cell.textContent = value.toLocaleString('ar-EG');
                    cell.dataset.value = value;
                    cell.dataset.row = i;
                    cell.dataset.col = j;

                    cell.addEventListener('click', handleCellClick);
                }
            }

            updateStats();
            showMessage('لوحة البنغو جاهزة! انقر على "توليد سؤال جديد" لبدء اللعبة', 'info');
        }

        // معالجة النقر على خلية البنغو
        function handleCellClick(event) {
            if (!currentQuestion) {
                showMessage('يجب توليد سؤال أولاً!', 'error');
                return;
            }

            const cell = event.target;
            const cellValue = parseInt(cell.dataset.value);
            const row = parseInt(cell.dataset.row);
            const col = parseInt(cell.dataset.col);

            if (markedCells[row][col]) {
                showMessage('هذه الخلية معلَّمة مسبقاً!', 'error');
                return;
            }

            if (cellValue === currentAnswer) {
                // إجابة صحيحة
                markCell(cell, row, col);
                correctAnswersCount++;
                showMessage('إجابة صحيحة! 🎉', 'success');
                checkBingo();

                // مسح السؤال الحالي
                currentQuestion = '';
                questionDisplay.textContent = '---';
            } else {
                showMessage('إجابة خاطئة! حاول مرة أخرى', 'error');
            }
        }

        // تعليم خلية البنغو
        function markCell(cell, row, col) {
            cell.classList.add('marked');
            markedCells[row][col] = true;
        }

        // التحقق من تحقيق البنغو
        function checkBingo() {
            const newCompletedRows = countCompletedLines();
            const newRows = newCompletedRows - completedRows;

            if (newRows > 0) {
                completedRows = newCompletedRows;
                score += newRows * 100 * currentLevel;

                showMessage(`مبروك! 🎊 أكملت ${newRows} صف/صفوف جديدة!`, 'success');
                highlightBingoLines();
                createCelebration();

                // ترقية المستوى
                if (completedRows >= currentLevel * 2) {
                    currentLevel++;
                    levelElement.textContent = currentLevel;
                    showMessage(`🎯 تقدمت للمستوى ${currentLevel}!`, 'success');
                }
            }

            updateStats();
        }

        // عد الصفوف والأعمدة والأقطار المكتملة
        function countCompletedLines() {
            let count = 0;
            const size = boardSize;

            // الصفوف
            for (let i = 0; i < size; i++) {
                if (markedCells[i].every(cell => cell)) count++;
            }

            // الأعمدة
            for (let j = 0; j < size; j++) {
                if (markedCells.every(row => row[j])) count++;
            }

            // القطر الرئيسي
            if (markedCells.every((row, i) => row[i])) count++;

            // القطر الثانوي
            if (markedCells.every((row, i) => row[size - 1 - i])) count++;

            return count;
        }

        // إبراز خطوط البنغو
        function highlightBingoLines() {
            const size = boardSize;

            // الصفوف
            for (let i = 0; i < size; i++) {
                if (markedCells[i].every(cell => cell)) {
                    for (let j = 0; j < size; j++) {
                        const cell = bingoBoard.rows[i].cells[j];
                        cell.classList.add('bingo-line');
                    }
                }
            }

            // الأعمدة
            for (let j = 0; j < size; j++) {
                if (markedCells.every(row => row[j])) {
                    for (let i = 0; i < size; i++) {
                        const cell = bingoBoard.rows[i].cells[j];
                        cell.classList.add('bingo-line');
                    }
                }
            }

            // القطر الرئيسي
            if (markedCells.every((row, i) => row[i])) {
                for (let i = 0; i < size; i++) {
                    const cell = bingoBoard.rows[i].cells[i];
                    cell.classList.add('bingo-line');
                }
            }

            // القطر الثانوي
            if (markedCells.every((row, i) => row[size - 1 - i])) {
                for (let i = 0; i < size; i++) {
                    const cell = bingoBoard.rows[i].cells[size - 1 - i];
                    cell.classList.add('bingo-line');
                }
            }
        }

        // توليد سؤال جديد
        function generateNewQuestion() {
            if (currentQuestion) {
                showMessage('يجب حل السؤال الحالي أولاً!', 'error');
                return;
            }

            // التأكد من أن الإجابة موجودة في لوحة البنغو
            let attempts = 0;
            let answerOnBoard = false;

            while (!answerOnBoard && attempts < 50) {
                generateAdditionWithCarry();
                if (boardValues.includes(currentAnswer)) {
                    answerOnBoard = true;
                }
                attempts++;
            }

            if (answerOnBoard) {
                questionDisplay.textContent = `${currentQuestion} = ?`;
                showMessage('ابحث عن الإجابة في لوحة البنغو!', 'info');
            } else {
                showMessage('لم نتمكن من توليد سؤال مناسب. جرب لعبة جديدة!', 'error');
            }
        }

        // عرض تلميح
        function showHint() {
            if (!currentQuestion) {
                showMessage('يجب توليد سؤال أولاً!', 'error');
                return;
            }

            const availableCells = [];
            for (let i = 0; i < boardSize; i++) {
                for (let j = 0; j < boardSize; j++) {
                    if (!markedCells[i][j] && parseInt(bingoBoard.rows[i].cells[j].dataset.value) === currentAnswer) {
                        availableCells.push({row: i, col: j});
                    }
                }
            }

            if (availableCells.length > 0) {
                const randomCell = availableCells[Math.floor(Math.random() * availableCells.length)];
                const cell = bingoBoard.rows[randomCell.row].cells[randomCell.col];

                cell.style.backgroundColor = '#fff3cd';
                cell.style.borderColor = '#ffc107';

                setTimeout(() => {
                    cell.style.backgroundColor = '';
                    cell.style.borderColor = '';
                }, 2000);

                showMessage('انظر إلى التلميح في لوحة البنغو!', 'info');
            }
        }

        // بدء لعبة جديدة
        function startNewGame() {
            score = 0;
            completedRows = 0;
            currentLevel = 1;
            correctAnswersCount = 0;
            currentQuestion = '';

            setupBingoBoard();
            questionDisplay.textContent = '---';
            showMessage('لعبة جديدة! انقر على "توليد سؤال جديد" لبدء اللعب', 'info');
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            completedRowsElement.textContent = completedRows;
            levelElement.textContent = currentLevel;
            correctAnswersElement.textContent = correctAnswersCount;

            // تحديث شريط التقدم
            const progress = (correctAnswersCount % 9) * (100 / 9);
            progressBar.style.width = `${progress}%`;
        }

        // عرض رسالة
        function showMessage(text, type) {
            messageElement.textContent = text;
            messageElement.className = `message ${type}`;
        }

        // تأثير الاحتفال
        function createCelebration() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            const colors = ['#3498db', '#e74c3c', '#27ae60', '#f39c12', '#9b59b6', '#1abc9c'];

            for (let i = 0; i < 120; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = `${Math.random() * 100}%`;
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `confettiFall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.animationDelay = `${Math.random() * 0.5}s`;

                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 3500);
        }

        // ===== تهيئة الأحداث =====
        document.getElementById('generate-btn').addEventListener('click', generateNewQuestion);
        document.getElementById('hint-btn').addEventListener('click', showHint);
        document.getElementById('new-game-btn').addEventListener('click', startNewGame);

        // بدء اللعبة عند تحميل الصفحة
        window.addEventListener('load', startNewGame);
    </script>
</body>
</html>
