<!DOCTYPE html>
<html lang="en">
<head>
  <title>Generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="container">  
    <h2>Scores Generator</h2>        
    <button type="button" class="btn btn-primary" onclick="generate()">Generate</button>
    <button type="button" class="btn btn-warning" onclick="goTo()">Analytics</button>
        <div>  
            <p class="text-center" style="font-size: 200px" id="scoreDisplay">0</p>
        </div>
</div>
</body>
</html>

<script>
    function generate (i = 0){
        setTimeout(function() {  
            const generated_score = Math.floor(Math.random() * 100);
            if(i < 10){
                document.getElementById("scoreDisplay").innerHTML = generated_score;       
                i++;
                generate(i);
            }else{
                const score = document.getElementById("scoreDisplay").innerHTML;
                $.ajax({
                    url: "api/save_score?score="+score,
                    dataType: "JSON",
                    success: (data) => {
                        console.log(data.message);
                    },
                    error: err => {
                        console.log(err);
                    },
                });
            }
        }, 50)
    };
    function goTo(){
        console.log("asdsd")
        window.location.href = "/analytics";
    };
</script>
