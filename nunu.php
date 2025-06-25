<?php 
    include("include/init.php");
        debugOutput($_REQUEST);
    
    ?>

<body>
    <form action="" method="post" id="dynamicForm">
        <h1>New Program:</h1>
        <div id="inputContainer">
            <button type="button" id="addButton">Add Field</button>
        </div>
        <input type="submit"  >
<script>
    document.getElementById('addButton').addEventListener('click', function() {
        var inputContainer = document.getElementById('inputContainer');
        var newInputWrapper = document.createElement('div');
        newInputWrapper.classList.add('inputWrapper');
        var weight = document.createTextNode("Weight:");//weight text
        newInputWrapper.appendChild(weight);

        var newInput = document.createElement('input');//weight field
        newInput.type = 'number';
        newInput.id = 'inputField' + (inputContainer.children.length);
        newInput.name = 'weight'+ (inputContainer.children.length);;
        newInputWrapper.appendChild(newInput);

        var reps = document.createTextNode(" Reps:");//reps text
        newInputWrapper.appendChild(reps);

        var newInput = document.createElement('input');// reps field
        newInput.type = 'number';
        newInput.id = 'inputField' + (inputContainer.children.length);
        newInput.name = 'reps'+ (inputContainer.children.length);;
        newInputWrapper.appendChild(newInput);

        var newButton = document.createElement('button');
        newButton.textContent = 'Remove';
        newButton.classList.add('removeButton');
        newButton.addEventListener('click', function(event) {
            event.preventDefault();
            event.target.parentNode.remove();
        });
        newInputWrapper.appendChild(newButton);

        inputContainer.appendChild(newInputWrapper);
    });

</script>