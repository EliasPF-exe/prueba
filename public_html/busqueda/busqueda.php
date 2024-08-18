<?php
    include_once "php/utilescarrito.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barra de Búsqueda con AJAX</title>
<link rel="stylesheet" href="../main/css/estilo.css">
<script src="js/ajax.js"></script>
</head>
<body>

<h1>Barra de Búsqueda</h1>

<input type="text" id="search" placeholder="Buscar productos...">
<div id="search-results"></div>

<script>
$(document).ready(function(){
    $('#search').keyup(function(){
        var query = $(this).val();
        if(query != ''){
            $.ajax({
                url: 'php/utilescarrito.php',
                method: 'POST',
                data: {query:query},
                success: function(data){
                    $('#search-results').html(data);
                }
            });
        }
    });
});
</script>

</body>
</html>