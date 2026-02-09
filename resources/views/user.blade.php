<!DOCTYPE html>
<html>
<head>
    <title>User Portal</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body>

<div class="container">
    <h1>User Portal</h1>

    <table id="dataTable">
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Name</th>
                <th>Shape/Color</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
function loadData(){
    fetch('/get-items')
    .then(res=>res.json())
    .then(data=>{
        let tbody='';
        data.forEach(d=>{
            tbody+=`
            <tr>
                <td>${d.custom_time}</td>
                <td>${d.name}</td>
                <td>
                    <span class="color-dot" style="background:${d.color}"></span>
                    ${d.shape} (${d.color})
                </td>
            </tr>`;
        });
        document.querySelector('#dataTable tbody').innerHTML=tbody;
    });
}

setInterval(loadData,2000);
loadData();
</script>

</body>
</html>
