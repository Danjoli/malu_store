@php
    $alerts = collect([
        session('success') ? ['type' => 'success', 'message' => session('success')] : null,
        session('error')   ? ['type' => 'error',   'message' => session('error')]   : null,
        session('warning') ? ['type' => 'warning', 'message' => session('warning')] : null,
    ])->filter();

    $validationErrors = (isset($errors) && $errors instanceof \Illuminate\Support\MessageBag && $errors->any())
        ? $errors->all()
        : [];
@endphp

@if($alerts->isNotEmpty() || count($validationErrors))
<script>
document.addEventListener('DOMContentLoaded', async function () {

    const alerts = @json($alerts);
    const errors = @json($validationErrors);

    // Mostra alerts (fila para não travar UI)
    for (const alert of alerts) {
        await Swal.fire({
            toast: true,
            position: 'top-end',
            icon: alert.type,
            title: alert.message,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }

    // Erros de validação (apenas 1 modal)
    if (errors.length) {
        Swal.fire({
            icon: 'error',
            title: 'Erro de validação',
            html: errors.join('<br>'),
            confirmButtonColor: '#3085d6'
        });
    }

});
</script>
@endif
