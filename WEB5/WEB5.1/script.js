document.getElementById('orderForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const day = parseInt(document.getElementById('day').value); // День недели (1-7)
    const time = parseInt(document.getElementById('time').value); // Время заказа (0-23)
    const result = document.getElementById('result');

    if (day === 7) {
        result.textContent = "Компания не работает в воскресенье. Доставка будет в понедельник с 8.00 до 16.00.";
        return;
    }

    let deliveryDay = day;
    let deliveryTime = "c 8.00 до 16.00";

    if (time >= 8 && time < 16) {
        deliveryTime = "после 16.00";
    } else if (time >= 16) {
        deliveryDay = day === 6 ? 1 : day + 1; // Переход на следующий день или понедельник
    }

    const days = ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"];
    const deliveryDayName = days[deliveryDay - 1];

    result.textContent = `Ваш заказ будет доставлен: ${deliveryDayName},  ${deliveryTime}.`;
});
