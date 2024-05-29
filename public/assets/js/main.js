const collectDataFromForm = (formId) => {
    const form = document.getElementById(formId);
    const inputs = form.getElementsByTagName('input');
    console.log(inputs);
    let data = {};
    for (const input of inputs) data[input.name] = input.value;

    return data;
}

const logout = () => {
    return fetch('/logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
      .then(response => window.location.href = response.redirect);
}