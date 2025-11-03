<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مهندس محيط المستطيل - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2d3436;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .lesson-info {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 1.3em;
        }

        .engineering-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 968px) {
            .engineering-layout {
                grid-template-columns: 1fr;
            }
        }

        .projects-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .project-card {
            background: white;
            border: 2px solid #ddd;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .project-card.active {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .project-icon {
            font-size: 2.5em;
            text-align: center;
            margin-bottom: 10px;
        }

        .project-details {
            text-align: center;
        }

        .workshop-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .workshop-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .blueprint {
            width: 250px;
            height: 180px;
            border: 3px dashed #ffb300;
            margin: 20px auto;
            position: relative;
            background: rgba(255, 179, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blueprint-dimensions {
            position: absolute;
            background: #667eea;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 0.9em;
        }

        .dimension-length {
            bottom: -35px;
            left: 50%;
            transform: translateX(-50%);
        }

        .dimension-width {
            right: -45px;
            top: 50%;
            transform: translateY(-50%);
            writing-mode: vertical-lr;
        }

        .project-description {
            font-size: 1.2em;
            color: #2d3436;
            margin: 15px 0;
            line-height: 1.6;
        }

        .calculation-area {
            background: #e8f4fd;
            border: 2px solid #74b9ff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .formula-display {
            background: white;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
            font-size: 1.3em;
            font-weight: bold;
        }

        .input-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .input-group {
            text-align: center;
        }

        .input-label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .workshop-input {
            width: 120px;
            height: 50px;
            border: 2px solid #ddd;
            border-radius: 10px;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            margin: 0 auto;
            display: block;
            transition: all 0.3s ease;
        }

        .workshop-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
            outline: none;
        }

        .result-display {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            display: none;
        }

        .result-display.show {
            display: block;
            animation: slideDown 0.5s ease;
        }

        .material-calculator {
            background: #d4edda;
            border: 2px solid #c3e6cb;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
        }

        .material-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #c3e6cb;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        #calculate-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #material-btn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        #next-project-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        #reset-workshop-btn {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            font-size: 1.2em;
        }

        .success {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            animation: celebrate 0.5s ease;
        }

        .error {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        .info {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .project-context {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
        }

        .cost-estimation {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            display: none;
        }

        .cost-estimation.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏗️ مهندس محيط المستطيل</h1>
            <p>طبق معرفتك في مشاريع هندسية واقعية!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="engineering-layout">
            <div class="projects-section">
                <h3>📋 المشاريع الهندسية</h3>
                
                <div class="project-card active" data-project="garden">
                    <div class="project-icon">🌳</div>
                    <div class="project-details">
                        <h4>حديقة مستطيلة</h4>
                        <p>حساب طول السياج المطلوب</p>
                    </div>
                </div>

                <div class="project-card" data-project="room">
                    <div class="project-icon">🏠</div>
                    <div class="project-details">
                        <h4>غرفة مستطيلة</h4>
                        <p>حساب طول حاشية السقف</p>
                    </div>
                </div>

                <div class="project-card" data-project="pool">
                    <div class="project-icon">🏊</div>
                    <div class="project-details">
                        <h4>مسبح مستطيل</h4>
                        <p>حساب طول السياج الأمني</p>
                    </div>
                </div>

                <div class="project-card" data-project="field">
                    <div class="project-icon">⚽</div>
                    <div class="project-details">
                        <h4>ملعب رياضي</h4>
                        <p>حساب طول السياج المحيط</p>
                    </div>
                </div>

                <div class="project-context">
                    <h4>💡 معلومات هندسية:</h4>
                    <p>المحيط مهم في التخطيط للمشاريع:</p>
                    <ul style="margin-right: 20px; margin-top: 10px;">
                        <li>تقدير كمية المواد</li>
                        <li>حساب التكاليف</li>
                        <li>التخطيط للمساحات</li>
                    </ul>
                </div>
            </div>
            
            <div class="workshop-area">
                <div class="workshop-display">
                    <h3 id="project-title">حديقة مستطيلة</h3>
                    <div class="blueprint" id="blueprint">
                        <div class="blueprint-dimensions dimension-length" id="blueprint-length">12 م</div>
                        <div class="blueprint-dimensions dimension-width" id="blueprint-width">8 م</div>
                    </div>
                    <div class="project-description" id="project-description">
                        <!-- وصف المشروع سيظهر هنا -->
                    </div>
                </div>

                <div class="calculation-area">
                    <h4 style="text-align: center; margin-bottom: 15px;">🧮 منطقة الحسابات</h4>
                    
                    <div class="formula-display">
                        محيط المستطيل = 2 × (الطول + العرض)
                    </div>

                    <div class="input-grid">
                        <div class="input-group">
                            <span class="input-label">الطول:</span>
                            <input type="number" id="workshop-length" class="workshop-input" value="12">
                        </div>
                        <div class="input-group">
                            <span class="input-label">العرض:</span>
                            <input type="number" id="workshop-width" class="workshop-input" value="8">
                        </div>
                    </div>

                    <div class="result-display" id="result-display">
                        <!-- النتيجة ستظهر هنا -->
                    </div>

                    <div class="material-calculator" id="material-calculator" style="display: none;">
                        <h5>📊 حساب المواد:</h5>
                        <!-- حساب المواد سيظهر هنا -->
                    </div>

                    <div class="cost-estimation" id="cost-estimation">
                        <!-- تقدير التكاليف سيظهر هنا -->
                    </div>
                </div>

                <div class="controls">
                    <button id="calculate-btn">🧮 احسب المحيط</button>
                    <button id="material-btn">📐 حساب المواد</button>
                    <button id="next-project-btn" disabled>➡️ المشروع التالي</button>
                    <button id="reset-workshop-btn">🔄 إعادة الضبط</button>
                </div>
                
                <div class="feedback" id="feedback">
                    اختر مشروعاً ثم احسب المحيط!
                </div>
            </div>
        </div>
        
        <div class="score-board">
            المشاريع المكتملة: <span id="completed-projects">0</span> | 
            النقاط: <span id="score">0</span> |
            الخبرة: <span id="experience">0</span>
        </div>
    </div>

    <script>
        // تعريف المشاريع
        const projects = {
            garden: {
                title: "حديقة مستطيلة",
                icon: "🌳",
                description: "تريد وضع سياج حول حديقة مستطيلة الشكل. احسب طول السياج المطلوب.",
                length: 12,
                width: 8,
                unit: "متر",
                material: "سياج",
                materialUnit: "متر",
                costPerUnit: 25
            },
            room: {
                title: "غرفة مستطيلة",
                icon: "🏠", 
                description: "تريد تركيب حاشية زخرفية حول سقف غرفة مستطيلة. احسب طول الحاشية المطلوبة.",
                length: 5,
                width: 4,
                unit: "متر",
                material: "حاشية",
                materialUnit: "متر",
                costPerUnit: 15
            },
            pool: {
                title: "مسبح مستطيل",
                icon: "🏊",
                description: "تريد وضع سياج أمني حول مسبح مستطيل. احسب طول السياج المطلوب.",
                length: 10,
                width: 6,
                unit: "متر",
                material: "سياج أمني",
                materialUnit: "متر", 
                costPerUnit: 40
            },
            field: {
                title: "ملعب رياضي",
                icon: "⚽",
                description: "تريد وضع سياج حول ملعب رياضي مستطيل. احسب طول السياج المطلوب.",
                length: 20,
                width: 15,
                unit: "متر",
                material: "سياج",
                materialUnit: "متر",
                costPerUnit: 30
            }
        };

        // بيانات اللعبة
        const gameData = {
            currentProject: 'garden',
            completedProjects: 0,
            score: 0,
            experience: 0,
            currentPerimeter: 0
        };

        // عناصر DOM
        const projectTitleElement = document.getElementById('project-title');
        const blueprintElement = document.getElementById('blueprint');
        const blueprintLengthElement = document.getElementById('blueprint-length');
        const blueprintWidthElement = document.getElementById('blueprint-width');
        const projectDescriptionElement = document.getElementById('project-description');
        const workshopLengthElement = document.getElementById('workshop-length');
        const workshopWidthElement = document.getElementById('workshop-width');
        const resultDisplayElement = document.getElementById('result-display');
        const materialCalculatorElement = document.getElementById('material-calculator');
        const costEstimationElement = document.getElementById('cost-estimation');
        const completedProjectsElement = document.getElementById('completed-projects');
        const scoreElement = document.getElementById('score');
        const experienceElement = document.getElementById('experience');
        const feedbackElement = document.getElementById('feedback');
        const calculateBtn = document.getElementById('calculate-btn');
        const materialBtn = document.getElementById('material-btn');
        const nextProjectBtn = document.getElementById('next-project-btn');
        const resetWorkshopBtn = document.getElementById('reset-workshop-btn');
        const projectCards = document.querySelectorAll('.project-card');

        // تهيئة اللعبة
        function initGame() {
            setupProjects();
            loadProject('garden');
        }

        // إعداد المشاريع
        function setupProjects() {
            projectCards.forEach(card => {
                card.addEventListener('click', () => {
                    projectCards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    loadProject(card.dataset.project);
                });
            });
        }

        // تحميل المشروع
        function loadProject(projectId) {
            gameData.currentProject = projectId;
            
            const project = projects[projectId];
            
            // تحديث الواجهة
            projectTitleElement.textContent = project.title;
            blueprintLengthElement.textContent = `${project.length} ${project.unit}`;
            blueprintWidthElement.textContent = `${project.width} ${project.unit}`;
            projectDescriptionElement.textContent = project.description;
            
            // تحديث المدخلات
            workshopLengthElement.value = project.length;
            workshopWidthElement.value = project.width;
            
            // إعادة تعيين
            resultDisplayElement.classList.remove('show');
            materialCalculatorElement.style.display = 'none';
            costEstimationElement.classList.remove('show');
            nextProjectBtn.disabled = true;
            
            // تحديث حجم المخطط (نسبي)
            const maxSize = 250;
            const scale = maxSize / Math.max(project.length, project.width);
            blueprintElement.style.width = `${project.length * scale}px`;
            blueprintElement.style.height = `${project.width * scale}px`;
            
            showFeedback('اضغط على "احسب المحيط" لبدء الحسابات!', 'info');
        }

        // حساب المحيط
        function calculatePerimeter() {
            const length = parseInt(workshopLengthElement.value);
            const width = parseInt(workshopWidthElement.value);
            
            if (isNaN(length) || isNaN(width) || length <= 0 || width <= 0) {
                showFeedback('❌ أدخل أبعاداً صحيحة!', 'error');
                return;
            }
            
            const perimeter = 2 * (length + width);
            gameData.currentPerimeter = perimeter;
            
            const project = projects[gameData.currentProject];
            
            resultDisplayElement.innerHTML = `
                <h4>📐 نتيجة الحساب:</h4>
                <div style="margin: 10px 0;">
                    <strong>المحيط:</strong> ${perimeter} ${project.unit}
                </div>
                <div style="margin: 10px 0;">
                    <strong>التفصيل:</strong> 2 × (${length} + ${width}) = 2 × ${length + width} = ${perimeter}
                </div>
            `;
            
            resultDisplayElement.classList.add('show');
            materialBtn.disabled = false;
            
            showFeedback('🎉 تم حساب المحيط بنجاح!', 'success');
        }

        // حساب المواد
        function calculateMaterials() {
            const project = projects[gameData.currentProject];
            const perimeter = gameData.currentPerimeter;
            
            materialCalculatorElement.innerHTML = `
                <h5>📊 حساب المواد:</h5>
                <div class="material-item">
                    <span>${project.material} المطلوب:</span>
                    <span><strong>${perimeter} ${project.materialUnit}</strong></span>
                </div>
                <div class="material-item">
                    <span>التكلفة التقريبية:</span>
                    <span><strong>${perimeter * project.costPerUnit} ريال</strong></span>
                </div>
                <div style="font-size: 0.9em; color: #666; margin-top: 10px;">
                    (سعر ${project.materialUnit} واحد: ${project.costPerUnit} ريال)
                </div>
            `;
            
            materialCalculatorElement.style.display = 'block';
            nextProjectBtn.disabled = false;
            
            // تحديث الإحصائيات
            gameData.completedProjects++;
            gameData.score += 20;
            gameData.experience += 10;
            
            updateUI();
            showFeedback('📊 تم حساب المواد والتكاليف!', 'success');
        }

        // المشروع التالي
        function nextProject() {
            const projectIds = Object.keys(projects);
            const currentIndex = projectIds.indexOf(gameData.currentProject);
            const nextIndex = (currentIndex + 1) % projectIds.length;
            
            loadProject(projectIds[nextIndex]);
        }

        // إعادة الضبط
        function resetWorkshop() {
            const project = projects[gameData.currentProject];
            
            workshopLengthElement.value = project.length;
            workshopWidthElement.value = project.width;
            resultDisplayElement.classList.remove('show');
            materialCalculatorElement.style.display = 'none';
            costEstimationElement.classList.remove('show');
            materialBtn.disabled = true;
            nextProjectBtn.disabled = true;
            
            showFeedback('🔄 تم إعادة الضبط!', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            completedProjectsElement.textContent = gameData.completedProjects;
            scoreElement.textContent = gameData.score;
            experienceElement.textContent = gameData.experience;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        calculateBtn.addEventListener('click', calculatePerimeter);
        materialBtn.addEventListener('click', calculateMaterials);
        nextProjectBtn.addEventListener('click', nextProject);
        resetWorkshopBtn.addEventListener('click', resetWorkshop);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>