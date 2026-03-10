{{-- SUCCESS --}}
@if(session('success'))
    <div class="alert bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

{{-- ERROR --}}
@if(session('error'))
    <div class="alert bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-6">
        {{ session('error') }}
    </div>
@endif

{{-- WARNING --}}
@if(session('warning'))
    <div class="alert bg-yellow-100 border border-yellow-300 text-yellow-700 px-4 py-3 rounded mb-6">
        {{ session('warning') }}
    </div>
@endif

{{-- ERROS DE VALIDAÇÃO --}}
@if ($errors->any())
    <div class="container mx-auto px-4 pt-6">
        <div class="alert bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
