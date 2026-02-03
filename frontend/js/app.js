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

// 4. DRAG & DROP FAVORITOS
function arrastrar(evento){
    let fila = evento.currentTarget;
    let datos = {
        id: fila.getAttribute('data-id'),
        name: fila.getAttribute('data-name'),
        img: fila.getAttribute('data-img')
    };
    evento.dataTransfer.setData("text/plain", JSON.stringify(datos));
}
function permitirSoltar(evento){
    evento.preventDefault();
    let caja = document.getElementById('zona-favoritos');
    caja.classList.add('arrastrando-encima');
}

function soltar(evento){
    evento.preventDefault();
    
    // Quitamos el color de fondo
    let caja = document.getElementById('zona-favoritos');
    caja.classList.remove('arrastrando-encima');

    // Recuperamos los datos que guardamos al empezar a arrastrar
    let textoDatos = evento.dataTransfer.getData("text/plain");
    let juego = JSON.parse(textoDatos);

    // Comprobamos si ya lo hemos metido en la caja para no repetir
    if (document.getElementById('fav-' + juego.id)) {
        alert("¡Ese juego ya lo has puesto!");
        return;
    }

    // Ocultamos el texto de "Arrastra aquí..." y mostramos el botón Guardar
    document.getElementById('texto-instruccion').style.display = 'none';
    document.getElementById('btn-guardar-fav').style.display = 'inline-block';

    // Creamos el div pequeñito con la imagen
    let contenedor = document.getElementById('lista-visual-favoritos');
    
    let nuevoDiv = document.createElement('div');
    nuevoDiv.className = 'mini-ficha-fav';
    nuevoDiv.id = 'fav-' + juego.id; // Le ponemos ID para no repetir
    nuevoDiv.setAttribute('data-id-juego', juego.id); // Guardamos el ID para enviarlo luego
    
    // El HTML de dentro: la imagen y un título al pasar el ratón
    nuevoDiv.innerHTML = `<img src="${juego.img}" title="${juego.name}">`;

    // Truco: Si le das click a la imagen pequeña, se borra de la lista
    nuevoDiv.onclick = function() {
        this.remove();
        // Si vaciamos la lista, volvemos a poner el estado inicial
        if (contenedor.children.length === 0) {
            document.getElementById('texto-instruccion').style.display = 'block';
            document.getElementById('btn-guardar-fav').style.display = 'none';
        }
    };

    // Lo añadimos a la caja
    contenedor.appendChild(nuevoDiv);
}


function guardarFavoritos() {
    // 1. Buscamos todas las fichas que hemos soltado en la caja
    let fichas = document.querySelectorAll('.mini-ficha-fav');
    let listaIds = [];

    // 2. Recorremos las fichas para sacar solo los IDs
    fichas.forEach(function(elemento) {
        let id = elemento.getAttribute('data-id-juego');
        listaIds.push(id);
    });

    // Si no hay nada, no hacemos nada
    if (listaIds.length === 0) return;

    // 3. Buscamos el token CSRF de Laravel (suele estar en el logout o en un meta)
    // Buscamos cualquier input hidden que se llame _token
    let token = document.querySelector('input[name="_token"]').value;

    // 4. Hacemos la petición al servidor (Laravel)
    fetch('/favorites', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ juegos: listaIds })
    })
    .then(function(respuesta) {
        if (respuesta.ok) {
            alert("¡Favoritos guardados correctamente!");
            // Limpiamos la caja visualmente
            document.getElementById('lista-visual-favoritos').innerHTML = '';
            document.getElementById('texto-instruccion').style.display = 'block';
            document.getElementById('btn-guardar-fav').style.display = 'none';
        } else {
            alert("Hubo un error al guardar. A lo mejor ya los tenías añadidos.");
        }
    })
    .catch(function(error) {
        console.log("Error en la petición:", error);
    });
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

    // --- DRAG & DROP: conectamos los eventos aquí porque el HTML ya existe ---
    // Buscamos todas las filas que tienen clase "fila-juego"
    // y les ponemos el evento dragstart (cuando empieza a arrastrar)
    let filas = document.querySelectorAll('.fila-juego');
    filas.forEach(function(fila) {
        fila.addEventListener('dragstart', arrastrar);
    });

    // A la caja de favoritos le conectamos dragover y drop
    let zonaFavoritos = document.getElementById('zona-favoritos');
    if (zonaFavoritos) {
        zonaFavoritos.addEventListener('dragover', permitirSoltar);
        zonaFavoritos.addEventListener('drop', soltar);
    }

    // Al botón de guardar favoritos le conectamos el click
    let btnGuardar = document.getElementById('btn-guardar-fav');
    if (btnGuardar) {
        btnGuardar.addEventListener('click', guardarFavoritos);
    }

    // --- RESEÑAS ---
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
    let tabla = document.getElementById('tabla-ofertas-body');
    let textoPagina = document.getElementById('texto-ofertas');
    
    if (!tabla) return;
    
    let busqueda = buscador ? buscador.value : '';
    let url = 'https://www.cheapshark.com/api/1.0/deals?storeID=1&pageSize=10';
    url = url + '&pageNumber=' + pagina;
    
    if (busqueda != "") {
        url = url + '&title=' + busqueda;
    }

    fetch(url)
        .then(function(respuesta) {
            return respuesta.json();
        })
        .then(function(datos) {
            tabla.innerHTML = '';

            if (datos.length == 0) {
                tabla.innerHTML = '<tr><td colspan="5" style="text-align:center; padding:20px;">No hay resultados.</td></tr>';
                return;
            }
            
            datos.forEach(function(juego) {
                let fila = `
                    <tr style="border-bottom: 1px solid #ccc;">
                        <td style="text-align:center; padding: 50px 15px;">
                            <img src="${juego.thumb}" width="100" style="border-radius:5px;">
                        </td>
                        <td style="padding: 50px 15px;">${juego.title}</td>
                        <td style="color:red; text-decoration:line-through; padding: 30px 15px;">${juego.normalPrice} $</td>
                        <td style="color:green; font-weight:bold; padding: 50px 15px;">${juego.salePrice} $</td>
                        <td style="padding: 50px 15px;">${juego.dealRating}</td>
                    </tr>
                `;
                tabla.innerHTML += fila;
            });

            if (textoPagina) {
                textoPagina.innerText = 'Página ' + (pagina + 1);
            }
        })
        .catch(function(error) {
            console.log('Error:', error);
        });
}

document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('tabla-ofertas-body')) {
        cargarOfertas();

        let btnBuscar = document.getElementById('btn-buscar');
        let btnSig = document.getElementById('btn-siguiente');
        let btnAnt = document.getElementById('btn-anterior');

        if(btnBuscar) {
            btnBuscar.addEventListener('click', function() {
                pagina = 0;
                cargarOfertas();
            });
        }

        if(btnSig) {
            btnSig.addEventListener('click', function() {
                pagina++;
                cargarOfertas();
            });
        }

        if(btnAnt) {
            btnAnt.addEventListener('click', function() {
                if (pagina > 0) {
                    pagina--;
                    cargarOfertas();
                }
            });
        }
    }
});

// EXPORTAMOS LAS FUNCIONES
window.arrastrar = arrastrar;
window.permitirSoltar = permitirSoltar;
window.soltar = soltar;
window.guardarFavoritos = guardarFavoritos;
window.menu = menu;
window.moverCarrusel = moverCarrusel;
window.filtrarPlataforma = filtrarPlataforma;