<html>
<head>
    <title>Add new car</title>
</head>
<body>
<h2>Add new car</h2>
<form method="POST" action="/car">
    {{csrf_field()}}

    car make<input type="text" required name="make" id="make"/><br>
    car model<input type="text" required name="model" id="model"/><br>
    produced on<input type="date" required name="produced_on" id="produced_on"/><br>

    <input type="submit" name="submit_btn"value="Save">

</form>


</body>
</html>
