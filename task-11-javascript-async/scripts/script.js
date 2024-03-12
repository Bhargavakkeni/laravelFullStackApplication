var data;
var current_page = 1;
var userTable = document.getElementById('userTable');
var tbody = document.createElement('tbody');
var page_count = 1;

const handleFetch = async () => {
    var row_count = 1;
    try {
        const response = await fetch('https://gorest.co.in/public/v2/users');
        if (!response.ok) {
            throw new Error(`error:${response.status}`);
        }
        data = await response.json();
        if (data) {
            //console.log('data inside handlefetch', data);
            console.log('Fetched data successfuly');

            for (i of data) {
                tbody.innerHTML += `
                <tr>
                    <td>${i.name}</td>
                    <td>
                    <span onclick=handleAction(${i.id}) data-bs-toggle="modal" data-bs-target="#Modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                        </svg>
                    </span>
                    </td>
              </tr>`

                if (row_count == 5) {
                    tbody.setAttribute('id', `page${page_count}`);
                    userTable.appendChild(tbody);
                    break;
                } else {
                    row_count++;
                }
            }

        } else {
            console.log('Error occured while fetching the data');
            return false;
        }
    } catch (error) {
        console.log('error', error);
        return false;
    }

}

handleFetch();

async function handleAction(id) {
    var content = document.getElementById('content');
    content.innerHTML = '';
    try {
        const response = await fetch(`https://gorest.co.in/public/v2/users/${id}`);

        if (!response.ok) {
            throw new Error(`error: ${response.status}`);
        }

        const data = await response.json();

        if (data) {
            for (i in data) {
                content.innerHTML += `<dt>${i}</dt><dd>${data[i]}</dd>`;
            }


        } else {
            throw new Error('Error while fetching the data');
        }
    } catch (error) {
        console.log('Error', error);
    }
}

function handlePage(page) {
    var previous = document.getElementById('previous');
    var next = document.getElementById('next');
    var prevEnable = document.getElementById('prevEnable');
    var nexEnable = document.getElementById('nexEnable');

    if(page == 1) {
        prevEnable.setAttribute('class', 'page-item disabled');
    } else {
        prevEnable.setAttribute('class', 'page-item');
    }

    if(page == (data.length / 5)) {
        nexEnable.setAttribute('class', 'page-item disabled');
    } else {
        nexEnable.setAttribute('class', 'page-item');
    }

    if (!isNaN(page)) {
        var end, start;
        end = page * 5;
        start = end - 5;
        total_entries = data.slice(start, end);
        tbody.innerHTML = '';
        for (j of total_entries) {
            tbody.innerHTML += `
            <tr>
                <td>${j.name}</td>
                <td>
                <span onclick=handleAction(${j.id}) data-bs-toggle="modal" data-bs-target="#Modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                    </svg>
                </span>
                </td>
          </tr>`
        }
        tbody.setAttribute('id', `page${page_count}`);
        current_page = page;

    } else if (page == 'previous') {
        current_page--;
        if (current_page != 0) {
            previous.setAttribute('href', `#page${current_page}`);
            handlePage(current_page);
        } else {
            return false;
        }
    } else if (page == 'next') {
        current_page++;
        if (current_page <= (data.length / 5)) {
            next.setAttribute('href', `#page${current_page}`);
            handlePage(current_page);
        } else {
            return false;
        }

    }
}