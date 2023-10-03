<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Post</title>
</head>
<body>
    <h1>
        Crear Post
    </h1>

    @if ($errors->any())
        @foreach ($errors->all() as $e)
            <div class="errors">
                {{$e}}
            </div>
        @endforeach
    @endif

    <form action="{{ route('post.store') }}" style="display:flex; flex-direction:column; width:25rem" method="post">
        @csrf

        <label for="title">Título</label>
        <input type="text" name="title">

        <label for="slug">Slug</label>
        <input type="text" name="slug">

        <label for="category_id">Categoría</label>
        <select name="category_id">
            <option value=""></option>
            @foreach ($categories as $title => $id)
                <option value="{{ $id }}"> {{ $title}} </option>
            @endforeach
        </select>
        
        <label for="posted">Posteado</label>
        <select name="posted">
            <option value="not">No</option>
            <option value="yes">Si</option>
        </select>

        <label for="content"></label>
        <textarea name="content"></textarea>

        <label for="description"></label>
        <textarea name="description"></textarea>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>