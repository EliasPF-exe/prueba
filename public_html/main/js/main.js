function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');
    if (sidebar.style.width === '250px') {
        sidebar.style.width = '0';
    } else {
        sidebar.style.width = '250px';
    }
}

function closeSidebar() {
    document.getElementById('sidebar').style.width = '0';
    document.getElementById('sidebar').classList.remove('open');
}
function cargar_carrito(){
    
    //if (sessionStorage.getItem('username') === null) {
        window.location.href = '../../auth/index.php';
    //}

/*
    <?php if (!isset($_SESSION['username'])): ?><a href="../registro/">Registrarse</a>
        <a href="../auth/">Iniciar Sesión</a>
        
    <?php else: ?>
        <span>Cuenta <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="php/logout.php">Cerrar Sesión</a>
    <?php endif; ?>
*/

}