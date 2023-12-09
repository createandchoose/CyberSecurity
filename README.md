# Установка и запуск

### Запуск API development
#### - Конфигурация .env
- Скопировать файл .env.example в .env и указать там данные для бд
  ```dotenv
  DB_CONNECTION=pgsql
  DB_HOST=127.0.0.1
  DB_PORT=5432
  DB_DATABASE=main
  DB_USERNAME=postgres
  DB_PASSWORD=password
  ```
#### - Запуск
```bash
composer install
```
```bash
php artisan key:generate
```
```bash
php artisan migrate:fresh --seed
```
```bash
php artisan serve
```

### Запуск Frontend

#### Конфигурация .env
- Создать файл .env в папке /front/.env и указать путь к API
``
VITE_API_URL=http://localhost:8000/api
``

```bash
npm install
```
```bash
npm run dev
```

## Запуск на сервере
#### Настройка nginx
- Можете настроить nginx config под себя в файле nginx/default.conf
```apacheconf
server {
  listen 80;

  error_log  /var/log/nginx/error.log;
  access_log /var/log/nginx/access.log;

  location / {
  proxy_pass http://front:4321;
  proxy_set_header Host $host;
  proxy_set_header X-Real-IP $remote_addr;
  proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
  proxy_set_header X-Forwarded-Proto $scheme;
  }
} 
```
- Запуск
```bash
docker compose up -d --build
```

# Важные части кода

- В этом проекте использовано как можно больше разных видов реляций между моделями
```php
public function question(): BelongsTo
{
    return $this->belongsTo(Question::class, "question_id", "id");
}
public function pass_tests(): HasMany
{
    return $this->hasMany(PassTest::class, "user_id", "id");
}

public function pass_courses(): BelongsToMany
{
    return $this->belongsToMany(Course::class, "pass_courses", "user_id", "course_id");
}
public function answers(): HasManyThrough
{
    return $this->hasManyThrough(Answer::class, Question::class, "test_id", "question_id", "id", "id");
}
```
- Код полностью удовлетворяет требованиям `ООП`, `SOLID`, `KISS`, `DRY`, `YAGNI` <br>
``Архитектура выглядит таким образом routes -> controllers -> services``
- Нормализована архитектура базы данных <br>
``База данных выполнена по стандартам нормализации базы данных``
- Использовалась админ панель Laravel Nova
- В докерной версии сервера используется php сервер swoole  <br>
``для полной ассинхронности и JIT компиляции что улучшает быстроту работы API``
- Конфиг `nginx` находится в самом проекте что улучшает компактность проекта
- Для развертывания проекта используется `docker-compose.yml` файл
- Так же используется стандарт `ACID`, все не однополосные запросы выполняются через транзакцию и блокировку бд
```php
DB::transaction(function() use($r, $u) {
    $p_t = new PassTest();
    $p_t->user_id = $u->id;
    $p_t->test_id = $r['test_id'];
    $p_t->save();
    foreach($r['answers'] as $answer) {
        $q_p_t = new QuestionPassTest();
        $q_p_t->is_right = $this->is_right($answer['id']);
        $q_p_t->question_id = $answer['question_id'];
        $q_p_t->pass_tests_id = $p_t->id;
        $q_p_t->save();
    }
    $t = Test::find($r['test_id']);
    $u->points = $u->points + $t->points;
    $u->save();
    return $p_t->id;
});
```
