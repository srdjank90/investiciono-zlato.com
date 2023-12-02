import "./bootstrap";
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

// Enable Tooltip
const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

// TinyMCE
tinymce.init({
    selector: ".tinymce",
    plugins:
        "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
    toolbar:
        "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
});

// Delete Item by clicking on delete button in table
$(".item-delete").click(function () {
    var id = $(this).data("id");
    var model = $(this).data("model");
    var token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
        title: "Are you sure you want to delete?",
        text: "This action cannot be revoked and the data will be deleted forever",
        showCancelButton: true,
        confirmButtonText: "Delete",
        icon: "question",
        confirmButtonColor: "#0d6efd",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url: "/backend/" + model + "/delete/" + id,
                type: "DELETE",
                data: {
                    id: id,
                    _token: token,
                },
                success: function (response) {
                    $("#tr-" + id).remove();
                    Swal.fire(
                        "Deleted!",
                        "You have successfully deleted the item!",
                        "success"
                    );
                    window.location.reload();
                },
            });
        }
    });
});

// Generate Slug when entering Name or Title
$(".generate-slug").on("input", function () {
    console.log("Here");
    let slug = $(this).val();
    $(".slug-generated").val(_.kebabCase(slug));
});
