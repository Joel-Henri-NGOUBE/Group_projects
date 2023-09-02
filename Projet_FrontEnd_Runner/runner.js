var perso = document.querySelector(".perso");
var obstacles_bas = document.querySelector(".obstacles_bas");
var obstacles_haut = document.querySelector(".obstacles_haut");
var azerty = document.getElementById("poiuy")

function sauter(){
    // fonction pour faire sauter le personnage

    if(perso.classList !="animation"){
        perso.classList.add('animation');
    }
    setTimeout(function(){
        perso.classList.remove('animation');
    },500)
}
function accroupi(){
    // fonction pour faire sauter le personnage
    
    if(perso.classList !="animation"){
        perso.classList.add('animation');
    }
    setTimeout(function(){
        perso.classList.remove('animation');
    },500)
}

//verifier  si l'obstacle du bas touche le personnage

var verification = setInterval(function(){
    var persoTop = parseInt(window.getComputedStyle(perso).getPropertyValue("top"));
    var obstacles_basLeft = parseInt(window.getComputedStyle(obstacles_bas).getPropertyValue("left"));

    if(obstacles_basLeft<50 && obstacles_basLeft>0 && persoTop>= 250){
        obstacles_bas.style.animation ="none";
        alert("Vous avez perdu...")
    }
},1)

//verifier  si l'obstacle du haut touche le personnage

var verification = setInterval(function(){
    var persoTop = parseInt(window.getComputedStyle(perso).getPropertyValue("top"));
    var obstacles_hautLeft = parseInt(window.getComputedStyle(obstacles_haut).getPropertyValue("left"));

    if(obstacles_hautLeft<50 && obstacles_hautLeft>0 && persoTop>= 250){
        obstacles_haut.style.animation ="none";
        alert("Vous avez perdu...")
    }
},1)
function qsdfdg(){
    azerty.play();
}


function controlUp(e){
    if (e.key == "ArrowUp"){
        sauter();
        qsdfdg();
    }
}
function controlDown(e){ 
    if (e.key == 'ArrowDown'){
        accroupi();
    }
}

document.addEventListener("keydown", controlUp);
document.addEventListener("keydown", controlDown);
