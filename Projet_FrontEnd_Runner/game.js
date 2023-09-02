let character = document.getElementById('character');
let characterBottom = parseInt(window.getComputedStyle(character).getPropertyValue('bottom'));
let characterRight = parseInt(window.getComputedStyle(character).getPropertyValue('right'));
let characterWitdh = parseInt(window.getComputedStyle(character).getPropertyValue('witdh'));
let ground = document.getElementById('ground');
let groundBottom = parseInt(window.getComputedStyle(ground).getPropertyValue('bottom'));
let groundHeight = parseInt(window.getComputedStyle(ground).getPropertyValue('height'));
let isJumping = false;
let uptime;
let downtime;

function jump(){
    if(isJumping)
    return;
    uptime = setInterval(() => {
        if(characterBottom>=groundHeight + 250){
            clearInterval(uptime);
            downtime = setInterval(() => {
                if(characterBottom<= groundHeight + 10){
                    clearInterval(downtime);
                    isJumping = false ;
                }
                characterBottom -= 10;
                character.style.bottom = characterBottom + 'px'
            }, 20);
        }
        characterBottom += 10 ;
        character.style.bottom = characterBottom + 'px';
        isJumping = true;
    }, 20);
}

function generateObstacle(){
  let obstacles = document.querySelector('.obstacles');
  let obstacle = document.createElement('div');
  obstacle.setAttribute('class','obstacle');
  obstacles.appendChild(obstacle);

  let obstacleRight = -30;
  let obstacleBottom = 100;
  let obstacleWidth = 30;
  let obstacleHeight = Math.floor(Math.random()*50) + 50;

  function moveObstacle(){
    obstacleRight += 5;
    obstacle.style.right = obstacleRight + 'px';
    obstacle.style.bottom = obstacleBottom + 'px';
    obstacle.style.width = obstacleWidth + 'px';
    obstacle.style.height = obstacleHeight + 'px';
    if(characterRight >= obstacleRight - characterWitdh && characterRight <= obstacleRight + obstacleWidth && characterBottom <= obstacleBottom + obstacleHeight){
        alert('Game over');
        clearInterval(obstacleInterval);
        clearTimeout(obstacleTimeout);
        location.reload();
    }
  }

  let obstacleInterval = setInterval(moveObstacle, 20);
  let obstacleTimeout = setTimeout(generateObstacle, 1000);

}
generateObstacle()


function control(e){ 
    if (e.key == 'ArrowUp' || e.key == ' '){
        jump();
    }
}


document.addEventListener("keydown", control);