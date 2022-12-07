<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Matricule Mass</title>
</head>
<body>
    <form action="{{ route('mat.store') }}" method="post">
    <textarea name="matricule" id="" cols="60" rows="20"></textarea>
    <input type="submit" value="Ajouter Matricule Masse">
    </form>

</body>
</html>