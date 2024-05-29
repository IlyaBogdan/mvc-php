const login = async (email, password) => {
    return fetch('/login', {
        method: 'POST',
        body: JSON.stringify({email, password}),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
}

const form = document.querySelector('#login-form');
form.addEventListener('submit', (e) => {
    e.preventDefault();
    const data = collectDataFromForm('login-form');
    const { email, password } = data;
    login(email, password)
        .then(response => window.location.href = response.redirect);

})