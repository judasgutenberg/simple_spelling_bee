function generateHexagons() {
    const container = document.getElementById('hexagon-container');
    const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    for (let i = 0; i < 7; i++) {
        const hexagon = document.createElement('div');
        hexagon.className = 'hexagon';
        const randomLetter = letters[Math.floor(Math.random() * letters.length)];
        hexagon.textContent = randomLetter;
        container.appendChild(hexagon);
    }
}

let currentWord = "";
let foundWords = [];
let score = 0;
let level = "Nice Start";
let totalScore = 0;
  
setTimeout(()=>{
for(let word of answers){
  totalScore += wordPoints(word);
}
}, 1000);
  
function clickLetter(letter){
  currentWord += letter;
  document.getElementById("currentword").innerHTML = currentWord;
  
}


function deleteLetter(letter){
  if(currentWord != "") {
    currentWord = currentWord.substring(0, currentWord.length-1);
    document.getElementById("currentword").innerHTML = currentWord;
  }
  return false;
}


function enterWord(){
  let message = "";
  let delay = 4000;
  if(answers.indexOf(currentWord.toLowerCase()) > -1 && foundWords.indexOf(currentWord.toLowerCase()) ==-1){
  
    foundWords.push(currentWord.toLowerCase()); 
    let scoreDiv = document.getElementById("score");
    let wordScore = wordPoints(currentWord);
    
    if(panagrams.indexOf(currentWord.toLowerCase()) > -1) {
      message = "You found a panagram! +" + wordScore + " points!";
      delay = 6000;
    }
    else
    {
      message = "You found a word! +" + wordScore + " points!"; ;
    }
    score +=  wordScore;
    
    if(totalScore>0 ) {
      let fraction = score/ totalScore;
      if(fraction < 0.02) {
        level = "Good start";
      } else  if (fraction <= 0.05) {
        level = "Moving up";
      } else  if (fraction <= 0.08) {
        level = "Good";
      } else  if (fraction <= 0.15) {
        level = "Solid";
      } else  if (fraction <= 0.25) {
        level = "Nice";
       } else  if (fraction <= 0.40) {
        level = "Great";   
       } else  if (fraction <= 0.50) {
        level = "Amazing"; 
       } else  if (fraction <= 0.70) {
        level = "Genius";  
       } else  if (fraction <= 1) {
        level = "Queen Bee";  
       }
    }
    scoreDiv.innerHTML = "Score: " + score + " points; Level: " + level;
  } else if (currentWord.toLowerCase().indexOf(centerLetter) == -1) {
    message = "Your word must contain '" + centerLetter + "'!";
  } else if (currentWord.length < 4) {
    message = "Your word was too short!";
  } else if (foundWords.indexOf(currentWord.toLowerCase()) > -1) {
    message = "You already found that word!";
  } else {
    message = "That's not a word!";
  }
  currentWord = "";
  document.getElementById("currentword").innerHTML = currentWord;
  let messageDiv = document.getElementById("message");
  messageDiv.innerHTML = message;
  messageDiv.style.display = 'block';
  updateFoundWords();
  setInterval(()=>{
    messageDiv.style.display = 'none';
  }, delay);
  return false;
}

function shuffle(){
  
  generateHexagons();
  return false;
}

function updateFoundWords() {
  let foundWordsDiv = document.getElementById("foundwords");
  foundWordsDiv.innerHTML = "";
  for(let word of foundWords){
    if(panagrams.indexOf(word.toLowerCase()) > -1) {
      foundWordsDiv.innerHTML+= "<div class='panagram'>" + word + "</div>";
    } else {
      foundWordsDiv.innerHTML+= "<div>" + word + "</div>";
    }
  }

}


function wordPoints(word) {
  let points = word.length;
  if(word.length == 4) {
    points = 1;
  } else if (panagrams.indexOf(word.toLowerCase()) > -1) {
    points = points + 7;
  }
  return points;
}