/*
 * Author: BloodyScythe
 * Version: 3
 * 
 * Changelog:
 * V3: Dropdown for easy selection of color combinations added
 * V2: Added copy button to quickly get the found fetchlands to your clipboard
 * V1: Implementation of selecting colors, assigning weight to corresponding
 *     fetchlands, sorting them by weight and printing them to screen
 */


window.addEventListener("load", () => {

    document.querySelector("#search").addEventListener("click", () => {

        //Make a copy of the full card list to manipulate later on
        cards = JSON.parse(JSON.stringify(actual_JSON));

        //Find out which colors have been selected
        let colors = getSelectedColorsFromDOM("color-selector-box");

        //Assign weights to the cards depending on the selection
        for (let i = 0; i < colors.length; i++) {
            let tmp_color = colors.substr(i, 1);
            for (let j = 0; j < cards.fetchlands.length; j++) {
                for (let fetchable_color of cards.fetchlands[j]["fetchable-colors"]) {
                    if (fetchable_color === tmp_color) {
                        cards.fetchlands[j].weight++;
                    }
                }
            }
        }

        //Sort cards by weight (highest to lowest)
        cards.fetchlands.sort((a, b) => { return (a.weight > b.weight) ? -1 : ((b.weight > a.weight) ? 1 : 0); });

        //******** DRAW ********
        emptyDOM(".result");
        draw("fetchlands", ".result");

    });

    document.querySelector(".color-preselector.selector").addEventListener("change", () => {
        //Deselect all colors
        document.querySelector(".color-selector-box.W").checked = false;
        document.querySelector(".color-selector-box.U").checked = false;
        document.querySelector(".color-selector-box.B").checked = false;
        document.querySelector(".color-selector-box.R").checked = false;
        document.querySelector(".color-selector-box.G").checked = false;

        //Receive colors from dropdown
        let colors = document.querySelector(".color-preselector.selector").value;

        //Check colors
        for (let i = 0; i < colors.length; i++) {
            let tmp_color = colors.substr(i, 1);
            document.querySelector(".color-selector-box." + tmp_color).checked = true;
        }
    });

});

//******** DO NOT CHANGE THIS ********
function loadJSON(path, callback) {

    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open("GET", path, true);
    xobj.onreadystatechange = function () {
        if (xobj.readyState == 4 && xobj.status == "200") {
            // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
            callback(xobj.responseText);
        }
    };
    xobj.send(null);
}

//Global Variables
let actual_JSON;
let cards;

loadJSON("cards.json", response => {
    // Parse JSON string into object
    actual_JSON = JSON.parse(response);
    //console.log(actual_JSON);
});

function getSelectedColorsFromDOM(domElem) {
    //Get selected colors from DOM and put them into a string like "WUBRG"
    selected_colors_dom = document.getElementsByClassName(domElem);
    selected_colors = "";
    for (let color of selected_colors_dom) {
        if (color.checked) {
            selected_colors += color.value.toUpperCase();
        }
    }
    return selected_colors;
}

function emptyDOM(domElem) {
    document.querySelector(domElem).innerHTML = "";
}

function draw(cardType, drawIn) {
    switch (cardType) {
        case "fetchlands":
            div = document.createElement("div");
            div.classList.add(cardType);
            document.querySelector(drawIn).appendChild(div);
            document.querySelector("." + cardType).innerHTML = getRelevantCards(cards, "<br/>");
            btn = document.createElement("button");
            document.querySelector(drawIn).appendChild(btn);
            btn.innerHTML = "Copy";
            btn.addEventListener("click", () => {
                copy();
                span = document.createElement("span");
                btn.after(span);
                span.innerHTML = "<br/>OK";
            });
        default:
            return false;
    }
}

function getRelevantCards(cards, separator) {
    let tmp = "";
    for (let i = 0; i < cards.fetchlands.length; i++) {
        if (cards.fetchlands[i].weight > 0) {
            tmp += cards.fetchlands[i].name + separator;
        }
    }
    return tmp;
}

function copy() {

    //Create temporary textfield element to store copyable data in
    let copyText = document.createElement("textarea");
    document.body.appendChild(copyText);

    //Set value of textarea to the text we want to copy
    copyText.value = getRelevantCards(cards, String.fromCharCode(13));

    //Select the textarea
    copyText.select();

    //Copy the text inside the textarea
    document.execCommand("copy");

    //Delete temporary textfield
    document.body.removeChild(copyText);
}