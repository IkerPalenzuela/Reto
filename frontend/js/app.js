// CODIGO DEL CARRUSEL DE IMAGENES

let indice = 0; // Guardamos por qué foto vamos
function mostrarImagen() {
    let imagenes = document.querySelectorAll('.imagen-carrusel'); // Cogemos todas las imagenes
    
    // Comprobamos los limites de las imagenes
    if (indice >= imagenes.length) {
        indice = 0; // En el caso de que sea mas grande, vuelves al principio
    } else if (indice < 0) {
        indice = imagenes.length - 1; // Si retrocedes desde el 0, vas al final
    }

    // Ocultamos todas las imagenes
    for(let i = 0; i < imagenes.length; i++) {
        imagenes[i].classList.remove('activa');
    }
    // Mostrar solo la imagen que toca
    imagenes[indice].classList.add('activa');
}

// Funcion para los botones de pasar las imagenes en el carrusel
function moverCarrusel(direccion) {
    indice = indice + direccion;
    mostrarImagen();
}

// Funcion para que las imagenes se muevan solas cada 4 segundos
setInterval(function() {
    moverCarrusel(1);
}, 4000);


// ============================================
// 2. CARGAR RESEÑAS DESDE LA API
// ============================================

// Llamamos a la API de Laravel
fetch('/api/reviews')
    .then(function(respuesta) {
        return respuesta.json(); // Convertir a datos leibles
    })
    .then(function(datos) {
        let contenedor = document.getElementById('contenedor-reseñas');
        
        // Limpiamos el texto de "Cargando..."
        contenedor.innerHTML = '';

        // Recorremos cada reseña que nos ha llegado
        datos.forEach(function(review) {
            
            // Creamos las estrellas
            let estrellas = '';
            for(let i=0; i < review.evaluation; i++) {
                estrellas += '⭐';
            }

            // Añadimos el HTML
            contenedor.innerHTML += `
                <div class="tarjeta-review">
                    <h3 class="titulo-juego">${review.game.name}</h3>
                    <span class="autor">Usuario: ${review.user.name}</span>
                    <div class="puntuacion">${estrellas}</div>
                    <hr>
                    <p>"${review.contenido}"</p>
                </div>
            `;
        });
    })
    .catch(function(error) {
        console.log("Ha habido un error cargando las reseñas");
        console.log(error);
    });