<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <nav class="nav flex-column bg-light p-3">
                    <h5 class="mb-4">User Management</h5>
                    <a class="nav-link" href="#">Users List</a>
                    <a class="nav-link active" href="#">Edit User</a>
                    <a class="nav-link" href="#">Add User</a>
                    <a class="nav-link" href="#">Groups List</a>
                    <a class="nav-link" href="#">Organization Details</a>
                </nav>
            </div>

            <!-- Main content -->
            <div class="col-md-9">
                <h2>Edit User</h2>
                <div class="row">
                    <!-- Profile Picture -->
                    <div class="col-md-4">
                        <div class="card shadow p-2">
                            <div class="card-body text-center">
                                <!-- <img src="https://via.placeholder.com/150" alt="Profile"
                                    class="rounded-circle img-fluid mb-3"> -->
                                <input type="file" accept="image/*">
                                <p class="card-text">JPG or PNG no larger than 5 MB</p>
                                <button class="btn btn-primary">Upload new image</button>
                            </div>
                        </div>
                    </div>

                    <!-- Account Details -->
                    <div class="col-md-8">
                        <div class="card shadow p-2">
                            <div class="card-body">
                                <form>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="firstName" class="form-label">First name</label>
                                            <input type="text" class="form-control" id="firstName" value="Valerie">
                                        </div>
                                        <div class="col">
                                            <label for="lastName" class="form-label">Last name</label>
                                            <input type="text" class="form-control" id="lastName" value="Luna">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" value="name@example.com">
                                    </div>

                                    <!-- Groups -->
                                    <div class="mb-3">
                                        <label for="groups" class="form-label">Group(s)</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="salesGroup" checked>
                                                <label class="form-check-label" for="salesGroup">Sales</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="developersGroup"
                                                    checked>
                                                <label class="form-check-label" for="developersGroup">Developers</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="marketingGroup">
                                                <label class="form-check-label" for="marketingGroup">Marketing</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="managersGroup"
                                                    checked>
                                                <label class="form-check-label" for="managersGroup">Managers</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="customerGroup">
                                                <label class="form-check-label" for="customerGroup">Customer</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Role -->
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-select" id="role">
                                            <option selected>Administrator</option>
                                            <option>Editor</option>
                                            <option>User</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end of row -->
            </div> <!-- end of col-md-9 -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>