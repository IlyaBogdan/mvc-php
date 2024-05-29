const register = async (login, password) => {
    return fetch('/register', {
        method: 'POST',
        body: JSON.stringify({login, password})
    }).then(response => response.json())
}

const validateData = (data) => {
    return data.password == data.password_repeat;
}

const form = document.querySelector('#register-form');
form.addEventListener('submit', (e) => {
    e.preventDefault();
    const data = collectDataFromForm('register-form');
    console.log(data);
    if (validateData(data)) {
        const { login, password } = data;
        register(login, password)
            .then(response => window.location.href = response.redirect);
    } 
})