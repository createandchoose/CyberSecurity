<script>
    import {goto} from "$app/navigation";

    let login = "";
    let password = "";
    const apiUrl = import.meta.env.VITE_API_URL;

    async function submit(event) {
        event.preventDefault()
        let data = {
            login: login,
            password: password,
        }
        const response = await fetch(apiUrl + "/auth/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        if (!response.ok) {
            alert("Произошла ошибка!")
        } else {
            const responseData = await response.json();
            let token = responseData.data;
            localStorage.setItem("token", token);
            goto('/profile')
        }
    }
</script>
<div class="waves---section-medium-4">
    <div class="waves---main-container-5 w-container">
        <div class="w-layout-grid lfdg3">
            <div class="form-block w-form">
                <form on:submit={submit} id="email-form-2" name="email-form-2" class="form-2">
                    <h2 class="logdf1">Регистрация аккунта</h2>
                    <label for="name">Логин</label>
                    <input bind:value={login} type="text" class="text-field w-input" maxlength="256" name="name" data-name="Name"
                           placeholder="" id="name">
                    <label for="email">Пароль</label>
                    <input bind:value={password} type="password" class="text-field w-input" maxlength="256" name="email" data-name="Email" placeholder="" id="email" required="">
                    <button type="submit" class="dsfsdes w-button">Зарегистрироваться</button>
                </form>
                <p class="reggss">Есть аккаунт? <a class="asjs4" href="/auth/login"><span>Вход</span></a></p>
            </div>
        </div>
    </div>
</div>
