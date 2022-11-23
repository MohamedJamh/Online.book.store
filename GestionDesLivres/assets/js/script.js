
//navbar script
const pNavLink = document.querySelector('.profile-nav-link');
const dNavLink = document.querySelector('.dashboard-nav-link');
if(pNavLink != null){
    pNavLink.addEventListener('click',function(){
        pNavLink.classList.toggle('active')
        dNavLink.classList.remove('active')
    })
    dNavLink.addEventListener('click',function(){
        dNavLink.classList.toggle('active')
        pNavLink.classList.remove('active')
    })
}

// //image script
var coverSelector = document.getElementById('cover-selector');
var bookPicture = document.querySelector('.book-picture img');
if(coverSelector != null && bookPicture != null){
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
}

//inputs validation
function validInput(input){
    input.style.borderColor = "green";
    input.style.backgroundColor = "#d2f8d2";
}
function inValidInput(input,e){
    input.style.borderColor = "red";
    input.style.backgroundColor = "#F7A4A4";
    e.preventDefault();
}
function isSpecailChar(input){
    var specialChar = "\'\""
    for(c of specialChar){
        if(input.value.includes(c)){
            return true;
        }
    }
}
function inValidInputNumber(input){
    if( (input.name.includes('available') || input.name.includes('sold') ) && input.value < 0 ){
        return true;
    }else if(input.name.includes('price') && input.value <= 0){
        return true;
    }
}


const registerForm = document.getElementById('register_form');
if(registerForm != null){
    registerForm.addEventListener('submit', function(e){
        const inputs = document.querySelectorAll('#register_form input')
        for( i of inputs){
            validInput(i)
            if(i.value == "" || (i.name == "password" && i.value.length <= 4 ) || isSpecailChar(i)){
                inValidInput(i,e);
            }else if (i.name == "confirm_password"){
                const password = document.querySelector('input[name="password"]')
                if(!(i.value === password.value)){
                    inValidInput(i,e);
                }
            }
        }
    })
}

const loginForm = document.getElementById('login_form');
if(loginForm != null){
    loginForm.addEventListener('submit', function(e){
        const inputs = document.querySelectorAll('#login_form input')
        for( i of inputs){
            validInput(i)
            if(i.value == ""){
                inValidInput(i,e);
            }
        }
    })
}


const inputsModalForm = document.getElementById('inputs_modal');
if(inputsModalForm != null){
    inputsModalForm.addEventListener('submit', function(e){
        const inputs = document.querySelectorAll('.inputs-modal input, .inputs-modal textarea, .inputs-modal select')
        for( i of inputs){
            validInput(i)
            if(i.value == "" || (i.tagName == 'SELECT' && i.value  < 1) || inValidInputNumber(i)){
                inValidInput(i,e);
            }
        }
    })
}

