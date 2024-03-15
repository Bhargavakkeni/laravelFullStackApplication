
function handleSplit() {
/* handleSplit() function splits a number into number of times of another given number and
 appends a div with respective widths.*/

    var number1 = document.getElementById('number1').value;
    var number2 = document.getElementById('number2').value;
    var result = document.getElementById('result');
    var sum, equal_split, larger_split, width, newdiv, color_count = 0;
    var array = [];
    var color_array = [
        "#FAFAFA",
        "#FFFFCC",
        "#E6E6FA",
        "#F0FFFF",
        "#FFFAF0",
        "#FFE4B5",
        "#F8F8FF",
        "#F0FFF0",
        "#FFF5EE",
        "#F5FFFA",
        "#F0F8FF",
        "#F0E68C",
        "#FFDAB9",
        "#FFF8DC",
        "#FFE4E1",
        "#FFFACD",
        "#1E1E1E",
        "#2C2C2C",
        "#3A3A3A",
        "#4C4C4C",
        "#555555",
        "#666666",
        "#777777",
        "#888888",
        "#999999",
        "#AAAAAA",
        "#FFFFFF",
        "#F5F5F5",
        "#EDEDED",
    ];
    number1 = Number(number1);
    number2 = Number(number2);

    if (number2 > number1 || number2 == 0 || number2 < 0) {
        alert("Please enter a positive number that is less than or equal to first number.");
        return false;
    }

    result.innerHTML = '';
    equal_split = Math.floor(number1 / number2);

    //pushes the equal_split into the array until number2-1 times.
    for (i = 1; i < number2; i++) {
        array.push(equal_split);
    }

    sum = array.reduce((prevalue, a) => prevalue + a, 0);
    larger_split = number1 - sum;
    array.push(larger_split);

    //Creates a new div element with width equal to array elements in reverse order.
    for (j = (array.length - 1); j >= 0; j--) {
        //console.log(j, array[j]);
        if(color_count == 25){
            color_count = 0;
        } else {
            color_count++;
        }

        width = array[j] * 10;

        newdiv = document.createElement('div');
        newdiv.setAttribute('class', 'addon');
        newdiv.setAttribute('style', `width: ${width}%;  background-color: ${color_array[color_count]};`);
        newdiv.innerHTML += array[j];
        result.appendChild(newdiv);


       /* newdiv = `
        <div class="addon" style="width: ${width}%; background-color: ${color_array[color_count]};">
        ${array[j]}
        </div>
        `;
        result.innerHTML += newdiv;*/

    }
}