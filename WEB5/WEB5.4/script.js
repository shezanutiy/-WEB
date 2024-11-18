function findRepeatingCharacters() {
    const input = document.getElementById("stringInput").value;
    const charCount = {};
    const repeatedChars = [];

    for (const char of input) {
        if (char !== ' ') {
            charCount[char] = (charCount[char] || 0) + 1;
        }
    }

    for (const char in charCount) {
        if (charCount[char] > 1) {
            repeatedChars.push(char);
        }
    }

    const resultDiv = document.getElementById("result");
    if (repeatedChars.length > 0) {
        resultDiv.textContent = `Повторяющиеся символы: ${repeatedChars.join(', ')}`;
    } else {
        resultDiv.textContent = "Повторяющихся символов нет.";
    }
}
