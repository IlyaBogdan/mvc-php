const register = async (email, password) => {
    return fetch('/register', {
        method: 'POST',
        body: JSON.stringify({email, password}),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
}

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
}

const validateData = (data) => {
    const email = validateEmail(data.email);
    return !!email && !!data.password && data.password == data.password_repeat;
}

const form = document.querySelector('#register-form');
form.addEventListener('submit', (e) => {
    e.preventDefault();
    const data = collectDataFromForm('register-form');
    if (validateData(data)) {
        const { email, password } = data;
        register(email, password)
            .then(response => window.location.href = response.redirect);
    } 
})