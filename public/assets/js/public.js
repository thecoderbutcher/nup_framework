document.addEventListener("DOMContentLoaded", function() {
    
    // Navbar behavior
    const navbar = document.querySelector('.navbar-nav');
    const nav    = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        window.scrollY > 50 ? 
            (window.innerWidth > 990 ? navbar.classList.add('nav-fixed') : nav.classList.add('nav-fixed-mobile'))
            : 
            (window.innerWidth > 990 ? navbar.classList.remove('nav-fixed') : nav.classList.remove('nav-fixed-mobile'))
            
    })

    // Active class NavBar
    const navItem = document.querySelectorAll('.nav-item');
    navItem.forEach( (element) =>{  
        element.firstElementChild.classList.toggle('active')
        element.addEventListener('click',(e) => {
            e.target.classList.toggle('active')
        })
    })

})