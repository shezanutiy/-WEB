<!DOCTYPE html>
<html>
<head>
    <title>Календарь</title>
</head>
<body>
    <form method="get" style="text-align: center; margin-bottom: 20px;">
        <label for="month">Месяц:</label>
        <input type="number" id="month" name="month" min="1" max="12" required>

        <label for="year">Год:</label>
        <input type="number" id="year" name="year" min="1900" max="2100" required>

        <button type="submit">Показать календарь</button>
    </form>
</body>
</html>
<?php
function generateCalendar($month = null, $year = null, $holidays = []) {
    // Если месяц и год не заданы, берём текущие
    if ($month === null || $year === null) {
        $month = date('n');
        $year = date('Y');
    }

    // Названия дней недели и месяцев
    $daysOfWeek = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
    $months = [
        1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
    ];

    // Первое число месяца и количество дней
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $daysInMonth = date('t', $firstDayOfMonth);
    $startDay = date('N', $firstDayOfMonth); // Номер дня недели (1 = Пн, ..., 7 = Вс)

    echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: center;'>";
    echo "<caption style='font-size: 20px; margin: 10px;'>" . $months[$month] . " $year</caption>";

    // Заголовок таблицы с днями недели
    echo "<tr style='background-color: #f2f2f2;'>";
    foreach ($daysOfWeek as $day) {
        echo "<th style='padding: 5px;'>$day</th>";
    }
    echo "</tr>";

    // Заполняем таблицу днями
    $currentDay = 1;
    $isWeekStarted = false;

    echo "<tr>";

    // Пустые ячейки перед первым днем месяца
    for ($i = 1; $i < $startDay; $i++) {
        echo "<td></td>";
    }

    while ($currentDay <= $daysInMonth) {
        // Если неделя закончилась, начинаем новую строку
        if (($startDay % 7 == 1) && $isWeekStarted) {
            echo "</tr><tr>";
        }

        $isWeekStarted = true;

        // Определяем стиль для выходных и праздников
        $currentDate = sprintf('%04d-%02d-%02d', $year, $month, $currentDay);
        $isHoliday = in_array($currentDate, $holidays);
        $dayOfWeek = date('N', strtotime($currentDate));

        $style = "padding: 5px;";
        if ($dayOfWeek == 6 || $dayOfWeek == 7) {
            $style .= " background-color: #ffcccc;"; // Выходные
        }
        if ($isHoliday) {
            $style .= " background-color: #ffcc66;"; // Праздники
        }

        echo "<td style='$style'>$currentDay</td>";

        $currentDay++;
        $startDay++;
    }

    // Пустые ячейки после последнего дня месяца
    while ($startDay % 7 != 1) {
        echo "<td></td>";
        $startDay++;
    }

    echo "</tr>";
    echo "</table>";
}

// Получение месяца и года от пользователя
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $month = isset($_GET['month']) ? (int)$_GET['month'] : null;
    $year = isset($_GET['year']) ? (int)$_GET['year'] : null;

    // Пример списка праздников
    $holidays = ['2023-12-31', '2024-01-01'];

    generateCalendar($month, $year, $holidays);
}
?>
