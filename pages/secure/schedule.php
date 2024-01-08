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
    <style>
        #calendar {
            max-width: 1000px;
            max-height: 700px;
            margin: 0 auto;
            background-color: white; 
            border-radius: 8px; 
            padding: 10px; 
            margin-top: 50px;
        }
        body {
           
            background: url('/SIR-TP1/pages/assets/back.png') no-repeat center center fixed;
            background-size: cover;
          
        }
        #logo {
            width: 75px;
            position: absolute;
            top: 10px;
            left: 10px;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }
    </style>
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
    <a href="/SIR-TP1/pages/secure/index.php">
        <img id="logo" src="../../pages/assets/image.png" alt="Logo">
            </a>
  </body>
</html>
