<script>
    import Header from '$src/components/header.svelte';
    import Footer from '$src/components/footer.svelte';
    import '$lib/css/main.css';
</script>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">
</head>
<img src="/media/6573e78831ad83e49c7df871_small-dark.svg" loading="lazy" alt="" class="bgmain">
<body class="body">
    <Header />
    <slot />
    <Footer />
</body>
