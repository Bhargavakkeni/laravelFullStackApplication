async function handleEdit(id){

    var content = document.getElementById('content');
    content.innerHTML = '';
    try {
        const response = await fetch(`http://localhost:8000/api/host/users/${id}`);

        if (!response.ok) {
            throw new Error(`error: ${response.status}`);
        }

        const data = await response.json();

        console.log(data);

        if (data) {
                content.innerHTML += `
                <form action="http://localhost:8000/api/host/users/${data['id']}" method="PUT">
                <label for='id'>Id</label>
                <input type="number" value="${data['id']}" class="form-control" id="id" readonly>
                <label for="name">Name</label>
                <input type="text" value="${data['name']}" name="name" class="form-control" id="name">
                <label for=email>Email</label>
                <input type="email" value="${data['email']}" name="email" class="form-control" id="email">
                <label for="gender">Gender</label>
                <input type="text" value="${data['gender']}" name="gender" class="form-control" id="gender">
                <input type="submit" class="btn btn-danger">
                `;

        } else {
            throw new Error('Error while fetching the data');
        }
    } catch (error) {
        console.log('Error', error);
    }
    
}