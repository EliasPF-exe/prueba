<?php
    include_once "php/getid.php";
    include_once "php/countprd.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Modo Oscuro</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
    <body>
        
        <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
        

        <div class="sidebar">
            <br>
            <br>
            <br>
            <h2>El Progreso Deportes</h2>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="../productos/">Productos</a></li>
                <li><a href="#">Pedidos</a></li>
                <li><a href="#">Proveedores</a></li>
                <li><a href="#">Usuarios</a></li>
                <li><a href="#">Configuración</a></li>
            </ul>
        </div>
        <div class="main-content">
            <header>
                <h1>Panel de Administración</h1>
            </header>
            <section>
                <h2>Resumen Rápido</h2>
                <div class="cards">
                    <div class="card">
                        <h3>Total Productos</h3>
                        <p>
                            <?php 
                                $max_id = obtener_max_id('producto');
                                if ($max_id !== null) {
                                    echo $max_id;
                                } else {
                                    echo "0";
                                }
                            ?>
                        </p>

                    </div>
                    <div class="card">
                        <h3>Total Pedidos</h3>
                        <p>
                            <?php 
                                $max_id = obtener_max_id('pedido');
                                if ($max_id !== null) {
                                    echo $max_id;
                                } else {
                                    echo "0";
                                }
                            ?>
                        </p>

                    </div>
                    <div class="card">
                        <h3>Total Proveedores</h3>
                        <p>
                            <?php 
                                $max_id = obtener_max_id('proveedores');
                                if ($max_id !== null) {
                                    echo $max_id;
                                } else {
                                    echo "0";
                                }
                            ?>
                        </p>


                    </div>
                    <div class="card">
                        <h3>Total Usuarios</h3>
                        <p>
                            <?php 
                                $max_id = obtener_max_id('usuario');
                                if ($max_id !== null) {
                                    echo $max_id;
                                } else {
                                    echo "0";
                                }
                            ?>
                        </p>

                    </div>
                </div>
            </section>

            <section>
                <h2>Productos Totales</h2>
                <canvas id="productChart" width="400" height="400"></canvas>
                <h2>Ventas Mensuales</h2>
                <canvas id="ventasChart" width="400" height="200"></canvas>
            </section>
        </div>

        <script>
            fetch('php/countprd.php')
                .then(data=base())
                .then(data => {
                    const ctx = document.getElementById('productChart').getContext('2d');
                    const productChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['producto1,producto2,producto3,producto4'],
                            datasets: [{
                                label: 'Producto',
                                data: [data.total],
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        </script>
        
        <script>
            function toggleSidebar(){
                const sidebar = document.querySelector('.sidebar');
                sidebar.classList.toggle('collapsed');

                const sidebarToggle = document.querySelector('.sidebar-toggle');
                sidebarToggle.classList.toggle('rotated');

                if (sidebar.classList.contains('collapsed')) {
                    sidebarToggle.style.borderRadius = '50%'; // Aplicar bordes redondos cuando la barra está colapsada
                } else{
                    sidebarToggle.style.borderRadius = '0'; // Quitar los bordes redondos cuando la barra se expande
                }
                void sidebarToggle.offsetWidth;
            }
            
            const sidebarToggle = document.querySelector('.sidebar-toggle');

            sidebarToggle.addEventListener('transitionend', () => {
            sidebarToggle.style.borderRadius = '';
            });


        </script>

            

        <script>
            const ctx = document.getElementById('ventasChart').getContext('2d');
            const ventasChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    datasets: [{
                        label: 'Ventas Mensuales',
                        data: [30, 45, 60, 50, 70, 65, 80, 90, 85, 75, 95, 100],
                        borderColor: 'cyan', 
                        backgroundColor: 'rgba(0, 255, 255, 0.2)',
                        borderWidth: 2,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>
</html>
