@php
    $userHasAccepted = false;

    if (auth()->check()) {
        $userHasAccepted = DB::table('cookie_consents')
            ->where('user_id', auth()->id())
            ->exists();
    }
@endphp

<!-- Aviso de Cookies -->
<div id="cookie-notice" style="
    display: none;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: #5B437F; /* morado sobrio */
    color: #ffffff;
    padding: 20px;
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    text-align: center;
    z-index: 9999;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 12px;
    line-height: 1.5;
">
    <span>
        Usamos cookies para mejorar tu experiencia en el sitio. 
        <a href="{{ url('page/politica-de-cookies-y-tecnologias-de-seguimiento') }}" 
           style="color: #B4D241; text-decoration: underline; font-weight: 500;" 
           target="_blank">
            Ver política de cookies.
        </a>
    </span>

    <button id="accept-cookies" style="
        background: #B4D241;
        color: #5B437F;
        border: none;
        padding: 10px 18px;
        font-size: 15px;
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.3s ease;
    ">
        Aceptar
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const banner = document.getElementById('cookie-notice');
        const btn = document.getElementById('accept-cookies');

        @if (!auth()->check())
            if (!localStorage.getItem('cookiesAccepted')) {
                banner.style.display = 'flex';
            }
        @elseif (!$userHasAccepted)
            banner.style.display = 'flex';
        @endif

        btn.addEventListener('click', function () {
            localStorage.setItem('cookiesAccepted', 'true');

            fetch('{{ route('cookies.accept') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({})
            }).catch(() => {
                console.warn('No se pudo registrar la aceptación en el servidor (posiblemente usuario no autenticado)');
            });

            banner.style.display = 'none';
        });
    });

    console.log('Aviso de cookies cargado');
</script>