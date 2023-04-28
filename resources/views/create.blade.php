@extends ('layouts.main')

@section('title', 'Criar Produto - Inventory Control')

@section('content')
<div class="p-4 lg:p-10 flex flex-col">
    <div class="w-full max-w-md mx-auto">
        <h2 class="text-2xl font-bold">Novo Produto</h2>

        <form class="flex flex-col mt-4 gap-2" action="/produto/salvar" method="post">
            @csrf
            <input class="rounded-md" name="name" type="text" placeholder="Nome" />
            <input class="rounded-md" name="amount" type="number" placeholder="Preço (BRL)" />
            <input class="rounded-md" name="weight" type="number" placeholder="Peso (g)" />
            <input class="rounded-md bg-neutral-800 text-neutral-100 py-2" value="Pronto" type="submit" />
        </form>
    </div>
</div>
@endsection
