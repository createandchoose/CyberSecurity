<script>
    import { onMount } from "svelte";
    import { page } from '$app/stores';
    import {goto} from "$app/navigation";
    const apiUrl = import.meta.env.VITE_API_URL;
    let test = { questions: [] };
    let currentQuestionIndex = 0;
    let selectedAnswers = {};
    let currentAnswer = null;
    let token = "";
    let testCompleted = false;
    let testResult = null;

    $: testId = $page.params.id;
    if(typeof window !== 'undefined') {
        $: token = localStorage.getItem('token');
    }
    onMount(async () => {
        if(token == null) {
            goto('/auth/login')
        }
        let response = await fetch(apiUrl + '/tests/test?test_id=' + testId, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        });
        let data = await response.json();
        test = data.data;
    });

    function nextQuestion() {
        if (currentQuestionIndex < test.questions.length - 1) {
            // Сохраняем текущий ответ
            if (currentAnswer !== null) {
                selectedAnswers[test.questions[currentQuestionIndex].id] = currentAnswer;
            }

            // Переходим к следующему вопросу и сбрасываем текущий ответ
            currentQuestionIndex++;
            currentAnswer = null;
        }
    }

    async function submitTest() {
        if (currentAnswer !== null) {
            selectedAnswers[test.questions[currentQuestionIndex].id] = currentAnswer;
        }
        let payload = {
            test_id: testId,
            answers: Object.entries(selectedAnswers).map(([questionId, answerId]) => ({ question_id: questionId, id: answerId }))
        };
        let response = await fetch(apiUrl + '/tests/pass', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + token
            },
            body: JSON.stringify(payload)
        })
        if (!response.ok) {
            alert("Произошла ошибка!")
        } else {
            testResult = await response.json();
            testCompleted = true;
        }
    }
</script>
<div class="container">
        <div class="waves---section-medium-4"></div>
        <div class="waves---section-medium-4">
            <div class="waves---main-container-5 w-container">
                {#if testCompleted}
                    <div class="test-results">
                        <h2 class="waves---heading-2-no-margins-3">Результаты теста: {testResult.data.test.name}</h2>
                        <p class="waves---paragraph-big-3-copy">Дата прохождения: {testResult.data.created_at}</p>
                        <h3 class="waves---paragraph-big-3-copy">Ваши ответы:</h3>
                        <ul>
                            {#each testResult.data.questions as question}
                                <li class="waves---paragraph-small-3">
                                    <strong>{question.question.question}</strong> - {question.is_right ? 'Верно' : 'Неверно'}
                                </li>
                            {/each}
                        </ul>
                    </div>
                {:else}
                    <div class="waves---sides-heading-button-3">
                        <h2 class="waves---heading-2-no-margins-3">{test.name}</h2>
                    </div>
                    {#if test.questions.length > 0}
                        <div class="question w-form">
                            <h3 class="waves---paragraph-big-3-copy">{test.questions[currentQuestionIndex].question}</h3>
                            {#each test.questions[currentQuestionIndex].answers as answer}
                                <label class="w-checkbox checkbox-field">
                                    <input class="w-checkbox-input" type="radio" bind:group={currentAnswer} value={answer.id}>
                                    {answer.answer}
                                </label>
                            {/each}
                        </div>
                        {#if currentQuestionIndex < test.questions.length - 1}
                            <button class="waves---cta-dark-5 wide-cta w-button" on:click={nextQuestion}>Далее</button>
                        {:else}
                            <button class="waves---cta-dark-5 wide-cta w-button" on:click={submitTest}>Завершить тест</button>
                        {/if}
                    {/if}
                {/if}
            </div>
        </div>
</div>
