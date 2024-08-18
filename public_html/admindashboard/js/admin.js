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