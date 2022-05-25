<script>
$(function() {

    var table = $("#dataTable2").DataTable({
        processing: true,
        serverSide: true,
        "responsive": true,
        ajax: "{{ route('prestasi.index') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'nama_kejuaraan',
                name: 'nama_kejuaraan'
            },
            {
                data: 'tingkat',
                name: 'tingkat'
            },
            {
                data: 'kelas',
                name: 'kelas'
            },
            {
                data: 'kategori',
                name: 'kategori'
            },
            {
                data: 'perolehan',
                name: 'perolehan'
            },
            {
                data: 'tgl_acara',
                name: 'tgl_acara'
            },
            {
                data: 'lokasi',
                name: 'lokasi'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: true
            },
        ]
    });

});

// Reset Form
function resetForm() {
    $("[name='name']").val("")
    $("[name='nama_kejuaran']").val("")
    $("[name='tingkat']").val("")
    $("[name='kelas']").val("")
    $("[name='kategori']").val("")
    $("[name='perolehan']").val("")
    $("[name='tgl_acara']").val("")
    $("[name='lokasi']").val("")
}

// create
$("#store").on("submit", function(e) {
    e.preventDefault()
    $.ajax({
        url: "{{ route('prestasi.store') }}",
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
            if ($.isEmptyObject(response.error)) {
                $("#createModal").modal("hide")
                $('#dataTable2').DataTable().ajax.reload()
                Swal.fire(
                    '',
                    response.message,
                    'success'
                )
                resetForm()
            } else {
                printErrorMsg(response.error)
            }
        }
    });
})

// create-error-validation
function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $.each(msg, function(key, value) {
        $(".print-error-msg").find("ul").append('<li>' + value + '</li>')
    });
}

// edit
$("body").on("click", ".btn-edit", function() {
    var id = $(this).attr("id")
    $.ajax({
        url: "/admin/prestasi/" + id + "/edit",
        method: "GET",
        success: function(response) {
            $("#id_edit").val(response.data.id)
            $("#name_edit").val(response.data.name)
            $("#nama_kejuaraan_edit").val(response.data.nama_kejuaraan)
            $("#tingkat_edit").val(response.data.tingkat)
            $("#kelas_edit").val(response.data.kelas)
            $("#kategori_edit").val(response.data.kategori)
            $("#perolehan_edit").val(response.data.perolehan)
            $("#tgl_acara_edit").val(response.data.tgl_acara)
            $("#lokasi_edit").val(response.data.lokasi)
            $("#editModal").modal("show")
        },
        error: function(err) {
            if (err.status == 403) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Not allowed!'
                })
            }
        }
    })
})

// update
$("#update").on("submit", function(e) {
    e.preventDefault()
    var id = $("#id_edit").val()
    $.ajax({
        url: "/admin/prestasi/" + id,
        method: "PATCH",
        data: $(this).serialize(),
        success: function(response) {
            if ($.isEmptyObject(response.error)) {
                $("#editModal").modal("hide")
                $('#dataTable2').DataTable().ajax.reload()
                Swal.fire(
                    '',
                    response.message,
                    'success'
                )
            } else {
                printErrorMsg(response.error)
            }
        },
        error: function(err) {
            if (err.status == 403) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Not allowed!'
                })
            }
        }
    })
})

// delete
$("body").on("click", ".btn-delete", function() {
    var id = $(this).attr("id")

    Swal.fire({
        title: 'Yakin hapus data ini?',
        // text: "You won't be able to revert",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/admin/prestasi/" + id,
                method: "DELETE",
                success: function(response) {
                    $('#dataTable2').DataTable().ajax.reload()
                    Swal.fire(
                        '',
                        response.message,
                        'success'
                    )
                },
                error: function(err) {
                    if (err.status == 403) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Not allowed!'
                        })
                    }
                }
            })
        }
    })
})

//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
})
</script>