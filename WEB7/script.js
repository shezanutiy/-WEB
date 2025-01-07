let displayValue = '';

function updateDisplay() {
    document.getElementById('display').value = displayValue || '0';
}

function appendNumber(number) {
    displayValue += number;
    updateDisplay();
}

function appendOperator(operator) {
    if (displayValue && !isNaN(displayValue.slice(-1))) {
        displayValue += operator;
        updateDisplay();
    }
}

function clearAll() {
    displayValue = '';
    updateDisplay();
}

function clearEntry() {
    const lastOperatorIndex = displayValue.slice(0, -1).search(/[\+\-\*\/]/);
    displayValue = displayValue.substring(0, lastOperatorIndex + 1);
    updateDisplay();
}

function deleteLast() {
    displayValue = displayValue.slice(0, -1);
    updateDisplay();
}

function calculate() {
    try {
        if (displayValue.includes('/0')) {
            displayValue = 'Ошибка';
        } else {
            displayValue = eval(displayValue).toString();
        }
        updateDisplay();
    } catch {
        displayValue = 'Ошибка';
        updateDisplay();
    }
}

function toggleSign() {
    if (displayValue) {
        displayValue = displayValue.startsWith('-')
            ? displayValue.slice(1)
            : '-' + displayValue;
        updateDisplay();
    }
}

function calculateSqrt() {
    if (displayValue) {
        const num = parseFloat(displayValue);
        if (num < 0) {
            displayValue = 'Ошибка';
        } else {
            displayValue = Math.sqrt(num).toString();
        }
        updateDisplay();
    }
}

function calculateInverse() {
    if (displayValue) {
        const num = parseFloat(displayValue);
        if (num === 0) {
            displayValue = 'Ошибка';
        } else {
            displayValue = (1 / num).toString();
        }
        updateDisplay();
    }
}

function calculatePercentage() {
    if (displayValue) {
        displayValue = (parseFloat(displayValue) / 100).toString();
        updateDisplay();
    }
}

updateDisplay();

function appendNumber(number) {
    if (number === '.') {
        const lastNumber = displayValue.split(/[\+\-\*\/]/).pop();
        if (lastNumber.includes('.')) {
            return;
        }
    }
    displayValue += number;
    updateDisplay();
}

