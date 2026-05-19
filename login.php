<?php
session_start();

// Si ya está autenticado, ir directo a la herramienta
if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    header('Location: acceso.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $clave = trim($_POST['clave'] ?? '');

    // Cargar usuarios
    $usuarios = include 'usuarios.php';

    if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $clave) {
        $_SESSION['autenticado'] = true;
        $_SESSION['usuario'] = $usuario;
        header('Location: acceso.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos. Verifica tus datos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Acceso · Despierta Tu Espíritu 365</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --navy: #141e30;
    --navy2: #1a2a45;
    --gold: #c9a84c;
    --gold-light: #e2c06a;
    --teal: #2a9d8f;
    --cream: #f5f0e8;
    --white: #ffffff;
  }

  body {
    min-height: 100vh;
    background: linear-gradient(135deg, #0d1628 0%, #1a2a45 40%, #0f2035 70%, #1a1a2e 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Lato', sans-serif;
    position: relative;
    overflow: hidden;
  }

  /* Estrellas de fondo */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image:
      radial-gradient(1px 1px at 20% 30%, rgba(201,168,76,0.4) 0%, transparent 100%),
      radial-gradient(1px 1px at 80% 20%, rgba(255,255,255,0.3) 0%, transparent 100%),
      radial-gradient(1.5px 1.5px at 50% 70%, rgba(201,168,76,0.3) 0%, transparent 100%),
      radial-gradient(1px 1px at 10% 80%, rgba(255,255,255,0.2) 0%, transparent 100%),
      radial-gradient(1px 1px at 90% 60%, rgba(42,157,143,0.3) 0%, transparent 100%),
      radial-gradient(1px 1px at 35% 15%, rgba(255,255,255,0.25) 0%, transparent 100%),
      radial-gradient(1px 1px at 70% 85%, rgba(201,168,76,0.2) 0%, transparent 100%);
    pointer-events: none;
    z-index: 0;
  }

  /* Orbes de luz */
  body::after {
    content: '';
    position: fixed;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,168,76,0.06) 0%, transparent 70%);
    top: -100px;
    right: -100px;
    pointer-events: none;
    z-index: 0;
  }

  .orbe2 {
    position: fixed;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(42,157,143,0.08) 0%, transparent 70%);
    bottom: -80px;
    left: -80px;
    pointer-events: none;
    z-index: 0;
  }

  .contenedor {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 440px;
    padding: 20px;
    animation: aparecer 0.8s ease forwards;
  }

  @keyframes aparecer {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .tarjeta {
    background: rgba(20, 30, 50, 0.85);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(201,168,76,0.2);
    border-radius: 20px;
    padding: 50px 40px;
    box-shadow:
      0 30px 80px rgba(0,0,0,0.5),
      0 0 0 1px rgba(255,255,255,0.03) inset,
      0 1px 0 rgba(201,168,76,0.1) inset;
  }

  .logo-area {
    text-align: center;
    margin-bottom: 36px;
  }

  .icono {
    width: 64px;
    height: 64px;
    margin: 0 auto 16px;
    background: linear-gradient(135deg, rgba(201,168,76,0.15), rgba(201,168,76,0.05));
    border: 1px solid rgba(201,168,76,0.3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
  }

  .titulo {
    font-family: 'Playfair Display', serif;
    font-size: 1.7rem;
    font-weight: 700;
    color: var(--white);
    line-height: 1.2;
    letter-spacing: -0.02em;
  }

  .titulo span {
    color: var(--gold);
  }

  .subtitulo {
    margin-top: 8px;
    font-size: 0.82rem;
    color: rgba(255,255,255,0.45);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    font-weight: 300;
  }

  .divisor {
    width: 40px;
    height: 1px;
    background: linear-gradient(to right, transparent, var(--gold), transparent);
    margin: 20px auto 0;
  }

  .campo {
    margin-bottom: 18px;
  }

  .campo label {
    display: block;
    font-size: 0.75rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.5);
    margin-bottom: 8px;
    font-weight: 700;
  }

  .campo input {
    width: 100%;
    padding: 14px 18px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    color: var(--white);
    font-family: 'Lato', sans-serif;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    outline: none;
  }

  .campo input:focus {
    border-color: rgba(201,168,76,0.5);
    background: rgba(255,255,255,0.08);
    box-shadow: 0 0 0 3px rgba(201,168,76,0.08);
  }

  .campo input::placeholder {
    color: rgba(255,255,255,0.2);
  }

  .error {
    background: rgba(220, 60, 60, 0.12);
    border: 1px solid rgba(220, 60, 60, 0.3);
    border-radius: 10px;
    padding: 12px 16px;
    color: #ff8a8a;
    font-size: 0.85rem;
    margin-bottom: 18px;
    text-align: center;
  }

  .btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, var(--gold) 0%, #a8863a 100%);
    color: #1a1200;
    font-family: 'Lato', sans-serif;
    font-size: 0.9rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-top: 8px;
    box-shadow: 0 4px 20px rgba(201,168,76,0.25);
  }

  .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 30px rgba(201,168,76,0.4);
    background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 100%);
  }

  .btn:active {
    transform: translateY(0);
  }

  .pie {
    text-align: center;
    margin-top: 28px;
    font-size: 0.78rem;
    color: rgba(255,255,255,0.25);
    line-height: 1.6;
  }

  .pie strong {
    color: rgba(201,168,76,0.6);
    font-weight: 400;
  }

  @media (max-width: 480px) {
    .tarjeta { padding: 36px 24px; }
    .titulo { font-size: 1.4rem; }
  }
</style>
</head>
<body>
<div class="orbe2"></div>
<div class="contenedor">
  <div class="tarjeta">
    <div class="logo-area">
      <div class="icono">✦</div>
      <h1 class="titulo">Despierta Tu <span>Espíritu</span></h1>
      <p class="subtitulo">Devocional Interactivo · Versión Didáctica</p>
      <div class="divisor"></div>
    </div>

    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="campo">
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" placeholder="Tu usuario de acceso" autocomplete="username" required>
      </div>
      <div class="campo">
        <label for="clave">Contraseña</label>
        <input type="password" id="clave" name="clave" placeholder="Tu contraseña" autocomplete="current-password" required>
      </div>
      <button type="submit" class="btn">Ingresar →</button>
    </form>

    <div class="pie">
      ¿Problemas para acceder?<br>
      Escríbenos a <strong>WhatsApp</strong> y te ayudamos.
    </div>
  </div>
</div>
</body>
</html>
