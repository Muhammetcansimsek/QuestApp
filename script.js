const questions = [
    {
        question: "Fransa'nın başkenti neredir?",
        difficulty: "easy",
        answers: [
            { text: "Berlin", correct: false },
            { text: "Madrid", correct: false },
            { text: "Paris", correct: true },
            { text: "Lisbon", correct: false }
        ]
    },
    {
        question: "İngiltere'nin başkenti neredir?",
        difficulty: "easy",
        answers: [
            { text: "İspanya", correct: false },
            { text: "Ankara", correct: false },
            { text: "Dortmunt", correct: false },
            { text: "Londra", correct: true }
        ]
    },
    {
        question: "ABD'nin başkenti neredir?",
        difficulty: "easy",
        answers: [
            { text: "New York", correct: false },
            { text: "California", correct: false },
            { text: "Washington DC", correct: true },
            { text: "Nevada", correct: false }
        ]
    },
];

const questionElement = document.getElementById('question');
const answerButtonsElement = document.getElementById('answer-buttons');
const nextButton = document.getElementById('next-btn');
const listQuestionsButton = document.getElementById('list-questions-btn');
const searchQuestionsButton = document.getElementById('search-questions-btn');
const addQuestionButton = document.getElementById('add-question-btn');
const questionsListElement = document.getElementById('questions-list');
const addQuestionForm = document.getElementById('add-question-form');
const saveQuestionButton = document.getElementById('save-question-btn');
const newQuestionText = document.getElementById('new-question-text');
const newQuestionDifficulty = document.getElementById('new-question-difficulty');

let currentQuestionIndex = 0;
let score = 0;

function startQuiz() {
    currentQuestionIndex = 0;
    score = 0;
    nextButton.classList.add('hide');
    questionsListElement.innerHTML = '';
    showQuestion(questions[currentQuestionIndex]);
}

function showQuestion(question) {
    questionElement.innerText = question.question;
    answerButtonsElement.innerHTML = '';
    question.answers.forEach(answer => {
        const button = document.createElement('button');
        button.innerText = answer.text;
        button.classList.add('btn');
        if (answer.correct) {
            button.dataset.correct = answer.correct;
        }
        button.addEventListener('click', selectAnswer);
        answerButtonsElement.appendChild(button);
    });
}

function selectAnswer(e) {
    const selectedButton = e.target;
    const correct = selectedButton.dataset.correct;
    if (correct) {
        score++;
        alert("Doğru! Puanınız: " + score);
    } else {
        alert("Yanlış!");
    }
    if (questions.length > currentQuestionIndex + 1) {
        nextButton.classList.remove('hide');
    } else {
        nextButton.innerText = 'Yeniden Başlat';
        nextButton.classList.remove('hide');
    }
}

function listQuestions() {
    questionsListElement.innerHTML = '';
    questions.forEach((question, index) => {
        const questionItem = document.createElement('div');
        questionItem.innerHTML = `
            <p>${index + 1}. ${question.question} (Zorluk: ${question.difficulty})</p>
            <ul>
                ${question.answers.map(answer => `<li>${answer.text} ${answer.correct ? '(Doğru)' : ''}</li>`).join('')}
            </ul>
            <button onclick="editQuestion(${index})">Düzenle</button>
            <button onclick="deleteQuestion(${index})">Sil</button>
        `;
        questionsListElement.appendChild(questionItem);
    });
}

function searchQuestions(query) {
    questionsListElement.innerHTML = '';
    const filteredQuestions = questions.filter(q => q.question.toLowerCase().includes(query.toLowerCase()));
    filteredQuestions.forEach((question, index) => {
        const questionItem = document.createElement('div');
        questionItem.innerHTML = `
            <p>${index + 1}. ${question.question} (Zorluk: ${question.difficulty})</p>
            <ul>
                ${question.answers.map(answer => `<li>${answer.text} ${answer.correct ? '(Doğru)' : ''}</li>`).join('')}
            </ul>
            <button onclick="editQuestion(${index})">Düzenle</button>
            <button onclick="deleteQuestion(${index})">Sil</button>
        `;
        questionsListElement.appendChild(questionItem);
    });
}

function addQuestion() {
    addQuestionForm.classList.remove('hide');
}

function saveQuestion() {
    const questionText = newQuestionText.value;
    const questionDifficulty = newQuestionDifficulty.value;
    const answers = [
        { text: document.getElementById('answer1').value, correct: document.getElementById('correct1').checked },
        { text: document.getElementById('answer2').value, correct: document.getElementById('correct2').checked },
        { text: document.getElementById('answer3').value, correct: document.getElementById('correct3').checked },
        { text: document.getElementById('answer4').value, correct: document.getElementById('correct4').checked }
    ];
    
    if (questionText && questionDifficulty && answers.some(answer => answer.text)) {
        questions.push({
            question: questionText,
            difficulty: questionDifficulty,
            answers: answers
        });
        newQuestionText.value = '';
        newQuestionDifficulty.value = '';
        addQuestionForm.classList.add('hide');
        listQuestions();
    } else {
        alert("Lütfen tüm alanları doldurun.");
    }
}


function editQuestion(index) {
    alert(`Soru ${index + 1} düzenleniyor...`);
}

function deleteQuestion(index) {
    questions.splice(index, 1);
    listQuestions();
}

listQuestionsButton.addEventListener('click', listQuestions);
searchQuestionsButton.addEventListener('click', searchQuestions);
addQuestionButton.addEventListener('click', addQuestion);
saveQuestionButton.addEventListener('click', saveQuestion);

nextButton.addEventListener('click', () => {
    currentQuestionIndex++;
    showQuestion(questions[currentQuestionIndex]);
});

startQuiz();