<head>
    <link rel="stylesheet" href="mystyle.css">
</head>
<html>
    <script type="text/javascript">

        function ShowHiddenButton(){
            
            const element = document.getElementById("secretButton");
            console.log(element);
            element.classList.add('visibleJsButton');
            console.log(element.classList)
        };

        for (let index=0; index<3;index++){
            const color = ["red","yellow","green"];
            console.log("this is my current color " + color[index]);
            //$('.logo').fadeOut();
            //$('.logo').fadeIn();
        };

    </script>
    <p>
        Javascrpit (a baddie can't spell)
    </p>
    <a onclick=ShowHiddenButton()>Click Here</a>
    <p id="secretButton" class="hiddenJsButton">javascript demo</p>
</html>