
// Función para desplazar el carrusel automáticamente
function autoScroll() {
  const carrusel = document.querySelector('.product-carrusel');
  const firstElement = carrusel.firstElementChild;
  carrusel.appendChild(firstElement);
}

// Llama a la función de desplazamiento cada cierto intervalo de tiempo
setInterval(autoScroll, 2000); // Cambia 3000 por el tiempo en milisegundos que desees entre cada desplazamiento
