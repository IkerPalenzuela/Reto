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

// 5. ENVIAR RESEÑA POR API
function enviarReseña(e) {
    e.preventDefault();

    // Creamos el objeto con los nombres que espera el ReviewController
    let datos = {
        game_id: document.getElementById('game_id').value,
        title: document.getElementById('title').value,
        evaluation: document.getElementById('evaluation').value,
        contenido: document.getElementById('contenido').value
    };

    fetch('/api/reviews', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(datos)
    })
    .then(res => res.json())
    .then(json => {
        if (json.message === 'Created') {
            alert('¡Reseña guardada!');
            window.location.href = '/dashboard';
        } else {
            alert('Error al guardar');
        }
    })
    .catch(err => console.error("Error:", err));
}

// Actualizar el DOMContentLoaded para que también escuche el formulario
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('contenedor-reseñas')) {
        cargarReseñas();
    }
    
    let formulario = document.getElementById('form-review');
    if (formulario) {
        formulario.addEventListener('submit', enviarReseña);
    }
});

// Exponer funciones al HTML
window.menu = menu;
window.moverCarrusel = moverCarrusel;
window.cargarReseñas = cargarReseñas;
window.filtrarPlataforma = filtrarPlataforma;