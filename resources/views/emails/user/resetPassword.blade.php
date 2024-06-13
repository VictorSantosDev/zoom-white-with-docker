<x-mail::message>
# Olá, <span style="color: #5bc0de">{{ $name }}</span> recebemos uma solicitação para redefinição de senha no sistema <span style="color: #001c28">{{ config('app.name') }}</span>.

<span style="color: #001c28">Caso você não tenha solicitado a redefinição de senha, por favor ignore esse email!</span>

Para conseguir redefinir a senha clique no botão abaixo.

<x-mail::panel>
<strong>Solicitação para email {{ $email }}</strong>
<br/>
</x-mail::panel>

<x-mail::button :url="$url">
Redefinir a senha
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
