function processArray() {
    const input = document.getElementById("numbersInput").value;
    const numbers = input.split(',').map(Number);

    if (numbers.some(isNaN)) {
        document.getElementById("result").textContent = "Ошибка: Введите только числа, разделенные запятыми.";
        return;
    }

    function isPalindrome(num) {
        const absInt = Math.abs(Math.trunc(num)).toString(); 
        return absInt === absInt.split('').reverse().join('');
    }

    const filteredArray = numbers.filter(num => !isPalindrome(num));

    document.getElementById("result").textContent = `Обработанный массив: [${filteredArray.join(', ')}]`;
}