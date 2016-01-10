
$('.delete-it').click(function(e) {
    e.preventDefault();
    var btn = this;
    swal({
        title: "Are you sure?",
        text: "Are you sure that you want to delete this",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        confirmButtonColor: "#ec6c62"
    }, function() {
        window.location = $(btn).attr('href');
    });
})
