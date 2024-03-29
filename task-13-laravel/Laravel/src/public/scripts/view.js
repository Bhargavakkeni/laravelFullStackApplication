/*To handle view more action display additional details associated with id*/
async function handleAction(id) {
    var content = document.getElementById('content');
    content.innerHTML = '';
    try {
        const response = await fetch(`http://localhost:8000/api/host/users/${id}`);

        if (!response.ok) {
            throw new Error(`error: ${response.status}`);
        }

        const data = await response.json();

        if (data) {
            for (i in data) {
                content.innerHTML += `<dt>${i.charAt(0).toUpperCase() + i.slice(1)}</dt><dd>${data[i]}</dd>`;
            }


        } else {
            throw new Error('Error while fetching the data');
        }
    } catch (error) {
        console.log('Error', error);
    }
}