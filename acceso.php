<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Despierta Tu Espíritu 365 · Versión Didáctica</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background: #141e30; }
  .barra {
    background: rgba(20,30,50,0.95);
    border-bottom: 1px solid rgba(201,168,76,0.2);
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: 'Lato', sans-serif;
  }
  .barra-nombre {
    color: rgba(255,255,255,0.5);
    font-size: 0.8rem;
    letter-spacing: 0.05em;
  }
  .barra-nombre span { color: #c9a84c; }
  .btn-salir {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.4);
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 0.75rem;
    cursor: pointer;
    text-decoration: none;
    letter-spacing: 0.05em;
    transition: all 0.2s;
  }
  .btn-salir:hover {
    border-color: rgba(201,168,76,0.3);
    color: #c9a84c;
  }
  iframe {
    width: 100%;
    height: calc(100vh - 46px);
    border: none;
    display: block;
  }
</style>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
<div class="barra">
  <span class="barra-nombre">✦ Despierta Tu Espíritu · <span>Versión Didáctica</span></span>
  <a href="salir.php" class="btn-salir">Cerrar sesión</a>
</div>
<iframe src="index.html" title="Despierta Tu Espíritu 365 Versión Didáctica"></iframe>
</body>
</html>
