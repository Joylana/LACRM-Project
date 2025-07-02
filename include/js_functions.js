    
    function ShowText(selectedValue,elementId){ //show new workout form
        if (selectedValue === "new") {
            const element = document.getElementById(elementId);
            element.classList.add('surprisetext');
        }else{
            HidePopup(elementId)
        }
    }
    function HidePopup(elementId){ // function to hide new workout form
            const element = document.getElementById(elementId);

            element.classList.remove('surprisetext');
        
    }