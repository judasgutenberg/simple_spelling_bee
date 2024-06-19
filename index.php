


<!DOCTYPE html>
<html lang="en">
<head>
    <script src='spellingbee.js'></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spelling Bee</title>
    <link rel='stylesheet' href='spellingbee.css'>
<body>

 <div class="centered-div" id="top-div">
    <div id="message" ></div>
    <div id="foundwordslabel" >Words You Have Found</div>
    <div id="config"><input onchange='updateFoundWords()' type='checkbox' id='sortAlphabetically'/>sort alphabetically</div>
    <div id="foundwords" ></div>
    <div id="score" style='border:1px solid #999999'></div>
    <div id="currentword"></div>
 </div>
 
    <div id="hexagon-container"></div>
        </div>
     <div class="centered-div" id="top-div">
      <div class='buttons'>
        <button data-key="Backspace" onclick='return(deleteLetter())' >delete</button>
        <button data-key="Enter" onclick='return(enterWord())' >enter</button>
        <button data-key=" " onclick='return(shuffle())' >shuffle</button>
      
      
      
      </div>
 

    <script>
    
      <?php 
      $url = "https://www.nytimes.com/puzzles/spelling-bee/";
      $src = file_get_contents($url);

      function getValueBetween($haystack, $startStr, $endStr) {
          $startPos = strpos($haystack, $startStr);
          if ($startPos !== false) {
              $endPos = strpos($haystack, $endStr, $startPos + strlen($startStr));
              if ($endPos !== false) {
                  return substr($haystack, $startPos + strlen($startStr), $endPos - $startPos - strlen($startStr));
              } else {
                  return "";
              }
          } else {
              return "";
          }
      }

      if (strlen($src) > 0) {
          $centerLetter = getValueBetween($src, '"centerLetter":"', '"');
          $outerLetters = getValueBetween($src, '"outerLetters":[', ']');
          $answers = getValueBetween($src, '"answers":[', ']');
          $panagrams = getValueBetween($src, '"pangrams":[', ']');
          echo "let answers = [" . $answers . "];" . PHP_EOL;
          echo "let panagrams = [" . $panagrams . "];" . PHP_EOL;
          echo "let centerLetter = \"" . $centerLetter . "\";" . PHP_EOL;
          echo "let outerLetters = [" . $outerLetters . "];" . PHP_EOL;
          echo "let letters = centerLetter + outerLetters.join(\"\") + \";\"" . PHP_EOL;
      }
      ?>
        const hexagonLetters = {};
        const buttonKeys = {};
    
        function generateHexagons() {
            let hexagons = document.getElementsByClassName('hexagon');
            for(let hexagon of hexagons) {
              hexagon.remove();
            }
            const container = document.getElementById('hexagon-container');
            container.innerHTML = "";
      
            let lettersUsed = [];
            for (let i = 0; i < 7; i++) {
                const hexagon = document.createElement('div');
                hexagon.className = 'hexagon';
                let randomLetter = "";
                let random = 0;
                if(i<6) {
                  while(lettersUsed.indexOf(randomLetter) > -1 || randomLetter == "") {
                    random = Math.floor(Math.random() * outerLetters.length);
                    randomLetter = outerLetters[random].toUpperCase();
                  }
                  lettersUsed.push(randomLetter);
                }
                else {
                  randomLetter = centerLetter.toUpperCase();
                }
                hexagon.innerHTML = randomLetter;
                hexagon.addEventListener('click', () => {
                    clickLetter(randomLetter);
                });
                hexagon.addEventListener('mouseover', () => {
                    hexagon.style.backgroundColor = '#ffff77';
                });
                hexagon.addEventListener('mouseout', () => {
                    hexagon.style.backgroundColor = '#eeee99';
                });
                container.appendChild(hexagon);
                hexagonLetters[randomLetter] = hexagon;
            }
        }

      document.addEventListener('DOMContentLoaded', () => {
          generateHexagons();
          setupButtons();
          document.addEventListener('keydown', handleKeyPress);
      });
    </script>
</body>
</html>
