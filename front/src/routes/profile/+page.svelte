<script>
    import {onMount} from "svelte";
    import {goto} from "$app/navigation";
    let token = '';
    let user = "";
    const apiUrl = import.meta.env.VITE_API_URL;

    if(typeof window !== 'undefined') {
        $: token = localStorage.getItem('token');
    }
    onMount(async () => {
        if(token == null) {
            goto('/auth/login')
        }
        let response = await fetch(apiUrl + '/user', {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + token
            },
        })
        response = await response.json()
        $: user = response
    });

    async function logout(event) {
        event.preventDefault()
        localStorage.removeItem('token')
        goto('/auth/login')
    }
</script>
<div class="container">
    <div class="waves---section-medium-4">
        <div class="waves---main-container-5 w-container">
            <div class="waves---sides-heading-button-3">
                <h2 class="waves---heading-2-no-margins-3">Профиль</h2>
            </div>

            {#if user}
            <div class="w-layout-grid waves-grid-blog-4">
                <div class="w-row">
                    <div class="w-col w-col-6">
                        <div class="dsf43">
                            <div class="krp4">
                                <img src="/media/65741391b33e1d97570518c9_bx-user.svg.svg" loading="lazy" alt="" class="sdfsd4"></div>
                            <h3 class="waves---heading-3-no-margins-7">{user.login}</h3>
                        </div>
                        <h2 class="dsf3">{user.rank}</h2>
                        <a on:click={logout} href="#" class="dsfsd w-button">Выйти из аккаунта</a></div>
                    <div class="w-col w-col-6">
                        <div class="dfg543 w-row">
                            <div class="w-col w-col-6">
                                <h1 class="dsf3">Пройдено тестов</h1>
                            </div>
                        </div>
                        {#if user.pass_tests.length > 0}
                            {#each user.pass_tests as pass_test}
                            <a href="#" class="kfdg43 w-inline-block">
                                <div class="waves-content-blog-4">
                                    <h3 class="waves---heading-3-no-margins-7">{pass_test.test.name}</h3>
                                    <div class="waves---paragraph-big-3">Пройдено {pass_test.right_answers} из {pass_test.test.questions}</div>
                                </div>
                            </a>
                            {/each}
                        {:else}
                            <div class="sdfsde4 w-inline-block">
                                <div class="waves-content-blog-4">
                                    <div class="lel">Нет пройденных тестов</div>
                                </div>
                            </div>
                        {/if}
                        <div class="dfg543 w-row">
                            <div class="w-col w-col-6">
                                <h1 class="dsf3">Пройдено курсов</h1>
                            </div>
                        </div>
                        {#if user.pass_courses.length > 0}
                            {#each user.pass_courses as pass_course}
                                <a href="#" class="kfdg43 w-inline-block">
                                    <div class="waves-content-blog-4">
                                        <h3 class="waves---heading-3-no-margins-7">{pass_course.name}</h3>
                                        <div class="waves---paragraph-big-3">Пройдено {pass_course.chapters_count} из {pass_course.chapters_count}</div>
                                    </div>
                                </a>
                            {/each}
                        {:else}
                            <div class="sdfsde4 w-inline-block">
                                <div class="waves-content-blog-4">
                                    <div class="lel">Нет пройденных курсов</div>
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>
            </div>
            {/if}
        </div>
    </div>

</div>
