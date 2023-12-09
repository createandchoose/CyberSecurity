<script>
    import {goto} from "$app/navigation";

    let login = "";
    let password = "";
    const apiUrl = import.meta.env.VITE_API_URL;
    async function submit(event) {
        event.preventDefault();
        let data = {
            login: login,
            password: password,
        }
        const response = await fetch(apiUrl + "/auth/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        if (!response.ok) {
            alert("Неверный логин или пароль!")
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
                <form on:submit={submit} id="email-form-2" name="email-form-2" data-name="Email Form 2" class="form-2">
                    <h2 class="logdf1">Войти в аккунт</h2>
                    <label for="name-2">Логин</label>
                    <input bind:value={login} type="text" class="text-field w-input" maxlength="256" name="name-2" data-name="Name 2" placeholder="" id="name-2">
                    <label for="email-2">Пароль</label>
                    <input bind:value={password} type="password" class="text-field w-input" maxlength="256" name="email-2" data-name="Email 2" placeholder="" id="email-2" required="">
                    <button type="submit" class="dsfsdes w-button">Войти</button>
                </form>
                <p class="reggss">Нет аккаунта? <a class="asjs4" href="/auth/register"><span>Регистрация</span></a></p>
            </div>
        </div>
    </div>
</div>
