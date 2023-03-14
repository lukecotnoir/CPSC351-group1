
<!DOCTYPE html>
<html>
<head>
    <title>Calendar</title>
    <link href="public_html/css/home-styling.css" rel="stylesheet">
</head>
<body>
    <?php include_once('event_calendar.php'); ?>
    <div>
        <?php
        // Define variables for the previous and next months
        $prevMonth = $currentMonth - 1;
        $prevYear = $currentYear;
        if ($prevMonth == 0) {
            $prevMonth = 12;
            $prevYear--;
        }
        $nextMonth = $currentMonth + 1;
        $nextYear = $currentYear;
        if ($nextMonth == 13) {
            $nextMonth = 1;
            $nextYear++;
        }
        ?>
    </div>
</body>
</html>