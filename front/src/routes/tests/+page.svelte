<script>
    import {onMount} from "svelte";
    const apiUrl = import.meta.env.VITE_API_URL;
    let tests = [];

    onMount(async () => {
        let response = await fetch(apiUrl + '/tests/get', {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
        response = await response.json()
        $: tests = response.data
    });
</script>
<div class="waves---section-medium">
    <div class="waves---main-container-2 w-container">
        <div class="waves---sides-heading-button">
            <h2 class="waves---heading-2-no-margins">Тесты</h2>
        </div>
        <div class="w-layout-grid waves-blog-grid-3">
            {#each tests as test}
                <a href={`/tests/${test.id}`} class="waves-tile-blog-1 w-inline-block">
                    <!-- Ваша структура для каждого теста -->
                    <div class="waves-image-wrap-blog-1">
                        <img src="media/657427847d7f5fa4e94ac3b9_original-4a3132a5730605e8d3a8d6627116f65c.png" loading="lazy" sizes="(max-width: 767px) 93vw, (max-width: 991px) 480.0000305175781px, 1152px" srcset="media/657427847d7f5fa4e94ac3b9_original-4a3132a5730605e8d3a8d6627116f65c-p-500.png 500w, media/657427847d7f5fa4e94ac3b9_original-4a3132a5730605e8d3a8d6627116f65c.png 752w" alt="" class="waves-image-blog-1">
                    </div>
                    <div class="waves-bottom-blog-1">
                        <h3 class="waves---heading-3-no-margins-3">{test.name}</h3>
                    </div>
                    <div class="waves-blog-details-1">
                        <div class="waves---paragraph-small-2">Состоит из</div>
                        <div class="waves-circle-blog-1"></div>
                        <div class="waves---paragraph-small-2">{test.questions} вопросов</div>
                    </div>
                </a>
            {/each}
        </div>
    </div>
</div>
