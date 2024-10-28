<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Banks') }}
            </h2>
            <a href="{{ route('admin.package_banks.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
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
                
                @forelse ($banks as $bank)
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ $bank->logo }}" alt="" class="rounded-2xl object-cover w-[90px] h-[90px]">
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Bank Name</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $bank->bank_name }}</h3>
                        </div>
                    </div> 
                    <div  class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Date</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $bank->created_at->format('M d, Y') }}</h3>
                    </div>
                    <div class="hidden md:flex flex-row items-center gap-x-3" x-data="{ showConfirmation: null }">
                        <a href="{{ route('admin.package_banks.edit', $bank) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.package_banks.destroy', $bank) }}" method="POST" x-on:submit.prevent="if(showConfirmation) $el.submit()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" x-on:click="showConfirmation = confirm('Yakin ingin menghapus data?')" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <p>Belum ada ada bank terbaru</p>
                    
                @endforelse
                

            </div>
        </div>
    </div>
</x-app-layout>
