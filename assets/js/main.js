document.getElementById('hamburguer-menu').addEventListener('click', function() {
    
    const navbar = document.getElementById('navbar');
    
    if (!navbar.innerHTML) {
        const menuLinks = document.getElementById('menu').innerHTML;
        navbar.innerHTML = `<ul>${menuLinks}</ul>`;
    }

    navbar.classList.toggle('show');
 
});

function handleResize() {
    const navbar = document.getElementById('navbar');

    if(window.innerWidth > 700) {
        navbar.classList.remove('show');
    }
}

window.addEventListener('resize', handleResize);