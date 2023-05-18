<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    <!-- //sweetalert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="text-center mt-5">Laravel Ajax CRUD</h1>
    
    <!-- Button trigger modal -->

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-2">
                                    <label for="nama" class="col-sm-2 col-form-label fw-mediumbold">Nama</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="isikan nama lengkap anda...">
                                        <span class="text-danger" id="name_error"></span>
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="address" class="col-sm-2 col-form-label fw-mediumbold">Alamat</label>
                                    <div class="col-sm-12">
                                        <textarea type="text" class="form-control" name="address" id="address" placeholder="isikan alamat anda..." cols="8" rows="3"></textarea>
                                        <span class="text-danger" id="address_error"></span>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="telp" class="col-sm-2 col-form-label fw-mediumbold">No. Telp</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="telp" id="telp" placeholder="isikan no. telp anda...">
                                        <span class="text-danger" id="telp_error"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveDataButton">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Tambah Data
                </button>
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="width: 10%">Name</th>
                            <th style="width: 40%">Address</th>
                            <th>Telp</th>
                            <th  style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>

</div>
    @include('script')
</body>
</html>