<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <form action="{{ route('test') }}" method="POST">
        @csrf
        <input type="file" name="image" id="">
        <input type="submit">
    </form>
</div>
<div>
    {{ storage_path('profiles')."\CLz7BNEzMSZtVARaFsSAdgFp1vSs6iBYLucM2flIoN9K46kiFkt0wIhtXP0ZyOLsho9GqNDV297BF6kk06DUrCCWzupvmu1hgWLp1630001244.png" }}
    <img src="" alt="">
</div>
</body>
</html>
