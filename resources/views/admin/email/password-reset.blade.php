<style>
    p {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 1.1em;
        line-height: 1.6em;
    }

</style>

<div style="max-width: 400px; margin:30 auto; padding: 30px;">
    <h1>Link pentru resetarea parolei pe situl <span style="color:red">site.test</span></h1>

    <p> Acest link este valabil 60 de minute</p>

    <a style="padding:8px 10px; display:block; text-align:center; min-width:150px; color:white; background-color:rgb(32, 32, 51);"
        href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}">Link resetare parola</a>

    <p>Daca butonul de mai sus nu functioneaza puteti lua cu copy si paste linkul de mai jos:</p>

    {{ route('password.reset', ['token' => $token, 'email' => $email]) }}

</div>
