// Animation en JS pour que les dialogues s'écrivent comme uen "machine à écrire" : le code simule la frappe du texte lettre par lettre.

// à voir si on utilise plutôt la librairie Sheperdjs pour faire cette animation

    // on initialise les différentes variables pour suivre la frappe progressive du texte :

var iIndex = 0; 
var iTextPos = 0;
var aText = [
                "Oh un tableau électrique ! Je vais pouvoir rallumer la lumière ! Des instructions ont été laissé pour me guider."
            ]; 
var iArrLength = aText[0].length; 
var iScrollAt = 20;
var iRow = 0; 
var sContents = ""; 
var iSpeed = 50;

// La fonction typewriter() est responsable de faire défiler et afficher le texte sur la page. 

function typewriter() 
{
        sContents = ' ';
        iRow = Math.max(0, iIndex - iScrollAt);
        var destination = document.getElementById("typedtext");
        
        while (iRow < iIndex) 
        {
            sContents += aText[iRow++] + '<br />';
        }

        destination.innerHTML = sContents + aText[iIndex].substring(0, iTextPos) + "_";
        if (iTextPos++ == iArrLength) 
        {
            iTextPos = 0;
            iIndex++;
            if (iIndex != aText.length) 
            {
                iArrLength = aText[iIndex].length;
                setTimeout(typewriter, 500);
            }
        } else {
            setTimeout(typewriter, iSpeed);
        }
    }
    
            
typewriter();
                