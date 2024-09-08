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

const startQuizButton = document.getElementById('start-quiz-btn');
const questionElement = document.getElementById('question');
const answerButtonsElement = document.getElementById('answer-buttons');
const nextButton = document.getElementById('next-btn');
const listQuestionsButton = document.getElementById('list-questions-btn');
const questionsListElement = document.getElementById('questions-list');

let currentQuestionIndex = 0;
let score = 0;

/**
 * Düzenleme yapılacak...
 */
window.onload = () => {
    nextButton.classList.add('hide');
};
function startQuiz() {
    currentQuestionIndex = 0;
    score = 0;
    nextButton.classList.add('hide');
    questionsListElement.innerHTML = '';
    showQuestion(questions[currentQuestionIndex]);
}

/**
 * Düzenleme yapılacak...
 */
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

    Array.from(answerButtonsElement.children).forEach(button => {
        button.disabled = true;
        if(button.dataset.correct) {
            button.classList.add('Doğru!');
        } else {
            button.classList.add('Yanlış!');
        }
    });

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
                ${question.answers.map((answer) => 
                    `<li>${answer.text} ${answer.correct ? '(Doğru)' : ''}</li>`
                ).join('')}
            </ul>
            <button onclick="editQuestion(${index})">Düzenle</button>
            <button onclick="deleteQuestion(${index})">Sil</button>
        `;

        questionsListElement.appendChild(questionItem);
    });
}

function editQuestion(index) {
    const question = questions[index];
    const newQuestion = prompt('Yeni soru girin:',question.question);
    const newDifficulty = prompt('Yeni zorluk seviyesi girin:', question.difficulty);

    question.answers.forEach((answer, index) => {
        const newAnswerText = prompt(`Yeni cevap girin (${answer.text}):`, answer.text);
        const isCorrect = confirm(`Doğru mu? (${answer.text})`);
    });

    answer.text = newAnswerText;
    answer.correct = isCorrect;

    listQuestions();
}

function deleteQuestion(index) {
    questions.splice(index, 1);
    listQuestions();
}

startQuizButton.addEventListener('click', startQuiz);
listQuestionsButton.addEventListener('click', listQuestions);

nextButton.addEventListener('click', () => {
    currentQuestionIndex++;
    if(currentQuestionIndex < questions.length) {
        showQuestion(questions[currentQuestionIndex]);
        nextButton.classList.add('hide');
    } else {
        startQuiz();
    }
});