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

window.onload = () => {
    nextButton.classList.add('hide');
};

function startQuiz() {
    currentQuestionIndex = 0;
    score = 0;
    questionsListElement.innerHTML = '';
    nextButton.innerHTML = 'Sonraki Soru';
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
    const isCorrect = selectedButton.dataset.correct === "true";
    if (isCorrect) {
        score++;
        selectedButton.classList.add('correct');
    } else {
        selectedButton.classList.add('incorrect');
    }

    Array.from(answerButtonsElement.children).forEach(button => {
        if (button.dataset.correct === "true") {
            button.classList.add('correct');
        }
        button.disabled = true;
    });

    nextButton.classList.remove('hide');
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
    const newQuestion = prompt('Soru', question.question);
    const newDifficulty = prompt('Zorluk', question.difficulty);

    const newAnswers = question.answers.map((answer) => {
        const newAnswerText = prompt('Cevap', answer.text);
        const isCorrect = confirm(`Doğru mu? (${answer.text})`);
        return { text: newAnswerText, correct: isCorrect };
    });

    const editedQuestion = {
        question: newQuestion,
        difficulty: newDifficulty,
        answers: newAnswers,
    };

    questions[index] = editedQuestion;
    
    listQuestions();
}

function deleteQuestion(index) {
    questions.splice(index, 1);
    listQuestions();
}

function resetState() {
    nextButton.classList.add('hide');
    while (answerButtonsElement.firstChild) {
        answerButtonsElement.removeChild(answerButtonsElement.firstChild);
    }
}

function showResult() {
    resetState();
    questionElement.innerText = `Puan: ${score}`;
    nextButton.innerHTML = 'Tekrar Başla';
    nextButton.classList.remove('hide');
}

function handleNextButton() {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        showQuestion(questions[currentQuestionIndex]);
    } else {
        showResult();
    }
}

startQuizButton.addEventListener('click', startQuiz);
listQuestionsButton.addEventListener('click', listQuestions);

nextButton.addEventListener('click', () => {
    if (currentQuestionIndex < questions.length) {
        handleNextButton();
    } else {
        startQuiz();
    }
});


