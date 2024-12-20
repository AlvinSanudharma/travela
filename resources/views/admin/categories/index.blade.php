<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    @if (session('success'))
         <x-success-alert :message="session('success')"  />
    @endif
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse ($categories as $category)
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        @if ($category->icon)
                        <img src="{{ $category->icon }}" alt="" class="rounded-2xl object-cover w-[90px] h-[90px]">     
                        @else
                        <img src="https://ui-avatars.com/api/?name=Category+Image" alt="" class="rounded-2xl object-cover w-[90px] h-[90px]">      
                        @endif
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Name</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $category->name }}</h3>
                        </div>
                    </div> 
                    <div  class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Date</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $category->created_at->format('M d, Y') }}</h3>
                    </div>
                    <div class="hidden md:flex flex-row items-center gap-x-3" x-data="{ showConfirmation: null }">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" x-on:submit.prevent="if(showConfirmation) $el.submit()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" x-on:click="showConfirmation = confirm('Yakin ingin menghapus data?')" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                    <p>Belum ada ada kategori terbaru</p>
                @endforelse
                

            </div>
        </div>
    </div>
</x-app-layout>
