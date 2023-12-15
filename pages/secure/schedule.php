<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../helpers/session.php';
require_once __DIR__ . '/../../controllers/content/content.php';

$user = user();
$userId = $user['id']; 
$contents = getContentByUserId($userId);


$events = [];
foreach ($contents as $content) {
    $events[] = [
        'title' => $content['title'],
        'start' => $content['end_date'],
        'end' => $content['end_date'],
    ];
}

?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: <?php echo json_encode($events); ?>,
        });
        calendar.render();
      });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>
