# -AA-_Parcial_PLP3-

DESARROLLO

Desafío 1 - Arquitectura de la Web 
Componentes principales

Cliente (navegador): HTML/CSS/JS, hace pedidos HTTP/HTTPS.


Servidor web: Apache/Nginx, recibe la solicitud y la deriva al runtime.


Servidor de aplicación: PHP (u otro), ejecuta la lógica.


Base de datos: MySQL/PostgreSQL, guarda datos.


CDN (opcional): sirve imágenes/estáticos más rápido.


Capa de caché (opcional): Opcache/Redis.


Servicios externos (APIs): mail, pagos, etc.


 Flujo de comunicación (paso a paso)

Usuario escribe la URL → DNS resuelve el dominio.


El navegador abre HTTPS (TLS) con el servidor web.


El servidor web pasa la petición /index.php al motor PHP.


PHP ejecuta lógica y consulta SQL a la BD.


PHP arma HTML/JSON y responde al servidor web.


El servidor web envía respuesta HTTP 200 al navegador.


El navegador renderiza; para estáticos va a CDN. (Cookies/Sesión; CORS si hay APIs.)

3) Protocolos involucrados
DNS, HTTP/HTTPS + TLS, REST/JSON, SQL, HTTP/2 o HTTP/3 para rendimiento.
4) Ejemplo práctico (caso “Votar a un Presidente”)
GET /index.php -> lista de presidentes con votos.


Usuario POST /votar.php (id_disfraz) -> PHP valida sesión y evita doble voto.


PHP INSERT en BD y UPDATE conteo.


Respuesta: redirección 302 a /index.php con mensaje “¡Voto registrado!”.

Desafío 2 – Maestría en CSS: clase vs ID 
1) ¿Cuándo usar cada uno?
Clase (.mi-clase): estilos reutilizables, puedo aplicar muchas clases a un mismo elemento y a muchos elementos.


ID (#mi-id): identificador único en el documento; úsalo para anclar, JS puntual o un bloque único.


2) Nivel de especificidad
ID: más específico → (0,1,0,0)


Clase: medio → (0,0,1,0)


Regla: si chocan, gana el ID. Evita abusar de IDs en CSS para no “pegar” los estilos.

3) 2 Ejemplos prácticos en una interfaz real
Ejemplo A – Botón reutilizable y variant
<button class="btn">Comprar</button>
<button class="btn btn--primary">Votar</button>
<style>
.btn{padding:.6rem 1rem;border:1px solid #ccc;border-radius:.5rem}
.btn--primary{border-color:#0a7; background:#0a7; color:white}
</style>
Ejemplo B – Panel único de administración
<section id="admin-panel" class="card">...</section>
<style>
#admin-panel{max-width:1100px;margin:auto}
.card{box-shadow:0 2px 8px rgba(0,0,0,.1);padding:1rem;border-radius:.75rem}
</style>
Desafío 3 - Fundamentos de JavaScript 
Explica el concepto de variables en JavaScript: 
1) Propósito y utilidad: Guardar datos y controlar el estado de la app (inputs, contadores, respuestas del servidor).


2) Diferencias entre var, let y const
var: scope de función, hoisting (declaración sube) → inicializa como undefined.


let: scope de bloque ({ }), no permite re-declarar en el mismo bloque, TDZ (no usar antes de declarar).


const: scope de bloque no permite reasignar la referencia (los objetos pueden mutar sus propiedades).


3) Tres ejemplos (scope y hoisting)
Hoisting con var:
console.log(a): // undefined
var a = 5;
Bloques con let:
let x = 1;
if (true) {
    let x = 2;
    console.Log(x): // 2
}
console.log(x); // 1

const y mutación de objeto
const cfg = { modo: "prod" };
cfg.modo = "dev";   //
// cfg = {}         //

Desafío 4 - Introducción a PHP
PHP es un lenguaje de script que está del lado del servidor. Genera HTML/JSON, maneja formularios, sesiones, seguridad básica, y se comunica con la base de datos. Es ideal para lógica de negocio web.


Diferencias con lenguajes frontend
Dónde ejecuta: PHP corre en el servidor; JS del frontend corre en el navegador.


Acceso a recursos: PHP puede leer BD/archivos/variables de entorno; frontend no.


Salida: PHP devuelve HTML/JSON al cliente; frontend manipula el DOM ya cargado.


Ciclo: PHP se ejecuta por petición HTTP; frontend vive mientras la página esté abierta.


Ejemplo PHP integrado en HTML (procesar formulario)
<!-- form.html -->
<form action="procesar.php" method="POST">
  <input name="nombre" placeholder="Tu nombre" required>
  <input type="email" name="email" placeholder="Email" required>
  <button type="submit">Enviar</button>
</form>
<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: form.html'); exit;
}


$nombre = trim($_POST['nombre'] ?? '');
$email  = trim($_POST['email']  ?? '');


$errores = [];
if ($nombre === '') $errores[] = 'El nombre es obligatorio';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = 'Email inválido';


if ($errores) {
  $_SESSION['errores'] = $errores;
  header('Location: form.html'); exit;
}

🎨 PARTE 2: PROYECTO PRÁCTICO (80 puntos - distribuidos en 4 niveles)
 Nivel 1 : ELECCIÓN DE PROYECTO BASE (20 puntos)

PROYECTO C (Elegido): "QuizMaster" - Plataforma de Trivia Una institución educativa quiere gamificar el aprendizaje 
Requisitos Funcionales: 
Sistema de preguntas con múltiple opción (mínimo 15 preguntas) 
Validación de respuestas en tiempo real 
Sistema de puntuación y temporizador 
Tabla de mejores puntajes (stored en BD)
Categorías temáticas con dificultad variable 
Requisitos No Funcionales: 
Mínimo 3 secciones (inicio, juego, resultados) 
Animaciones fluidas y feedback inmediato
Diseño responsive 
Interfaz intuitiva sin instrucciones complejas 
⚡ NIVEL 2: Interactividad con JavaScript (20 puntos) 
📝 Documenta: Comenta la funcionalidad al inicio del archivo JS (3-5 líneas). 
PROYECTO C (QuizMaster):
Implementar: 
Lógica de Juego Completa
Algoritmo de validación de respuestas 
Sistema de puntuación progresiva 
Temporizador con penalización 
Feedback visual inmediato (correcto/incorrecto)

🔧 NIVEL 3: Backend con PHP (20 puntos) 
⚠️ OBLIGATORIO: Conexión e interacción con Base de Datos MySQL 📝
 Documenta: Comenta la funcionalidad PHP implementada
Para QuizMaster: 
Banco de preguntas desde BD 
Sistema de ranking persistente 
Registro de partidas jugadas
📊 Base de Datos: 
Crear con mínimo 2 tablas relacionadas: 
Claves primarias y foráneas
Datos de prueba (mínimo 10 registros) 
Exportar: 
[iniciales]_estructura.sql 
[iniciales]_datos.sql
🎨 NIVEL 4: Diseño y Experiencia Visual (20 puntos) 
📝 Documenta: Explica tus decisiones de diseño (paleta, tipografía, layout). 
Requisitos Funcionales: 
Paleta de colores coherente (4-5 colores) 
Tipografía consistente (jerarquía clara) 
Responsive: 3 breakpoints mínimo 
Menú adaptativo (hamburguesa en mobile) 
Requisitos No Funcionales: 
Transiciones suaves (hover, focus) 
Loading states visibles 
Contraste adecuado (accesibilidad) 
Espaciado uniforme (grid/flexbox)
