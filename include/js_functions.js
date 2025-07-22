    
    function Show(elementId){
        const element = document.getElementById(elementId);     
        if(element.classList.contains('surprisetext')){
            element.classList.remove('surprisetext');
            element.classList.add('sneakytext');

        }else{
            element.classList.remove('sneakytext');
            element.classList.add('surprisetext');

        }


    }
    
    function ShowText(selectedValue,elementId){ //show new workout form
        const element = document.getElementById(elementId);
        if (selectedValue === "new") {
            element.classList.add('surprisetext');

        }else{
            element.classList.remove('surprisetext');
        }
    }


    function NewSetRow(id) {// creates a new input row for a set within a specific movement
       var inputContainer = document.getElementById(id);
        var newInputWrapper = document.createElement('div');
        newInputWrapper.classList.add('setWrapper'); //add styling?????

        var weight = document.createTextNode("Weight:");//weight text
        newInputWrapper.appendChild(weight);

        var newInput = document.createElement('input');//weight field
        newInput.type = 'number';
        newInput.id = 'weightField' + (inputContainer.children.length);
        newInput.name = 'weight'+ (inputContainer.children.length)+ id;
        newInput.classList.add('workout-input-box');
        newInputWrapper.appendChild(newInput);

        var newrepWrapper = document.createElement('span'); //creating a new container for all reps info
        newrepWrapper.classList.add('repWrapper');

        var reps = document.createTextNode(" Reps:");//reps text
        newrepWrapper.appendChild(reps);

        var newInput = document.createElement('input');// reps field
        newInput.type = 'number';
        newInput.id = 'repField' + (inputContainer.children.length);
        newInput.name = 'reps'+ (inputContainer.children.length)+ id;
        newInput.classList.add('workout-input-box');
        newrepWrapper.appendChild(newInput);

        var removeSetButton = document.createElement('button');
        removeSetButton.textContent = '-';
        removeSetButton.classList.add('remove-button');
        removeSetButton.addEventListener('click', function(event) {
            event.preventDefault();
            event.target.parentNode.remove();
        });
        newrepWrapper.appendChild(removeSetButton);
        newInputWrapper.appendChild(newrepWrapper);

        inputContainer.appendChild(newInputWrapper);
    };


    

    function NewMovementRow(){ // adds a new section of movements
        var inputContainer = document.getElementById('inputContainer');
        var newInputWrapper = document.createElement('div'); //creates a new div for the select element, therefore the elements stack vertically
        newInputWrapper.classList.add('movementWrapper'); //add styling?????
        var id = (inputContainer.children.length);
        newInputWrapper.id = id;

        var select = document.createElement('select'); // creates the select element
        select.setAttribute("onchange", "ShowText(this.value,'popUp')")
        var thisId = "divi" + (inputContainer.children.length); 
        select.classList.add('movement-input-box');
        select.id = thisId;
        select.name = "movement" + id;
        newInputWrapper.appendChild(select); //adds the select element to the created div 

        var removeMovementButton = document.createElement('button');
        removeMovementButton.textContent = '-Remove';
        removeMovementButton.classList.add('remove-button');
        removeMovementButton.addEventListener('click', function() {
            RemoveMovementElement(id)
        });
        removeMovementButton.type = "button";
        newInputWrapper.appendChild(removeMovementButton);

        var newSetButton = document.createElement('button');
        newSetButton.textContent = '+Set';
        newSetButton.addEventListener('click', function() {
            NewSetRow(id)
        });
        newSetButton.classList.add('add-button');
        newSetButton.type = "button"; // keeps it from submitting the form
        newInputWrapper.appendChild(newSetButton); // adds button to wrapper

        inputContainer.appendChild(newInputWrapper); // adds the div to the inputContainer
        
        fetch('endpoint.php').then(
                response =>(
                    response.text()
                )
            ).then(
                data=>(
                    document.getElementById(thisId).innerHTML = data
                )
        )
    }

    function RemoveMovementElement(conatinerId){
        document.getElementById(conatinerId).remove();
    }
