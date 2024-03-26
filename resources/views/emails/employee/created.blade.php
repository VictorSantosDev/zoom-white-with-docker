<x-mail::message>
# Olá, {{ $name }}.

Utilize as credenciais abaixo para ter acessar ao sistema de gerenciamento dos veículos dentro da plataforma {{ config('app.name') }}.

<x-mail::panel>
<strong>REGISTRATION:</strong> {{ $registration }}
<br />
<strong>SENHA:</strong> {{ $password }}
<br />
<hr/>
<br />
<strong style="color: #5bc0de">
    Com esse acesso você consegue se logar na plataforma {{ config('app.name') }} para adicionar os veículos.
<br />
    <span style="color: #bb2124">Esse acesso é unico e exclusivo para o usuário administrador, não compartilhe com terceiros.</span>
</strong>
</x-mail::panel>

<x-mail::button :url="$url">
Acessar a Plataforma
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
