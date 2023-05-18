<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- //sweetalert script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        // $('#myTable').DataTable();
        $('#myTable').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('employee.index') }}",
                type: 'GET',
            },
            responsive: true,
            columns: [
                
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'address',
                    name: 'address',
                },
                {
                    data: 'telp',
                    name: 'telp',
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        function save(id = '') {
            if(id == '') {
                var var_url     = 'employee';
                var var_type    = 'POST';
            } else {
                var var_url     = 'employee/' + id;
                var var_type    = 'PUT';
            }

            $.ajax({
                url:  var_url,
                type: var_type,
                data: {
                    name    : $('#name').val(),
                    address : $('#address').val(),
                    telp    : $('#telp').val(),
                },
                success: function(response) {
                    if(response.success) {
                        $('#exampleModal').modal('hide'); 
                        swal.fire({
                            title: "Good Job!",
                            text: "Data Berhasil Dibuat",
                            icon: "success",
                            timer: 3000,
                        });
                        
                        setTimeout(() => {
                            // $('#exampleModal').modal('hide'); 
                            location.reload();
                        }, 3000);
                    } else {
                        $('#exampleModal').modal('hide');
                        swal.fire("Maaf!", "Data Gagal, Tolong periksa kembali!", {
                            icon: "error",
                            timer: 3000,
                        });

                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    }
                },
                error: function(response) {
                    console.log(response);
                    $('#name_error').text(response.responseJSON.errors.name);
                    $('#address_error').text(response.responseJSON.errors.address);
                    $('#telp_error').text(response.responseJSON.errors.telp);
                }
            })
        }

        $('body').on('click', '#saveDataButton', function(e) {
            var id = $('input#id').val();

            save(id ?? '');
            $('#myTable').DataTable().ajax.reload()
        })

        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#name').val('');
            $('#address').val();
            $('#telp').val();
            $('#id').val();
        })

        $("#myTable").on("click", "#editData", function(e) {
            let id = $(this).data("id");

            $.ajax({
                url: 'employee/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    $("#exampleModal").modal("show")
                    $("#name").val(response.result.name);
                    $("#address").val(response.result.address);
                    $("#telp").val(response.result.telp);
                    $("#id").val(response.result.id);
                }
            })
        })

        $("#deleteData").click(function() {
            let id = $(this).data("id");
            let baseUrl = "{{ url('/') }}";

            $.ajax({
                url: `${baseUrl}/employee/${id}`,
                type: 'DELETE',
                data: {
                    "id": id,
                },
                success: function(response) {
                    console.log("ini berhasil");
                }
            })
        })

        $('body').on('click', '#deleteData', function() {
            let employee_id = $(this).data('id');
            let token       = $("meta[name='csrf-token']").attr("content");

            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
            }).then((result) => {
            if (result) {
                    console.log('test');

                    $.ajax({
                        type: 'DELETE',
                        url: "employee/"+employee_id,
                        cache: false,
                        data: {
                            "_token": token,
                            "_method": 'DELETE',
                        },
                        success: function(response) {
                            swal.fire({
                                title: 'Deleted!',
                                text: 'Your file has been deleted.',
                                icon: 'success',
                            }).then((e) => {
                                if(e){
                                    location.reload();
                                }
                            });
                        }
                    })
                }
                
            });
        })
    })
</script>