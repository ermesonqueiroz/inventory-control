@extends ('layouts.main')

@section('title')
 {{ $product?->name }} - Inventory Control
@endsection

@section('content')
<div class="p-4 lg:p-10 flex flex-col">
    <h1 class="text-2xl font-bold">Produto</h2>
    <div class="w-full mx-auto">
        <form
            class="flex flex-col mt-4 gap-2"
            id="update"
            action="/produto/salvar"
            method="POST"
        >
            @csrf
            @method('PUT')
            <label for="">Código</label>
            <input
                class="rounded-md"
                name="code"
                type="text"
                placeholder="Código"
                value="{{ $product?->code }}"
                readonly
            />
            <label for="">Nome</label>
            <input
                class="rounded-md"
                name="name"
                type="text"
                placeholder="Nome"
                value="{{ $product?->name }}"
            />
            <label for="">Preço (BRL)</label>
            <input
                class="rounded-md"
                name="amount"
                type="number"
                placeholder="Preço"
                value="{{ $product?->amount }}"
            />
            <label for="">Peso (g)</label>
            <input
                class="rounded-md"
                name="weight"
                type="number"
                placeholder="Peso"
                value="{{ $product?->weight }}"
            />
        </form>

        <form
            id="disable"
            action="/produto/{{ $product->code }}/{{ $product->active ? 'desativar' : 'ativar' }}"
            method="POST"
        >
            @csrf
            @method('PUT')
        </form>

        <form
            id="delete"
            action="/produto/{{ $product->code }}/excluir"
            method="POST"
        >
            @csrf
            @method('DELETE')
        </form>

        <div class="flex flex-col mt-4">
            <span class="flex gap-4">
                <button
                    class="rounded-md bg-neutral-800 text-neutral-100 py-2 flex-1"
                    type="submit"
                    form="update"
                >
                    Atualizar
                </button>
                @if($product->active)
                    <button form="disable" class="rounded-md bg-orange-500 text-neutral-100 py-2 flex-1">
                        Desativar
                    </button>
                @else
                    <button form="disable" class="rounded-md bg-blue-500 text-neutral-100 py-2 flex-1">
                        Ativar
                    </button>
                @endif
            </span>
            <button
                class="rounded-md mt-2 bg-red-500 text-neutral-100 py-2 flex-1"
                form="delete"
            >
                Excluir
            </button>
        </div>
    </div>
</div>
@endsection
