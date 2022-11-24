<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <!-- Add form start -->
            <form id="add_user">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email </label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Phone No.</label>
                    <input type="tel" name="phone" class="form-control" id="exampleInputEmail1">
                </div>
                <button type="submit" class="btn btn-primary mt-2 mb-5">Submit</button>
            </form>
              <!-- Add form end -->

            <!-- user table -->
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user )
                        <tr>
                            <td>{{ filter_var($user->name) }}</td>
                            <td>{{ filter_var($user->email)  }}</td>
                            <td>{{ filter_var($user->phone)  }}</td>
                            <td><button id="edit_user" type="button" data-id="{{ filter_var($user->id)  }}"
                                    class="btn btn-primary mb-2">Edit</button>
                                <button data-id="{{ filter_var($user->id)  }}"  id="delete_user" class="btn btn-danger">Delete</button></td>
                        </tr>
                    @endforeach
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="edit_user_model" tabindex="-1" role="dialog" aria-labelledby="modal-form"
        aria-hidden="true">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        // base url
        var base_url = window.location.origin;

        // create user
        $(document).on('submit', '#add_user', function (event) {
            event.preventDefault();
            var route = base_url + '/api/users';
            axios.post(route, $(this).serialize()).then(function (response) {
                if (response.data.status == true) {
                    alert(response.data.message);
                    location.reload();
                } else{
                    alert(response.data.message);

                }
            });
        });

        // edit model open
        $(document).on('click', "[id='edit_user']", function (event) {
            var id = $(this).attr('data-id');
            var route = "{{ route('edit.user',":id") }}";
            route = route.replace(':id', id)
            axios.get(route).then(function (response) {
                $('#edit_user_model').html(response.data);
                $('#edit_user_model').modal('toggle').addClass('show');
            })
        });

        // update user
        $(document).on('submit', '#update_user', function (event) {
            event.preventDefault();
            var id = $('#edit_id').val();
            var route = base_url + '/api/users/' + id;
            axios.put(route, $(this).serialize()).then(function (response) {
                if (response.data.status == true) {
                    alert(response.data.message);
                    $('#edit_user_model').modal('toggle').removeClass('show');
                    location.reload();
                } else{
                    alert(response.data.message);

                }
            });
        });

        // delete user
        $(document).on('click', '#delete_user', function (event) {
            event.preventDefault();
            var id = $(this).attr('data-id');
            var route = base_url + '/api/users/' + id;
            axios.delete(route).then(function (response) {
                if (response.data.status == true) {
                    alert(response.data.message);
                    location.reload();
                } else{
                    alert(response.data.message);


                }
            });
        });

    </script>
</body>

</html>
