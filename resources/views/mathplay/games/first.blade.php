<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحدي التوقيت</title>
    <style>
        /* === CSS / التنسيقات === */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            direction: rtl;
            text-align: center;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 550px;
        }

        h1 {
            color: #3498db;
            margin-bottom: 20px;
        }

        .game-area {
            padding: 25px;
            background-color: #ecf0f1;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        #timer {
            font-size: 3em;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 15px;
        }

        .question-display {
            font-size: 2.5em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        #user-answer {
            padding: 10px;
            font-size: 1.2em;
            border: 2px solid #ccc;
            border-radius: 5px;
            width: 70%;
            text-align: center;
            margin-bottom: 15px;
        }

        .message {
            margin-top: 10px;
            font-size: 1.1em;
            font-weight: bold;
            min-height: 25px;
        }

        .scoreboard {
            padding-top: 15px;
            border-top: 1px dashed #3498db;
        }

        #score {
            font-size: 1.8em;
            color: #3498db;
        }

        button {
            padding: 10px 20px;
            font-size: 1.1em;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>تحدي الجمع والطرح بالتوقيت</h1>

        <div class="game-area">
            <div id="timer">60</div>
            <div id="question-display" class="question-display">اضغط ابدأ لبدء التحدي</div>

            <input type="number" id="user-answer" placeholder="أدخل الإجابة هنا">
            <button onclick="checkAnswer()">إرسال</button>

            <div id="message" class="message"></div>
        </div>

        <div class="scoreboard">
            <h2>النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <button onclick="startGame()">ابدأ التحدي</button>
        </div>
    </div>

    <script>
        /* === JavaScript / المنطق === */
        let currentAnswer = 0;
        let score = 0;
        let timeLeft = 60;
        let timerInterval;
        let gameActive = false;

        function generateNumber(max) {
            return Math.floor(Math.random() * (max - 10000 + 1)) + 10000;
        }

        function generateQuestion() {
            const num1 = generateNumber(99999);
            const num2 = generateNumber(99999);
            const operationType = Math.random() < 0.5 ? '+' : '-';

            if (operationType === '+') {
                currentAnswer = num1 + num2;
                document.getElementById('question-display').textContent = `${num1.toLocaleString('en')} + ${num2.toLocaleString('en')} = ؟`;
            } else {
                const smallerNum = Math.min(num1, num2);
                const largerNum = Math.max(num1, num2);
                currentAnswer = largerNum - smallerNum;
                document.getElementById('question-display').textContent = `${largerNum.toLocaleString('en')} - ${smallerNum.toLocaleString('en')} = ؟`;
            }
            document.getElementById('user-answer').value = '';
        }

        function checkAnswer() {
            if (!gameActive) {
                document.getElementById('message').textContent = 'اضغط ابدأ لبدء التحدي!';
                return;
            }

            const userAnswer = parseInt(document.getElementById('user-answer').value);
            const messageElement = document.getElementById('message');

            if (isNaN(userAnswer)) {
                messageElement.textContent = 'أدخل رقماً صالحاً.';
                messageElement.style.color = 'orange';
                return;
            }

            if (userAnswer === currentAnswer) {
                messageElement.textContent = 'صحيح! +1 نقطة.';
                messageElement.style.color = '#2ecc71';
                score++;
                document.getElementById('score').textContent = score;
                generateQuestion(); // سؤال جديد فورا
            } else {
                messageElement.textContent = 'خطأ! -1 نقطة.';
                messageElement.style.color = '#e74c3c';
                score = Math.max(0, score - 1);
                document.getElementById('score').textContent = score;
            }
            document.getElementById('user-answer').focus(); // للسرعة
        }

        function updateTimer() {
            timeLeft--;
            document.getElementById('timer').textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                endGame();
            }
        }

        function endGame() {
            gameActive = false;
            document.getElementById('question-display').textContent = 'انتهى الوقت!';
            document.getElementById('message').textContent = `نتيجتك النهائية هي: ${score} سؤال صحيح.`;
        }

        function startGame() {
            clearInterval(timerInterval);
            score = 0;
            timeLeft = 60;
            gameActive = true;
            document.getElementById('score').textContent = score;
            document.getElementById('timer').textContent = timeLeft;
            document.getElementById('message').textContent = '';

            generateQuestion();
            timerInterval = setInterval(updateTimer, 1000);
            document.getElementById('user-answer').focus();
        }

        window.onload = () => document.getElementById('score').textContent = score;
    </script>
</body>

</html>