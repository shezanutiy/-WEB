document.getElementById('ticketForm').addEventListener('submit', function (event) {
    event.preventDefault(); 

    document.querySelectorAll('.error').forEach(error => error.textContent = '');

    const fullName = document.getElementById('full-name');
    const id = document.getElementById('id');
    const email = document.getElementById('email');
    const birthDate = document.getElementById('birth-date');
    const departureCity = document.getElementById('departure-city');
    const destinationCity = document.getElementById('destination-city');

    let isValid = true;

    if (!fullName.value.trim()) {
        document.getElementById('full-name').textContent = 'ФИО обязательно.';
        isValid = false;
    }

    if (!/^\d{4}\s?\d{6}$/.test(id.value.trim())) {
        document.getElementById('id-error').textContent = 'Введите серию и номер паспорта (4 цифры + 6 цифр).';
        isValid = false;
    }

    if (!email.value.trim() || !/\S+@\S+\.\S+/.test(email.value)) {
        document.getElementById('email-error').textContent = 'Введите корректный email.';
        isValid = false;
    }

    if (!birthDate.value) {
        document.getElementById('birth-date-error').textContent = 'Дата рождения обязательна.';
        isValid = false;
    }

    if (!departureCity.value.trim()) {
        document.getElementById('departure-city-error').textContent = 'Город вылета обязателен.';
        isValid = false;
    }

    if (!destinationCity.value.trim()) {
        document.getElementById('destination-city-error').textContent = 'Город прибытия обязателен.';
        isValid = false;
    }

    if (!isValid) return;

    if (isValid) {
        const output = document.getElementById('output');
        output.innerHTML = `
            <h2>Данные успешно отправлены</h2>
            <p><strong>ФИО:</strong> ${fullName.value}</p>
            <p><strong>Серия и номер паспорта:</strong> ${id.value}</p>
            <p><strong>Email:</strong> ${email.value}</p>
            <p><strong>Дата рождения:</strong> ${birthDate.value}</p>
            <p><strong>Город вылета:</strong> ${departureCity.value}</p>
            <p><strong>Город прибытия:</strong> ${destinationCity.value}</p>
        `;
        output.classList.remove('hidden');
        document.getElementById('ticketForm').reset(); 
    }
    
    document.getElementById('ticketForm').reset();
});
