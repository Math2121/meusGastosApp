<div>
    <x-slot name="header">
        Meus Registros
    </x-slot>
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Descrição</td>
                <td>Valor</td>
                <td>Data Registro</td>
            </tr>
        </thead>
    <tbody>
        @foreach ($expenses as $exp)
            
     
        <tr>
            <td>{{$exp->id}}</td>
            <td>{{$exp->description}}</td>
            <td>{{$exp->amount}}</td>
            <td>{{$exp->created_at->format('d/m/Y')}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
