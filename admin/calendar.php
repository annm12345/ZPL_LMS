<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Event</title>
    <link rel="stylesheet" href="assets/css/calendar.css">
    <link rel="stylesheet" href="assets/css/evo-calendar.midnight-blue.min.css">
    <link rel="stylesheet" href="assets/css/evo-calendar.min.css">
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Roboto+Mono:ital,wght@0,200;0,300;0,400;1,200&family=Roboto:wght@300;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="hero">
        
        <div id="calendar"></div>
         

    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/evo-calendar.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#calendar').evoCalendar({
                calendarEvents:[
                    {
                        id:'event1',
                        name:'first Lesson',
                        badge:'1-day lesson',
                        date:'July/16/2023',
                        description:'this is my first lesson ',
                        type:'active',
                    
                    },
                    {
                        id:'event2',
                        name:'Second Lesson',
                        badge:'1-day lesson',
                        date:'07/17/2023 09:52 AM',
                        description:'this is my second lesson ',
                        type:'begineer',
                    
                    }
                ] 
            })
        })
    </script>
    
</body>
</html>