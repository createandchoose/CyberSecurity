<script>
    import {page} from "$app/stores";
    import {onMount} from "svelte";
    import { marked } from 'marked'
    import {goto} from "$app/navigation";
    const apiUrl = import.meta.env.VITE_API_URL;
    let token = "";
    let course = "";
    let markdownElement;
    let currentChapterIndex = 0;
    $: courseId = $page.params.id;
    if(typeof window !== 'undefined') {
        $: token = localStorage.getItem('token');
    }
    onMount(async () => {
        if(token == null) {
            goto('/auth/login')
        }
        let response = await fetch(apiUrl + '/courses/course?course_id=' + courseId, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        });
        let data = await response.json();
        course = data.data;
    });

    $: {
        if (course && markdownElement) {
            markdownElement.innerHTML = marked.parse(course.chapters[currentChapterIndex].markdown || '');
        }
    }

    function handleChapterSelection(index) {
        currentChapterIndex = index;
    }
    async function handleCourseCompletion() {
        let data = {
            "course_id": courseId
        }
        const response = await fetch(apiUrl + "/courses/pass", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + token
            },
            body: JSON.stringify(data)
        })
        if (!response.ok) {
            alert("Произошла ошибка!")
        } else {
            goto('/profile')
        }
    }
</script>
<div class="container">
    {#if course}
        <div class="waves---section-medium-4">
            <div class="waves---main-container-5 w-container">
                <div class="waves---sides-heading-button-3">
                    <h2 class="waves---heading-2-no-margins-3">Курс "{course.name}"</h2>
                </div>
                <div class="w-layout-grid waves-grid-blog-4">
                    <div class="w-row">
                        <div class="w-col w-col-6">
                            {#each course.chapters as chapter, index}
                                <div style="cursor: pointer" on:click={() => handleChapterSelection(index)} class="sdfsde42">
                                    <div class="lel">{chapter.name}</div>
                                </div>
                            {/each}
                        </div>
                        <div class="w-col w-col-6" style="color:white">
                            <div bind:this={markdownElement}></div>
                        </div>
                    </div>
                </div>

                {#if currentChapterIndex === course.chapters.length - 1}
                    <button class="dsfsdes w-button" on:click={handleCourseCompletion}>Завершить курс</button>
                {/if}
            </div>
        </div>
    {/if}
</div>
