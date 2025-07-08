    
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

