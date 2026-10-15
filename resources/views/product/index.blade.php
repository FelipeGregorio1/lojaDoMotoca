<table border="1">
@foreach($products as $p)
    <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->price }}</td>
        <td>{{ $p->Category?->name }}</td>
        <td><a href="/product/edit/{{$p->id}}">Editar</a></td>
        <td><a href="/product/delete/{{$p->id}}">Deletar</a></td>
    </tr>
@endforeach
</table>