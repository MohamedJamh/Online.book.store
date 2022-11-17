const pNavLink = document.querySelector('.profile-nav-link');
const dNavLink = document.querySelector('.dashboard-nav-link');
pNavLink.addEventListener('click',function(){
    pNavLink.classList.toggle('active')
    dNavLink.classList.remove('active')
})
dNavLink.addEventListener('click',function(){
    dNavLink.classList.toggle('active')
    pNavLink.classList.remove('active')
})