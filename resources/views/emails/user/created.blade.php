<x-mail::message>
# Parabéns, {{ $name }} você já tem acesso a plataforma.

Para conseguir acessar o {{ config('app.name') }}, utilize a senha abaixo.

<x-mail::panel>
<strong>SENHA:</strong> {{ $password }}
</x-mail::panel>

<x-mail::button :url="$url">
Acessar a Plataforma
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
