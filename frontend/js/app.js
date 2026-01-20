// MENU DE HAMBURGUESA Y NAVEGACION
function menu(){
    let navegacion = document.getElementById('menu-principal');
    navegacion.classList.toggle('mostrar')
}

// Función para ir a las secciones
function irA(seccion) {
    let estoyLogueado = localStorage.getItem('auth_token'); 

    if (estoyLogueado) {
        console.log("Usuario autorizado. Navegando a: " + seccion);
        if (seccion === 'inicio') {
            window.location.href = '/dashboard';
        } else if (seccion === 'videojuegos') {
            window.location.href = '/games';    
        } else if (seccion === 'reseñas') {
            window.location.href = '/reviews';   
        } else if (seccion === 'favoritos') {
            window.location.href = '/favorites'; 
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

// Llamamos a la API de Laravel
fetch('/api/reviews')
    .then(function(respuesta) {
        return respuesta.json(); 
    })
    .then(function(datos) {
        let contenedor = document.getElementById('contenedor-reseñas');
        
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
    })
    .catch(function(error) {
        console.log("Ha habido un error cargando las reseñas");
        console.log(error);
    });