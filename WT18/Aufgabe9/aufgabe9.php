<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aufgabe 9</title>
    <style>
        #div1 {
            width: 200px;
            height: 200px;
            background-color: red;
        }
        #inp1 {
            font-size: 1em;
            font-weight: bold;
        }
        #div2 {
            padding-top: 10px;
            font-size: 1em;
            font-weight: bold;
        }
    </style>
</head>
<body>
<h1>Mausereignisse behandeln mit JavaScript</h1>
<div id="div1" onclick="changeColor('green')"
     ondblclick="insertText('Doppelklick')"
     onmouseenter="changeSize(true)"
     onmouseleave="changeSize(false)">

</div>

<h1>Tastaturereignisse behandeln mit JavaScript</h1>
<input id="inp1"
       onfocus="changeBackground('lightblue')"
       onblur="changeBackground('white')"
       onkeyup="mirrorInput()"/>
<div id="div2"></div>
       <script>
           function mirrorInput()
           {
                var input = document.getElementById('inp1').value;
                if(isNaN(input) || input < 1 || input > 10000)
                {
                    document.getElementById('inp1').style.color = 'red';
                    document.getElementById('div2').style.color = 'red';
                }
                else
                {
                    document.getElementById('inp1').style.color = 'green';
                    document.getElementById('div2').style.color = 'green';
                }
                document.getElementById('div2').innerHTML = input;
           }

           function changeBackground(color)
           {
                document.getElementById('inp1').style.backgroundColor = color;
           }

           function changeSize(bigger)
           {
               if(bigger)
               {
                   document.getElementById('div1').style.width = '300px';
                   document.getElementById('div1').style.height = '300px';
               }
               else
               {
                   document.getElementById('div1').style.width = '200px';
                   document.getElementById('div1').style.height = '200px';
               }
           }

           function changeColor(color)
           {
               document.getElementById('div1').style.backgroundColor = color;
           }

           function insertText(text)
           {
               var div = document.getElementById('div1');

               div.style.color = 'white';
               div.style.textAlign = 'center';
               div.style.fontStyle = 'bold';
               div.style.lineHeight = '200px';
               if(div.innerHTML == 'Doppelklick')
               {
                   div.innerHTML = '';
                   div.style.backgroundColor = 'red';
               }
               else
               {
                   div.innerHTML = text;
                   div.style.backgroundColor = 'green';
               }

           }
       </script>
</body>
</html>