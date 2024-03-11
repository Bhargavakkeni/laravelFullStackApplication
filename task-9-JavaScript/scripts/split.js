
function handleSplit() {
    number1 = document.getElementById('number1').value;
    number2 = document.getElementById('number2').value;
    result = document.getElementById('result');
    result.innerHTML = '';
    equal_split = Math.floor(number1 / number2);
    color_array = [
        'Sky Blue',
        'Pastel Pink',
        'Mint Green',
        'Lavender',
        ' Peach',
        'green',
        'yellow',
        'orange',
        'cyan'
    ]
    array = [];
    for (i = 1; i < number2; i++) {
        array.push(equal_split);
    }
    a = 0;
    sum = array.reduce((prevalue, a) => prevalue + a, 0);
    larger_split = number1 - sum;
    array.push(larger_split);

    for (j = (array.length - 1); j >= 0; j--) {
        if (array[j] % 10 == array[j]) {
            array[j] = array[j] * 10;
        }
        newele = `<div style="width: ${array[j]}%; background-color:
        ${color_array[(Math.floor(Math.random() * color_array.length))]}; 
        border: 2px solid black; height: 50px; color: black; text-align: center">${array[j] / 10}</div>`;
        result.innerHTML += newele;
    }
}