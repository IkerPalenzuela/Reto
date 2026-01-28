// 1. MENÚ HAMBURGUESA
function menu() {
    let navegacion = document.getElementById('menu-principal');
    if (navegacion) {
        navegacion.classList.toggle('mostrar');
    }
}

// 2. CARRUSEL
let indice = 0;
function mostrarImagen() {
    let imagenes = document.querySelectorAll('.imagen-carrusel');
    if (imagenes.length > 0) {
        if (indice >= imagenes.length) indice = 0;
        if (indice < 0) indice = imagenes.length - 1;
        imagenes.forEach(img => img.classList.remove('activa'));
        imagenes[indice].classList.add('activa');
    }
}

function moverCarrusel(direccion) {
    indice += direccion;
    mostrarImagen();
}

if (document.querySelector('.imagen-carrusel')) {
    setInterval(() => moverCarrusel(1), 4000);
}

// 3. FILTRADO POR TABS
function filtrarPlataforma(plataforma, botonActivo) {
    let botones = document.querySelectorAll('.btn-tab');
    for (let i = 0; i < botones.length; i++) {
        botones[i].classList.remove('activa');
    }
    
    botonActivo.classList.add('activa');

    let filas = document.querySelectorAll('#tabla-videojuegos tr');
    
    for (let j = 0; j < filas.length; j++) {
        if (plataforma == 'todas') {
            filas[j].style.display = '';
        } else {
            let celda = filas[j].getElementsByTagName('td')[3];
            
            if (celda) {
                // EL CAMBIO ESTÁ AQUÍ: .trim() quita espacios basura
                let textoCelda = celda.textContent.trim(); 
                
                if (textoCelda.includes(plataforma)) {
                    filas[j].style.display = '';
                } else {
                    filas[j].style.display = 'none';
                }
            }
        }
    }
}

// --- 4. CARGA DE RESEÑAS POR API ---
function pintarReseñas(datos) {
    let contenedor = document.getElementById('contenedor-reseñas');
    if (contenedor) {
        contenedor.innerHTML = '';
        datos.forEach(review => {
            let estrellas = '⭐'.repeat(review.evaluation);
            contenedor.innerHTML += `
                <div class="tarjeta-review">
                    <div class="header-review">
                        <img src="${review.game.img}" class="img-juego" style="width: 80px;">
                        <div>
                            <h3 class="titulo-juego">${review.game.name}</h3>
                            <span class="autor">Usuario: ${review.user.name}</span>
                        </div>
                    </div>
                    <div class="puntuacion">${estrellas}</div>
                    <hr>
                    <h4 class="titulo-resena">"${review.title}"</h4>
                    <p>"${review.contenido}"</p>
                </div>`;
        });
    }
}

function cargarReseñas() {
    fetch('/api/reviews')
        .then(res => res.json())
        .then(datos => pintarReseñas(datos))
        .catch(err => console.error("Error:", err));
}

// Ejecutar carga al abrir la página
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('contenedor-reseñas')) {
        cargarReseñas();
    }
});

// --- 5. ENVIAR RESEÑA POR API ---
function enviarReseña(e) {
    e.preventDefault();

    // Verificamos que los elementos existen antes de leer el valor para evitar errores en consola
    const gameIdEl = document.getElementById('game_id');
    const titleEl = document.getElementById('title');
    const evalEl = document.getElementById('evaluation');
    const contEl = document.getElementById('contenido');
    const tokenEl = document.querySelector('input[name="_token"]');

    if (!gameIdEl || !tokenEl) return;

    let datos = {
        game_id: gameIdEl.value,
        title: titleEl.value,
        evaluation: evalEl.value,
        contenido: contEl.value
    };

    fetch('/api/reviews', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': tokenEl.value
        },
        body: JSON.stringify(datos)
    })
    .then(res => {
        if (!res.ok) throw new Error('Error en el servidor');
        return res.json();
    })
    .then(json => {
        // Tu controlador devuelve "Created" con C mayúscula, asegúrate de que coincida
        if (json.message === 'Created') {
            alert('¡Reseña guardada!');
            window.location.href = '/dashboard';
        } else {
            alert('Error al guardar: ' + (json.message || 'Datos inválidos'));
        }
    })
    .catch(err => {
        console.error("Error:", err);
        alert('Error de conexión o de validación');
    });
}

// UN SOLO DOMContentLoaded para todo
document.addEventListener('DOMContentLoaded', function() {
    // Carga de reseñas (Dashboard / Index)
    if (document.getElementById('contenedor-reseñas')) {
        cargarReseñas();
    }
    
    // Escucha del formulario (reseñas.blade)
    let formulario = document.getElementById('form-review');
    if (formulario) {
        formulario.addEventListener('submit', enviarReseña);
    }
});

// Exponer funciones al HTML para que el menú y los tabs sigan funcionando
window.menu = menu;
window.moverCarrusel = moverCarrusel;
window.cargarReseñas = cargarReseñas;
window.filtrarPlataforma = filtrarPlataforma;
window.enviarReseña = enviarReseña; // Añadimos esta