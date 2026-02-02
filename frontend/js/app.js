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

// 4. CARGA DE RESEÑAS
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
        .then(respuesta => respuesta.json())
        .then(datos => pintarReseñas(datos))
        .catch(error => console.log("Error cargando:", error));
}

// 5. ENVIAR RESEÑA
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('contenedor-reseñas')) {
        cargarReseñas();
    }
    let formulario = document.getElementById('form-review');

    if (formulario) {
        formulario.addEventListener('submit', function(e) {
            e.preventDefault();
            let token = document.querySelector('input[name="_token"]').value;

            // Preparamos los datos
            let datos = {
                game_id: document.getElementById('game_id').value,
                title: document.getElementById('title').value,
                evaluation: document.getElementById('evaluation').value,
                contenido: document.getElementById('contenido').value
            };

            fetch('/reviews', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(datos)
            })
            .then(respuesta => {
                if (respuesta.ok) {
                    alert('Reseña guardada');
                    window.location.href = '/dashboard';
                } else {
                    alert('Error al guardar la reseña');
                }
            })
            .catch(error => console.log(error));
        });
    }
});


// 6. API Externa - OFERTAS
let pagina = 0;
function cargarOfertas() {
    let buscador = document.getElementById('buscador-ofertas');
    let tabla = document.getElementById('tabla-ofertas');
    let textoPagina = document.getElementById('texto-ofertas');
    let busqueda = buscador.value;
    let url = 'https://www.cheapshark.com/api/1.0/deals?storeID=1&pageSize=25';

    url = url +'&pageNumber=' + pagina;
    if (busqueda != ""){
        url = url + '&title=' + busqueda;
    }

    fetch(url)
        .then(function(respuesta) {
            return respuesta.json();
        })
        .then(function(datos) {
            tabla.innerHTML = '';
            datos.forEach(function(juego) {
                let fila = `
                    <tr>
                        <td><img src="${juego.thumb}" width="60"></td>
                        <td>${juego.title}</td>
                        <td style="color:red; text-decoration:line-through">${juego.normalPrice} $</td>
                        <td style="color:green; font-weight:bold">${juego.salePrice} $</td>
                        <td>${juego.dealRating} / 10</td>
                    </tr>
                `;
                tabla.innerHTML += fila;
            });

            textoPagina.innerText = 'Página ' + (pagina + 1);
        })
        .catch(function(error) {
            console.log('Error cargando ofertas:', error);
        });
}

document.addEventListener('DOMContentLoaded', function() {
    let existeTabla = document.getElementById('tabla-ofertas-body');
    if (existeTabla) {
        cargarOfertas();

        document.getElementById('btn-buscar').addEventListener('click', function() {
            pagina = 0;
            cargarOfertas();
        });

        document.getElementById('btn-siguiente').addEventListener('click', function() {
            pagina = pagina + 1;
            cargarOfertas();
        });

        document.getElementById('btn-anterior').addEventListener('click', function() {
            if (pagina > 0) {
                pagina = pagina - 1;
                cargarOfertas();
            }
        });
    }
});

// EXPORTAMOS LAS FUNCIONES
window.menu = menu;
window.moverCarrusel = moverCarrusel;
window.filtrarPlataforma = filtrarPlataforma;