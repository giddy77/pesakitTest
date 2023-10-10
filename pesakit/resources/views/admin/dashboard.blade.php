<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>users</title>
</head>
<body>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">phone</th>
            <th scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    <a href="/edit" class="btn btn-primary">Details</a>
                </td>
              </tr>
            @empty
            <h5>no user found</h5>
            @endforelse

        </tbody>
      </table>

</body>
</html>

