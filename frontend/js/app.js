// --- 1. CONTROL DE SESIÓN ---
document.addEventListener('DOMContentLoaded', function(){
    let usuario = window.usuarioActual;

    // Si entramos en perfil.html, "usuario" será null. Entonces preguntamos a la API:
    if (!usuario || usuario == "") {
        fetch('/api/user')
            .then(function(respuesta) {
                if (respuesta.ok) {
                    return respuesta.json();
                }
                // Si el servidor da error (no logueado), devolvemos algo vacío
                return null;
            })
            .then(function(datos) {
                if (datos && datos.name) {
                    pintarInterfaz(datos.name);
                } else {
                    // Si no hay datos, lo tratamos como invitado pero mostramos la página
                    pintarInterfaz(""); 
                }
            })
            .catch(function(error) {
                // Si falla la conexión, al menos pintamos la interfaz vacía para que no se bloquee
                pintarInterfaz("");
            });
    } else {
        // Si ya viene el nombre desde el Dashboard
        pintarInterfaz(usuario);
    }

    // Cargar reseñas si el contenedor existe
    if (document.getElementById('contenedor-reseñas')) {
        cargarReseñas();
    }
});

// Esta función es la que "enciende" los botones y el nombre
function pintarInterfaz(nombre) {
    let btn_menu = document.getElementById('btn-menu');
    let caja_usuario = document.getElementById('caja-usuario-info');
    let texto_usuario = document.getElementById('nombre-usuario');
    let caja_botones = document.getElementById('caja-botones-auth'); // Los de Login/Registro

    if (nombre !== "") {
        // Si hay nombre, mostramos menú y nombre
        if(btn_menu) btn_menu.style.display = 'block';
        if(caja_usuario) caja_usuario.style.display = 'flex';
        if(texto_usuario) texto_usuario.textContent = 'Hola, ' + nombre;
        if(caja_botones) caja_botones.style.display = 'none';
    } else {
        // Si es invitado o falló la API, mostramos menú igual para que puedas navegar
        if(btn_menu) btn_menu.style.display = 'block'; 
        if(caja_usuario) caja_usuario.style.display = 'none';
        if(caja_botones) caja_botones.style.display = 'flex';
    }
}

// --- 2. MENÚ HAMBURGUESA ---
function menu(){
    let navegacion = document.getElementById('menu-principal');
    navegacion.classList.toggle('mostrar');
}

// --- 3. CARRUSEL ---
let indice = 0;

function mostrarImagen() {
    let imagenes = document.querySelectorAll('.imagen-carrusel');
    if (imagenes.length > 0) {
        if (indice >= imagenes.length) { indice = 0; } 
        if (indice < 0) { indice = imagenes.length - 1; }

        for(let i = 0; i < imagenes.length; i++) {
            imagenes[i].classList.remove('activa');
        }
        imagenes[indice].classList.add('activa');
    }
}

function moverCarrusel(direccion) {
    indice = indice + direccion;
    mostrarImagen();
}

// Solo arranca el tiempo si hay carrusel en la página
if (document.querySelector('.imagen-carrusel')) {
    setInterval(function() {
        moverCarrusel(1);
    }, 4000);
}

// --- 4. RESEÑAS Y FILTROS ---
function pintarReseñas(datos) {
    let contenedor = document.getElementById('contenedor-reseñas');
    if(contenedor) {
        contenedor.innerHTML = '';
        datos.forEach(function(review) {
            let estrellas = '';
            for(let i=0; i < review.evaluation; i++) {
                estrellas += '⭐';
            }

            contenedor.innerHTML += `
                <div class="tarjeta-review">
                    <div class="header-review">
                        <img src="${review.game.img}" class="img-juego">
                        <div>
                            <h3 class="titulo-juego">${review.game.name}</h3>
                            <span class="autor">Usuario: ${review.user.name}</span>
                        </div>
                    </div>
                    <div class="puntuacion">${estrellas}</div>
                    <hr>
                    <h4 class="titulo-resena">"${review.title}"</h4>
                    <p>"${review.contenido}"</p>
                </div>
            `;
        });
    }
}

function cargarReseñas() {
    fetch('/api/reviews')
        .then(function(respuesta) { return respuesta.json(); })
        .then(function(datos) {
            pintarReseñas(datos);
        });
}

function filtrarMejores() {
    fetch('/api/reviews')
        .then(function(res) { return res.json(); })
        .then(function(datos) {
            // Filtro sencillo para las de 5 estrellas
            let filtradas = datos.filter(function(r) {
                return r.evaluation === 5;
            });
            pintarReseñas(filtradas);
        });
}

window.menu = menu;
window.moverCarrusel = moverCarrusel;
window.cargarReseñas = cargarReseñas;
window.filtrarMejores = filtrarMejores;