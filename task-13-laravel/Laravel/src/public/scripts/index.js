var data;
var current_page = 1;
var userTable = document.getElementById('userTable');
var tbody = document.createElement('tbody');
var page_count = 1;
var pages_required;

/*To fetch entire data and display first five record names.*/
const handleFetch = async () => {
    var pagination = document.getElementById('pagination');
    var nexEnable = document.getElementById('nexEnable');
    try {
        const response = await fetch('http://localhost:8000/api/host/users');
        if (!response.ok) {
            throw new Error(`error:${response.status}`);
        }
        data = await response.json();

        if (data) {
            console.log('Fetched data successfuly');

            pages_required = Math.ceil(data.length / 5);
            for (var p = 1; p <= pages_required; p++) {
                var li = document.createElement('li');
                var a = document.createElement('a');
                a.setAttribute('class', 'page-link');
                if (p == 1) {
                    li.setAttribute('class', 'page-item active');
                } else {
                    li.setAttribute('class', 'page-item');
                }
                a.setAttribute('onclick', `return handlePage(${p})`);
                a.setAttribute('href', `#page${p}`);
                a.innerHTML = p
                li.appendChild(a);
                pagination.insertBefore(li, nexEnable);
            }

            let total_entries = data.slice(0, 5);
            tbody.innerHTML += handleRows(total_entries);
            tbody.setAttribute('id', `page${page_count}`);
            userTable.appendChild(tbody);

        } else {
            console.log('Error occured while fetching the data');
            return false;
        }
    } catch (error) {
        console.log('error', error);
        return false;
    }

}

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

/*Generate rows for the userTable*/
function handleRows(total_entries) {
    var rows = ``;
    for (user of total_entries) {
        rows += `
        <tr>
        <td>${user.id}</td>
        <td>${user.name}</td>
        <td>${user.email}</td>
        <td>
            <form action="{{route('users.destroy', $user->id)}}" method="post">
                <button class="btn btn-danger" type="submit">Delete</button>
            </form> 
        </td>
        <td>
            <button onclick="return handleEdit(${user.id})" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modal">Edit</button>    
        </td>
            <td>
            <span onclick=handleAction(${user.id}) data-bs-toggle="modal" data-bs-target="#Modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                </svg>
            </span>
            </td>
      </tr>`
    }
    return rows;
}

/*To handle pagination*/
function handlePage(page) {
    var previous = document.getElementById('previous');
    var next = document.getElementById('next');
    var prevEnable = document.getElementById('prevEnable');
    var nexEnable = document.getElementById('nexEnable');


    if (page == 1) {
        prevEnable.setAttribute('class', 'page-item disabled');
    } else {
        prevEnable.setAttribute('class', 'page-item');
    }

    if (page == (data.length / 5)) {
        nexEnable.setAttribute('class', 'page-item disabled');
    } else {
        nexEnable.setAttribute('class', 'page-item');
    }

    if (!isNaN(page)) {
        var end, start;
        end = page * 5;
        start = end - 5;

        if(end > data.length){
            end = data.length;
        }

        total_entries = data.slice(start, end);
        tbody.innerHTML = '';
        tbody.innerHTML += handleRows(total_entries);
        tbody.setAttribute('id', `page${page_count}`);
        current_page = page;

        var pageLinks = document.querySelectorAll('.pagination .page-item');
        pageLinks.forEach(function (link) {
            link.classList.remove('active');
        });
        pageLinks[page].classList.add('active');

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


handleFetch();