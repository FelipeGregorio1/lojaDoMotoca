<table border="1">
@foreach($categories as $c)
    <tr>
        <td>{{ $c->name }}</td>
        <td>{{ $c->Products->Count() }}</td>
        <td><a href="/category/edit/{{$c->id}}">Editar</a></td>
        <td><a href="/category/delete/{{$c->id}}">Deletar</a></td>
    </tr>
@endforeach
</table>