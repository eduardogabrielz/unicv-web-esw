<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body class="p-5">
    <h1>Listagem de Usuarios</h1>
    @if (session('mensagem'))
      <div class="alert alert-success">{{ session('mensagem') }}</div>
    @endif
    <p><a href="/usuarios/novo" class="btn btn-dark">Novo Usuario</a></p>
    <table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Idade</th>
            <th>Telefone</th>
        </tr>
    </thead>
        <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nome }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->idade }}</td>
                <td>{{ $usuario->telefone }}</td>
                <td>
                  <a href="/usuarios/{{ $usuario->id }}" class="btn btn-info">Visualizar</a>
                  <a href="/usuarios/editar/{{ $usuario->id }}" class="btn btn-warning">Editar</a>
                  <a href="/usuarios/excluir/{{ $usuario->id }}" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>