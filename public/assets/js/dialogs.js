const text = document.querySelector('.Dialogues');

    var iIndex = 0;
    var iTextPos = 0;
    var iArrLength = aText[0].length;
    var iScrollAt = 20;
    var iRow = 0;
    var sContents = "";
    var iSpeed = 50;

function typewriter() {
        sContents = ' ';
        iRow = Math.max(0, iIndex - iScrollAt);


        while (iRow < iIndex) {
            sContents += aText[iRow++] + '<br />';
        }
        destination.innerHTML = sContents + aText[iIndex].substring(0, iTextPos) + "_";
        if (iTextPos++ == iArrLength) {
            iTextPos = 0;
            iIndex++;
            if (iIndex != aText.length) {
                iArrLength = aText[iIndex].length;
                setTimeout(typewriter, 500);
            }
        } else {
            setTimeout(typewriter, iSpeed);
        }
    }

typewriter();
