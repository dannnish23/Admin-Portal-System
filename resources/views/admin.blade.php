<!DOCTYPE html>
<html>
<head>
    <title>Admin Portal</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="container">

    <!-- TOP BAR -->
    <div class="topbar">

        <div>
            <h1>Admin Portal</h1>
            <span class="breadcrumb">Dashboard / Admin Portal</span>
        </div>

        <div class="header-actions">
            <a href="/user" class="btn view-btn">View User Portal</a>

            <form method="POST" action="/logout">
                @csrf
                <button class="btn logout-btn">Logout</button>
            </form>
        </div>

    </div>

    @if(session('success'))
        <div class="success-box">Success! {{ session('success') }}</div>
    @endif


    @if ($errors->any())
    <div class="error-box">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">

        <h2>Add Item</h2>

        <form method="POST" action="{{ isset($item) ? '/update/'.$item->id : '/add' }}">
            @csrf
            <input type="hidden" name="id" id="editId" value="{{ $item->id ?? '' }}">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control"
                value="{{ old('name', isset($item)?$item->name:'') }}">
            </div>

            <div class="form-group">
                <label>Shape</label>
                <select name="shape" class="form-control">
                    @foreach(['Triangle','Square','Circle'] as $shape)
                    <option value="{{ $shape }}"
                    {{ old('shape', isset($item)?$item->shape:'')==$shape?'selected':'' }}>
                    {{ $shape }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Color</label>
                <select name="color" class="form-control">
                    @foreach(['red','blue','green','yellow'] as $color)
                    <option value="{{ $color }}"
                    {{ old('color', isset($item)?$item->color:'')==$color?'selected':'' }}>
                    {{ $color }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Timestamp</label>
                <input type="datetime-local" name="custom_time" class="form-control"
                value="{{ old('custom_time', isset($item)?date('Y-m-d\TH:i',strtotime($item->custom_time)):'') }}">
            </div>

            <div class="btn-group">
                <button id="submitBtn" class="{{ isset($item) ? 'btn update-btn' : 'btn add-btn' }}">
                {{ isset($item) ? 'Update' : 'Add' }}
                </button>

                <button type="button" class="btn reset-btn" onclick="resetForm()">Reset</button>
            </div>

        </form>

        <table>
            <tr>
                <th>Name</th>
                <th>Shape</th>
                <th>Color</th>
                <th>Time</th>
                <th>Action</th>
            </tr>

            @foreach($items as $i)
            <tr>
                <td>{{ $i->name }}</td>
                <td>{{ $i->shape }}</td>
                <td>
                    <span class="color-badge {{ $i->color }}"></span>
                    {{ $i->color }}
                </td>
                <td>{{ $i->custom_time }}</td>
                <td>
                    <a href="/edit/{{ $i->id }}" class="btn edit-btn">Edit</a>
                    <a href="/delete/{{ $i->id }}" class="btn delete-btn">Delete</a>
                </td>
            </tr>
            @endforeach

        </table>

        @if(isset($item))
        <div class="editing-box">
        • Currently editing: <strong>{{ $item->name }}</strong>
        </div>
        @endif


    </div>

</div>

<script>
function resetForm(){

    document.querySelector('input[name="name"]').value = '';
    document.querySelector('select[name="shape"]').value = '';
    document.querySelector('select[name="color"]').value = '';
    document.querySelector('input[name="timestamp"]').value = '';

    // Remove editing status
    let status = document.getElementById('editStatus');
    if(status) status.innerHTML = '';

    // Change button back to ADD visually
    let btn = document.getElementById('submitBtn');
    btn.innerText = "Add";
    btn.classList.remove('update-btn');
    btn.classList.add('add-btn');

    // Clear hidden ID if exists
    let idField = document.getElementById('editId');
    if(idField) idField.value = '';
}
</script>

</body>
</html>