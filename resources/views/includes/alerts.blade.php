@if(session('success'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '{{ session("success") }}',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'error',
    title: '{{ session("error") }}',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true
});
</script>
@endif

@if(session('warning'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'warning',
    title: '{{ session("warning") }}',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true
});
</script>
@endif

@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Erro de validação',
    html: `{!! implode('<br>', $errors->all()) !!}`
});
</script>
@endif
