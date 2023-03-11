<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name">

    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea>

    <button type="submit">Create Category</button>
</form>
