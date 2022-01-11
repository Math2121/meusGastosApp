<!--wire:model - data binding -->
<div class="py-4">
    <x-slot name="header">
        Atualizar Registro
    </x-slot>
    <hr>
    @if (session()->has('message'))
        <h5>{{ session('message') }}</h5>
    @endif

    <form method="post" wire:submit.prevent="updateExpense">

        <p>
            <label for="">Descrição</label>
            <input type="text" name="description" class="shadow border-t" wire:model="description">
            @error('description')
            <p>{{ $message }}</p>
        @enderror
        </p>
        <p>
            <label for="amount">Valor Registro</label>
            <input type="text" name="amount" class="shadow border-t" wire:model="amount">
            @error('amount')
            <p>{{ $message }}</p>
        @enderror
        </p>
        <p>
            <label for="type">Tipo do Registro</label>
            <select type="text" name="type" class="shadow border-t" wire:model="type">
                <option value="">Selecione o tipo do resgistro</option>
                <option value="1">Entrada</option>
                <option value="2">Saída</option>
            </select>
            @error('type')
            <p>{{ $message }}</p>
        @enderror
        </p>
        <button type="submit">Atualizar Registro</button>
    </form>
</div>
