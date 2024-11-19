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
        displayValue = eval(displayValue).toString();
        updateDisplay();
    } catch {
        displayValue = 'Error';
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
        displayValue = Math.sqrt(parseFloat(displayValue)).toString();
        updateDisplay();
    }
}

function calculateInverse() {
    if (displayValue) {
        displayValue = (1 / parseFloat(displayValue)).toString();
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
