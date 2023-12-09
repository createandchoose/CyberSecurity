<script>
    import {onMount} from "svelte";
    const apiUrl = import.meta.env.VITE_API_URL;
    let courses = [];

    onMount(async () => {
        let response = await fetch(apiUrl + '/courses/get', {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
        response = await response.json()
        $: courses = response.data
    });
</script>
<div class="container">
    <img src="media/6573e78831ad83e49c7df871_small-dark.svg" loading="lazy" alt="" class="bgmain">
    <div data-w-id="23ba5c3a-c67b-cfd5-33a0-573fea3de338" class="waves---section-hero-primary">
        <div class="waves---main-container w-container">
            <h1 class="waves---mega-heading-1"><strong class="bold-text">Платформа для изучения<br>кибербезопасности</strong></h1>
            <div class="waves-divider-hero-4"></div>
            <div class="waves-bottom-hero-3">
                <div class="lelsss">Сегодня нужен эффективный подход к защите от киберугроз, и результатом должна стать высокая устойчивость инфроструктуры к кибератакам.</div>
                <div class="waves-bottom-right-hero-3">
                    <div class="waves---mg-top-32"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="waves---section-hero-primary"></div>
    <div class="waves---section-hero-primary-2">
        <div class="waves---main-container-5 w-container">
            <div class="waves-title-wrap-hero-2">
                <div class="div-block-4">
                    <div class="div-block-3"></div>
                    <div class="waves---paragraph-regular">о проекте</div>
                </div>
                <div class="waves-limit-1008">
                    <h1 class="waves---mega-heading-2">Объединяем людей по кибербезопасности</h1>
                </div>
                <div class="waves---limit-480">
                    <div class="waves---subtitle-3">Качественный результат невозможен без отраслевой экспертизы, свежих идей и альтернативных мнений.</div>
                </div>
                <div class="waves---mg-top-33"><a href="/profile" class="waves---cta-dark-5 wide-cta w-button">Войти</a></div>
            </div>
        </div>
    </div>
    <div class="waves---section-medium">
        <div class="waves---main-container-2 w-container">
            <div class="waves---sides-heading-button">
                <h2 class="waves---heading-2-no-margins">Курсы</h2><a href="/courses" class="waves---cta-dark-2 wide-cta w-button">Перейти к курсам</a></div>
            <div class="w-layout-grid waves-blog-grid-3">
                {#each courses as course}
                    <a id="w-node-b6dd43d7-6367-da60-3c58-6da0baa5eed3-e3da6cfe" href={`/courses/${course.id}`} class="waves-tile-blog-1 w-inline-block">
                        <div class="waves-image-wrap-blog-1"><img src="media/657427847d7f5fa4e94ac3b9_original-4a3132a5730605e8d3a8d6627116f65c.png" loading="lazy" sizes="(max-width: 767px) 93vw, (max-width: 991px) 480.0000305175781px, 1152px" srcset="media/657427847d7f5fa4e94ac3b9_original-4a3132a5730605e8d3a8d6627116f65c-p-500.png 500w, media/657427847d7f5fa4e94ac3b9_original-4a3132a5730605e8d3a8d6627116f65c.png 752w"
                                                                  alt="" class="waves-image-blog-1"></div>
                        <div class="waves-bottom-blog-1">
                            <h3 class="waves---heading-3-no-margins-3">{course.name}</h3>
                        </div>
                        <div class="waves-blog-details-1">
                            <div class="waves---paragraph-small-2">Состоит из</div>
                            <div class="waves-circle-blog-1"></div>
                            <div class="waves---paragraph-small-2">{course.chapters_count} разделов</div>
                        </div>
                    </a>
                {/each}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="waves---section-medium">
            <div class="waves---main-container-2 w-container">
                <div class="w-layout-grid waves---grid-halves-sticky">
                    <div id="w-node-a14398fd-9ec2-e6d4-df97-35092c1c5fc3-e3da6cfe" class="waves---sticky-halves-left">
                        <div class="waves---sticky-halves">
                            <div class="waves---content-sticky-features-2">
                                <h2 class="waves---heading-2-no-margins">4 раздела изучения кибербезопаности</h2>
                                <div class="waves---paragraph-big">Наша методология состоит из 4 разделов. Это инструменты и практики, внедрив которые вы будете уверены в защите своей IT-инфраструктуры.<br></div>
                                <div class="waves---mg-top-16"><a href="/" class="waves---cta-dark-2 w-button">Перейти к разделам</a></div>
                            </div>
                        </div>
                    </div>
                    <div id="w-node-a14398fd-9ec2-e6d4-df97-35092c1c5fce-e3da6cfe" class="waves---master-tiles-features-2">
                        <div class="w-layout-grid">
                            <div id="w-node-_7f2831c2-d3a1-1fc8-8ee6-bffb85c2b0dc-e3da6cfe" class="gffffdf">
                                <div class="columns-3 w-row">
                                    <div class="w-col w-col-6"><img src="media/6573250c3bdfac49f43d1d93_1.svg" loading="lazy" alt=""></div>
                                    <div class="column-3 w-col w-col-6"><img src="media/65732322d4dffbe5ecc1626b_link.svg" loading="lazy" alt="" class="sdfsde"></div>
                                </div>
                                <div id="w-node-_87593fcb-8c9a-3117-7459-442c8464d580-e3da6cfe" class="div-block-2">
                                    <div class="sdf4">Тесты</div>
                                </div>
                                <div class="text-block-2">Проходи тесты по кибербезопаности</div>
                            </div>
                            <div id="w-node-aa9b60bc-a6a2-6b17-9e79-43d8a26f52e8-e3da6cfe" class="gffffdf">
                                <div class="columns-3 w-row">
                                    <div class="w-col w-col-6"><img src="media/6573ec1f89478d61fa4e5a22_svg-gobbler-1.svg" loading="lazy" alt=""></div>
                                    <div class="column-3 w-col w-col-6"><img src="media/65732322d4dffbe5ecc1626b_link.svg" loading="lazy" alt="" class="sdfsde"></div>
                                </div>
                                <div id="w-node-aa9b60bc-a6a2-6b17-9e79-43d8a26f52ee-e3da6cfe" class="div-block-2">
                                    <div class="sdf4">Курсы</div>
                                </div>
                                <div class="text-block-2">Обучающие программы</div>
                            </div>
                            <div id="w-node-_0cb7206f-b95d-9310-bd61-7143e57b774d-e3da6cfe" class="gffffdf">
                                <div class="columns-3 w-row">
                                    <div class="w-col w-col-6"><img src="media/6573ec20d7d261a360a49e9d_svg-gobbler-3.svg" loading="lazy" alt=""></div>
                                    <div class="column-3 w-col w-col-6"><img src="media/65732322d4dffbe5ecc1626b_link.svg" loading="lazy" alt="" class="sdfsde"></div>
                                </div>
                                <div id="w-node-_0cb7206f-b95d-9310-bd61-7143e57b7753-e3da6cfe" class="div-block-2">
                                    <div class="sdf4">Задачи</div>
                                </div>
                                <div class="text-block-2">Решай задачи по кибербезопасности</div>
                            </div>
                            <div id="w-node-_9dbf7e33-ed89-60b1-a13e-fd65bb0a99c7-e3da6cfe" class="gffffdf">
                                <div class="columns-3 w-row">
                                    <div class="w-col w-col-6"><img src="media/6573ec207d7f5fa4e926907d_svg-gobbler-5.svg" loading="lazy" alt=""></div>
                                    <div class="column-3 w-col w-col-6"><img src="media/65732322d4dffbe5ecc1626b_link.svg" loading="lazy" alt="" class="sdfsde"></div>
                                </div>
                                <div id="w-node-_9dbf7e33-ed89-60b1-a13e-fd65bb0a99cd-e3da6cfe" class="div-block-2">
                                    <div class="sdf4">Глоссарий</div>
                                </div>
                                <div class="text-block-2">Словарь терминов</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
