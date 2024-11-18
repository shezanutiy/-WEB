function processArray() {
    const input = document.getElementById("numbersInput").value;
    const numbers = input.split(',').map(Number); 

    if (numbers.some(isNaN)) {
        document.getElementById("result").textContent = "Ошибка: Введите только числа, разделенные запятыми.";
        return;
    }

    let product = 1;
    let lastIndex = -1;

    for (let i = 0; i < numbers.length; i++) {
        if (Math.cos(numbers[i]) > 0) {
            lastIndex = i;
        }
    }

    if (lastIndex === -1) {
        document.getElementById("result").textContent = "Произведение: 0";
        return;
    }

    for (let i = 0; i <= lastIndex; i++) {
        product *= numbers[i];
    }

    document.getElementById("result").textContent = `Произведение элементов: ${product}`;
}
