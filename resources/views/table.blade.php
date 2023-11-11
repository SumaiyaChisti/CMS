<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>


    <title>Document</title>
</head>
<body>
 
    @include('navbar');
 

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <table class="table">
      <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Roll no</th>
            <th scope="col">Class</th>
            <th scope="col">Parentage</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col" colspan="2">Options</th>

        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->Name}}</td>
            <td>{{$user->Rollno}}</td>
            <td>{{$user->Class}}</td>
            <td>{{$user->Parentage}}</td>
            <td>{{$user->Address}}</td>
            <td>{{$user->Phone}}</td>
            <td><a href="update/{{$user->id}}" class="btn btn-success">Update</a></td>
            <td><a href="delete/{{$user->id}}" class="btn btn-danger">Delete</a></td>
            
          </tr>
          @endforeach
        </tbody>
      </table>
     

  </div>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
      <script> var table = new DataTable("table")</script>;
</body>
</html>