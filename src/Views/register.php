<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/css/form.css">
</head>
<body>
    <div class="container">
        <form class="form" action="/register" method="POST">
            <div class="form__title">Register</div>

            <div class="form__fields">
                <div class="form__fields-field">
                    <label for="email">Email</label>
                    <input name="email" type="text">
                </div>
                <div class="form__fields-field">
                    <label for="password">Password</label>
                    <input name="password" type="password">
                </div>
                <div class="form__fields-field">
                    <label for="password_repeat">Repeat password</label>
                    <input name="password_repeat" type="password">
                </div>
            </div>

            <button class="form__submit">Submit</button>
        </form>
    </div>
</body>
</html>