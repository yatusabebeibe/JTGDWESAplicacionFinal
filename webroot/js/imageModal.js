window.addEventListener('DOMContentLoaded', () => {

    const carouselImgs = [...document.querySelectorAll('.carouselImagenes .imagenes img')];
    const radios = document.querySelectorAll('.carouselImagenes input[name="rd"]');
    let currentIndex = 0;

    // ================= MODAL =================
    const modal = document.createElement('div');
    modal.className = 'steam-image-modal';
    modal.innerHTML = `
        <button class="steam-image-close">&times;</button>
        <img>
    `;
    document.body.appendChild(modal);

    const mImg = modal.querySelector('img');

    // ================= TRANSFORM STATE =================
    let zoom = 1, targetZoom = 1;
    let x = 0, y = 0, targetX = 0, targetY = 0;
    let drag = false, sx = 0, sy = 0;
    let rafId = null;

    const render = () => {
        x += (targetX - x) * 0.25;
        y += (targetY - y) * 0.25;
        zoom += (targetZoom - zoom) * 0.25;

        mImg.style.transform = `translate(${x}px, ${y}px) scale(${zoom})`;

        if (
            Math.abs(targetX - x) > 0.1 ||
            Math.abs(targetY - y) > 0.1 ||
            Math.abs(targetZoom - zoom) > 0.01
        ) {
            rafId = requestAnimationFrame(render);
        } else {
            rafId = null;
        }
    };

    const requestRender = () => {
        if (!rafId) rafId = requestAnimationFrame(render);
    };

    const resetTransform = () => {
        zoom = targetZoom = 1;
        x = y = targetX = targetY = 0;
        requestRender();
    };

    // ================= CARRUSEL =================
    function cambiarImagen(indice) {
        currentIndex = indice;

        carouselImgs.forEach((img, i) => {
            img.style.display = i === indice ? 'block' : 'none';
        });

        radios[indice].checked = true;

        if (modal.classList.contains('active')) {
            mImg.src = carouselImgs[indice].src;
            resetTransform();
        }
    }

    radios.forEach((radio, i) => {
        radio.addEventListener('change', () => cambiarImagen(i));
    });

    carouselImgs.forEach((img, idx) => {
        img.style.cursor = 'zoom-in';
        img.onclick = () => {
            cambiarImagen(idx);
            mImg.src = img.src;
            resetTransform();
            modal.classList.add('active');
        };
    });

    // ================= MODAL CLOSE =================
    modal.onclick = e => {
        if (e.target === modal) modal.classList.remove('active');
    };

    modal.querySelector('.steam-image-close').onclick = () => {
        modal.classList.remove('active');
    };

    // ================= KEYBOARD =================
    window.onkeydown = e => {
        if (!modal.classList.contains('active')) return;

        if (e.key === 'Escape') modal.classList.remove('active');
        if (e.key === 'ArrowLeft' && currentIndex > 0) cambiarImagen(currentIndex - 1);
        if (e.key === 'ArrowRight' && currentIndex < carouselImgs.length - 1) cambiarImagen(currentIndex + 1);
    };

    // ================= ZOOM =================
    mImg.onwheel = e => {
        e.preventDefault();

        targetZoom += e.deltaY < 0 ? 0.25 : -0.25;
        targetZoom = Math.min(Math.max(1, targetZoom), 3);

        if (targetZoom === 1) {
            targetX = 0;
            targetY = 0;
        }

        requestRender();
    };

    // ================= DRAG =================
    mImg.onmousedown = e => {
        if (targetZoom === 1) return;
        drag = true;
        sx = e.clientX - targetX;
        sy = e.clientY - targetY;
        e.preventDefault();
    };

    window.onmousemove = e => {
        if (!drag) return;
        targetX = e.clientX - sx;
        targetY = e.clientY - sy;
        requestRender();
    };

    window.onmouseup = () => drag = false;

    // ================= INIT =================
    cambiarImagen(0);
});
