<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('download-vcf')}}" method="post">
        @csrf
        <input name="name" type="text">
        <input name="email" type="text">
        <input name="jobtitle" type="text">
        <input name="company" type="text">
        <input name="address" type="text">
        <input name="phone" type="text">
        <button>Submit</button>
    </form>
</body>
</html>