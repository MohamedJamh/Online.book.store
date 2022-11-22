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

var coverSelector = document.getElementById('cover-selector');
var bookPicture = document.querySelector('.book-picture img');
var bookCover = "";
coverSelector.addEventListener('change',function(){
    const reader = new FileReader();
    reader.addEventListener('load',() =>{
        bookCover = reader.result;
        bookPicture.src = bookCover;
    })
    reader.readAsDataURL(this.files[0]);
    bookPicture.parentElement.style.height = 'max-content';
})