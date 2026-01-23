// CONTROL DE SESION
document.addEventListener('DOMContentLoaded', function(){
    let usuario = window.usuarioActual;
    // Atributos que vamos a mostrar/ocultar
    let btn_menu = document.getElementById('btn-menu');
    let caja_botones = document.getElementById('caja-botones-auth');
    let caja_usuario = document.getElementById('caja-usuario-info');
    let texto_usuario = document.getElementById('nombre-usuario');
    let btn_logout = document.getElementById('btn-logout');

    // Comprobamos si hay usuario (Si la variable tiene texto)
    if(usuario && usuario !== "") {
        console.log("Usuario detectado: " + usuario);
        // Si esta logueado
        if(btn_menu) btn_menu.style.display = 'block';
        if(caja_botones) caja_botones.style.display = 'none';
        if(caja_usuario) caja_usuario.style.display = 'flex';
        if(texto_usuario) texto_usuario.textContent = 'Hola, ' + usuario;
    // Si no esta logueado
    } else {
        console.log("Modo invitado");
        // Modo invitado
        if(btn_menu) btn_menu.style.display = 'none';
        if(caja_usuario) caja_usuario.style.display = 'none';
        if(caja_botones) caja_botones.style.display = 'flex';
    }
});

// MENU DE HAMBURGUESA Y NAVEGACION
function menu(){
    let navegacion = document.getElementById('menu-principal');
    navegacion.classList.toggle('mostrar')
}

// Función para controlar la navegacion y proteger rutas
function irA(seccion) {
    let estoy_logueado = window.usuarioActual;
    if (estoy_logueado && estoy_logueado !== "") {
        // Si tiene permiso, le dejamos ir a la pagina correspondiente
        console.log("Usuario autorizado. Navegando a: " + seccion);
        if (seccion == 'inicio') {
            window.location.href = '/dashboard';
        } else if (seccion == 'videojuegos') {
            window.location.href = '/games';    
        } else if (seccion == 'reseñas') {
            window.location.href = '/reviews';  
        } else if (seccion == 'perfil') {
            window.location.href = '/profile';
        }
    } else {
        console.log("Usuario no registrado. Redirigiendo a Login...");
        window.location.href = '/login';
    }
}

// CODIGO DEL CARRUSEL DE IMAGENES
let indice = 0;

function mostrarImagen() {
    let imagenes = document.querySelectorAll('.imagen-carrusel');
    if (indice >= imagenes.length) {
        indice = 0;
    } else if (indice < 0) {
        indice = imagenes.length - 1;
    }

    for(let i = 0; i < imagenes.length; i++) {
        imagenes[i].classList.remove('activa');
    }
    imagenes[indice].classList.add('activa');
}

function moverCarrusel(direccion) {
    indice = indice + direccion;
    mostrarImagen();
}

setInterval(function() {
    moverCarrusel(1);
}, 4000);

// CARGAMOS LAS RESEÑAS DESDE LA API
fetch('/api/reviews')
    .then(function(respuesta) {
        return respuesta.json();
    })
    .then(function(datos) {
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
                            <img src="${review.game.img}" class="img-juego" alt="Juego">
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
    })
    .catch(function(error) {
        console.log("Ha habido un error cargando las reseñas");
        console.log(error);
    });

    