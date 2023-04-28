@extends ('layouts.main')

@section('title', 'Inventory Control')

@section('content')
<div class="p-4 lg:p-10 flex flex-col">
    <div class="w-full">
        <span class="flex w-full justify-between items-center">
            <h2 class="text-2xl font-bold">Produtos</h2>

            <a href="/produto/criar" class="p-2 hover:bg-neutral-100 transition-colors rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-square"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect><line x1="12" x2="12" y1="8" y2="16"></line><line x1="8" x2="16" y1="12" y2="12"></line></svg>
            </a>
        </span>

        <div class="grid grid-cols-4 gap-4 flex-wrap pt-4">
            @foreach ($products as $product)
                <button id="product" code="{{ $product->code }}" class="flex flex-col items-start p-4 border-4 transition-colors {{ $product->active ? 'bg-zinc-800 border-zinc-800' : 'bg-zinc-400 border-zinc-400' }} text-neutral-100 rounded-md">
                    <span class="flex justify-between w-full">
                        <h3 class="text-xl font-bold">{{ $product->name }}</h3>
                        <a href="/{{ $product->code }}" class="p-2 hover:bg-zinc-700 transition-colors rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>
                    </span>
                    <p class="text-xs">#{{ $product->code }}</p>
                </button>
            @endforeach
        </div>
    </div>
</div>
<div id="products-actions" class="flex transition-all invisible flex-col gap-2 absolute bottom-4 right-4 max-w-xs w-full">
    <form
        id="disable-many"
        action="/produtos/desativar"
        method="POST"
    >
        @csrf
        @method('PUT')
        <input type="hidden" id="products-to-disable" name="products" />
    </form>
    <form
        id="enable-many"
        action="/produtos/ativar"
        method="POST"
    >
        @csrf
        @method('PUT')
        <input type="hidden" id="products-to-enable" name="products" />
    </form>
    <form
        id="delete-many"
        action="/produtos/excluir"
        method="POST"
    >
        @csrf
        @method('DELETE')
        <input type="hidden" id="products-to-delete" name="products" />
    </form>

    <button form="enable-many" class="rounded-md bg-blue-500 text-neutral-100 py-2 flex-1">
        Ativar
    </button>
    <button form="disable-many" class="rounded-md bg-orange-500 text-neutral-100 py-2 flex-1">
        Desativar
    </button>
    <button
        class="rounded-md bg-red-500 text-neutral-100 py-2 flex-1"
        form="delete-many"
    >
        Excluir
    </button>
</div>
<script>
    let selectedProducts = []
    const productsActionsContainer = document.querySelector('#products-actions')
    const productsToDisable = document.querySelector('#products-to-disable')
    const productsToEnable = document.querySelector('#products-to-enable')
    const productsToDelete = document.querySelector('#products-to-delete')

    document
        .querySelectorAll('#product')
        .forEach(button => {
            const code = button.getAttribute('code')

            button.addEventListener('click', (e) => {
                if (selectedProducts.includes(code)) {
                    selectedProducts.splice(selectedProducts.indexOf(code))
                    button.classList.remove('selected')
                } else {
                    console.log(code)
                    selectedProducts.push(code)
                    button.classList.add('selected')
                }

                productsToDisable.value = selectedProducts
                productsToEnable.value = selectedProducts
                productsToDelete.value = selectedProducts

                if (selectedProducts.length > 0) {
                    productsActionsContainer.classList.remove('invisible')
                } else {
                    productsActionsContainer.classList.add('invisible')
                }
            })
        })
</script>
@endsection
