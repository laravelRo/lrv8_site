<style>
    .message {
        margin: 20px auto;
        padding: 10px;
        max-width: 500px;
        border: 1px solid grey;
        background-color: rgb(227, 227, 235);
        font-family: 'Verdana, sans-serif';
    }

    .message p {
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: left;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif'

    }

    .message ul li {
        list-style: none;
        margin-left: 20px;
        background-color: rgb(201, 236, 201);
        padding-bottom: 6px;
        border-bottom: 1px solid black;
    }

</style>

<div class="message">
    <h1>Mesaj nou de pe Web Design</h1>

    <p><b>Subiect: {{ $subject }}</b></p>
    <ul>
        <li><b>Numele utilizatorului:</b> {{ $name }}</li>
        <li><b>Email:</b> {{ $email }}</li>
        <li><b>Telefon:</b> {{ $phone }}</li>
    </ul>

    <p>
        {{ $mess }}
    </p>
</div>
