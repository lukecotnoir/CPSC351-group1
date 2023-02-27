<?php
// Get the month and year from the query string, or use the current month and year if not set
if (isset($_GET['month'])) {
    $currentMonth = intval($_GET['month']);
} else {
    $currentMonth = intval(date('m'));
}
if (isset($_GET['year'])) {
    $currentYear = intval($_GET['year']);
} else {
    $currentYear = intval(date('Y'));
}

// Get the number of days in the current month
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

// Get the first day of the current month
$firstDay = date('N', strtotime("$currentYear-$currentMonth-01"));

// Calculate the total number of cells needed to display the month
$totalCells = $daysInMonth + $firstDay - 1;
if ($totalCells % 7 != 0) {
    $totalCells += 7 - $totalCells % 7;
}

// Calculate the number of rows needed to display the month
$numRows = $totalCells / 7;

// Define an array to hold the names of the months
$months = array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

// Output the HTML for the calendar
echo '<table>';
echo '<caption>' . $months[$currentMonth] . ' ' . $currentYear . '</caption>';
echo '<tr>';
echo '<th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>';
echo '</tr>';

// Output the cells for the days of the month
$day = 1;
for ($i = 1; $i <= $numRows; $i++) {
    echo '<tr>';
    for ($j = 1; $j <= 7; $j++) {
        if ($i == 1 && $j < $firstDay || $day > $daysInMonth) {
            echo '<td></td>';
        } else {
            echo '<td>' . $day . '</td>';
            $day++;
        }
    }
    echo '</tr>';
}

echo '</table>';

// Output links to go to the previous and next months
$prevMonth = $currentMonth - 1;
$prevYear = $currentYear;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}
$nextMonth = $currentMonth + 1;
$nextYear = $currentYear;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}
echo '<p><a href="?month=' . $prevMonth . '&year=' . $prevYear . '">Previous Month</a> | <a href="?month=' . $nextMonth . '&year=' . $nextYear . '">Next Month</a></p>';
?>