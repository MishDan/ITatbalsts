<?php
    session_start();  
    if(!isset($_SESSION['lietotajvardsDEB'])){
        header("Location: login.php");
        exit();
    }


    require "database/con_db.php";

    $last_7_records_query = $savienojums->prepare("SELECT vards, uzvards, DATE_FORMAT(datums, '%d.%m.%Y %H:%i') AS datums, status FROM IT_pieteikumi ORDER BY datums DESC LIMIT 7");
$last_7_records_query->execute();
$last_7_records = $last_7_records_query->get_result()->fetch_all(MYSQLI_ASSOC);

$count_last_24_hours_query = $savienojums->prepare("SELECT COUNT(*) AS count_last_24_hours FROM IT_pieteikumi WHERE datums >= NOW() - INTERVAL 1 DAY");
$count_last_24_hours_query->execute();
$count_last_24_hours = $count_last_24_hours_query->get_result()->fetch_assoc()['count_last_24_hours'];


$count_news_query = $savienojums->prepare("SELECT COUNT(*) AS count_news FROM IT_pieteikumi WHERE status = 'Atvērts'");
$count_news_query->execute();
$count_news = $count_news_query->get_result()->fetch_assoc()['count_news'];

$count_new_query = $savienojums->prepare("SELECT COUNT(*) AS count_new FROM IT_pieteikumi WHERE status = 'Jauns'");
$count_new_query->execute();
$count_new = $count_new_query->get_result()->fetch_assoc()['count_new'];

$count_pending_query = $savienojums->prepare("SELECT COUNT(*) AS count_pending FROM IT_pieteikumi WHERE status = 'Gaida'");
$count_pending_query->execute();
$count_pending = $count_pending_query->get_result()->fetch_assoc()['count_pending'];

$total_records_query = $savienojums->prepare("SELECT COUNT(*) AS total_records FROM IT_pieteikumi");
$total_records_query->execute();
$total_records = $total_records_query->get_result()->fetch_assoc()['total_records'];

$last_7_records_query->close();
$count_last_24_hours_query->close();
$count_new_query->close();
$count_pending_query->close();
$total_records_query->close();
$savienojums->close();

?>

<!DOCTYPE html>
<html lang="LV">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IT atbalsts - administrēšana sakums</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="shourtcut icon" href="../images/logo.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="script-admin.js" defer></script>

</head>

<body>

    <header>

        <a href="./" class="logo">
            <i class="fa fa-server"></i> IT atbalsts 
        </a>

        <div class="apply">
            <a href="index.php" class="btn">Sākums</a>
            <a href="pieteikumi.php" class="btn">Pieteikumi</a>
            <a href="./" class="btn">PRO īpašnieki</a>
            <?php
                if ($_SESSION['lomaDEB'] == 'admin') {
            ?>
                    <a href="lietotaji.php" class="btn">Lietotāji</a>
            <?php
                }
            ?>
            <a href="logout.php" class="btn"><i class="fas fa-power-off"></i></a>


        </div>


        
    </header>
    <body>
        


    <div class="dashboard">


        <div class="summary-cards">
            <div class="card cardadm">
                    <h2>Sveicināti, <?php echo $_SESSION['lietotajvardsDEB'];?>!</h2>
                    <p>Tava loma sistēmā: <?php echo $_SESSION['lomaDEB'];?> </p>
            </div>
        
            <div class="card">
              <i class="fa-solid fa-pen-to-square"></i>
              <div>
              <h3><?php echo $count_new;?></h3>
                <p>Jauni pieteikumi</p>
                </div>
            </div>
            <div class="card oval">
            <i class="fa-solid fa-chalkboard-user"></i>
            <div>
              <h3><?php echo $count_news;?></h3>
                <p>Atvērti pieteikumi</p>
                </div>
            </div>
            <div class="card">
            <i class="fa-solid fa-spinner"></i>
              <div>
              <h3><?php echo $count_pending;?></h3>
                <p>Gaida pieteikumi</p>
                </div>
            </div>
            <div class="card">
            <i class="fa-solid fa-bars"></i>
              <div>
              <h3><?php echo $total_records;?></h3>
                <p>Kopā pieteikumi</p>
                </div>
            </div>

            
        </div>

        <div class="tables">
            <!-- SELECT name, date, status FROM applications ORDER BY date DESC LIMIT 7 -->
            <div class="latest-applications">
                <div class="virsrakstsadmin">
                     <h3>JAUNĀKIE PIETEIKUMI</h3>
                </div>
                <table>
                    <thead>
                    <tr>
                            <th>Vārds, uzvārds</th>
                            <th>Datums</th>
                            <th>Statuss</th>
                    </tr>
                    </thead>
                      <tbody>
                    <?php foreach ($last_7_records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['vards']). " " . htmlspecialchars($record['uzvards']) ?></td>
                            <td><?php echo htmlspecialchars($record['datums']) ?></td>
                            <td><?php echo htmlspecialchars($record['status']) ?></td>
                            
                        </tr>
                        
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div><script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div class="application-stats">
            <div class="virsrakstsadmin">
                     <h3>PIETEIKUMU SKAITS</h3>
                </div>
                <div style="width:700px; margin: auto;">
             
        <canvas id="myChart"></canvas>
    <?php
require "database/con_db.php"; 


$query = "SELECT DATE_FORMAT(datums, '%d.%m.%Y ') AS date, COUNT(*) AS count 
          FROM IT_pieteikumi 
          WHERE datums >= CURDATE() - INTERVAL 7 DAY 
          GROUP BY DATE(datums)";
$result = $savienojums->query($query);

$dates = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $dates[] = $row['date'];
    $counts[] = $row['count'];
}

$dates = json_encode($dates);
$counts = json_encode($counts);
?>
 
    <script>
        // Получаем данные из PHP
        const dates = <?php echo $dates; ?>;
        const counts = <?php echo $counts; ?>;

        // Настройка графика
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Darbi', // Текст для подписей
                    data: counts,
                    backgroundColor: 'rgba(255, 45, 0, 0.5)', // Оранжевый цвет заливки
                    borderColor: 'rgba(255, 0, 0, 1)', // Цвет линии
                    borderWidth: 2.4,
                    pointBackgroundColor: 'rgba(255, 69, 0, 1)', // Цвет точек
                    pointBorderColor: 'rgba(255, 255,255, 1)', // Цвет бордюра точек
                    pointBorderWidth: 1,
                    pointRadius: 5,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4 // Плавность линии
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: Math.max(...counts) + 2,  // Устанавливаем максимальное значение на оси Y на 2 больше максимального значения данных

                        ticks: {
                            stepSize: 2,
                            font: {
                                size: 12
                            },
                            color: "#333"
                        },
                        grid: {
                            lineWidth: 2, // Толщина линий сетки
                            borderColor: 'rgba(0, 0, 0, 0.5)', // Цвет линии сетки на границе оси

                            color: 'rgba(200, 200, 200, 0.2)', // Лёгкие линии сетки
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: "#333"
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        titleColor: 'black',   // Устанавливаем черный цвет для заголовка
                        bodyColor: 'red',    // Устанавливаем черный цвет для текста тултипа
                        displayColors: false,  // Отключаем отображение цветного квадрата перед текстом

                        callbacks: {
                            title: function(tooltipItems) {
                                return tooltipItems[0].label;
                            },
                            label: function(tooltipItem) {
                                return `Darbi: ${tooltipItem.raw}`;
                            }
                        }
                    },
                    legend: {
                        display: false // Убираем легенду
                    }
                }
            }
        });
    </script>
                </div>
            </div>
        </div>
    </div>



    
    </body>