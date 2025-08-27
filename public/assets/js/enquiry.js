function showSaveModel(e) {
   e.preventDefault();
   $(".divOffcanvas").empty();
   $("#status").show();
   $("#preloader").show();
   var url = $(e.currentTarget).attr("href");
   $.ajax({
      headers: {
         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: url,
      type: "get",
      data: {},
      success: function (data, textStatus, jqXHR) {
         $("#status").hide();
         $("#preloader").hide();
         if (!data.error) {
            $(".divOffcanvas").html(data.view);
            var bsOffcanvas = new bootstrap.Offcanvas(
               $("#offcanvasCreate")
            );
            bsOffcanvas.show();
         } else {
            toastr.error(data.message);
         }
      },
      error: function (jqXHR, textStatus, errorThrown) {
         $("#status").hide();
         $("#preloader").hide();
         toastr.error("Error occurred!");
      },
   });
}

function showEditModel(e) {
   $(".divOffcanvas").empty();
   e.preventDefault();
   $("#status").show();
   $("#preloader").show();
   var url = $(e.currentTarget).attr("href");
   $.ajax({
      headers: {
         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: url,
      type: "get",
      data: {},
      success: function (data, textStatus, jqXHR) {
         $("#status").hide();
         $("#preloader").hide();
         if (!data.error) {
            $(".divOffcanvas").html(data.view);
            var bsOffcanvas = new bootstrap.Offcanvas(
               $("#offcanvasCreate")
            );
            bsOffcanvas.show();
         }
      },
      error: function (jqXHR, textStatus, errorThrown) {
         $("#status").hide();
         $("#preloader").hide();
         toastr.error("Error occurred!");
      },
   });
}


// Change status
function popupMassage(e) {
   e.preventDefault();
   var url = $(e.currentTarget).attr("data-url");
   swal(
      {
         title: "Alert",
         text: "Are you sure you want to change status?",
         showCancelButton: true,
         confirmButtonColor: "#556EE6",
         cancelButtonColor: "#DD6B55",
         confirmButtonText: "Ok",
         cancelButtonText: "Cancel",
         closeOnConfirm: true,
         closeOnCancel: true,
      },
      function (isConfirm) {
         if (isConfirm) {
            // AJAX request to change status
            $.ajax({
               headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                     "content"
                  ),
               },
               url: url,
               type: "get",
               success: function (response) {
                  console.log(response);
                  if (!response.error) {
                     // Get the current DataTable instance
                     var table = $("#enquiry-table-data").DataTable();

                     // Find the row in the DataTable that matches the updated record ID
                     table.rows().every(function () {
                        var rowData = this.data();
                        if (rowData.id == response.id) {
                           // Update the status in the row data
                           rowData.status = response.status;
                           this.data(rowData);
                        }
                     });

                     table.draw(false); // Redraw the table without resetting pagination

                     toastr.success(response.message);
                  } else {
                     toastr.error(response.message);
                  }
               },
               error: function (xhr, status, error) {
                  toastr.error("Error occurred!");
                  console.error(xhr.responseText);
               },
            });
         }
      }
   );
}

// Delete records
function deletePopupMassage(e) {
   e.preventDefault();
   var url = $(e.currentTarget).attr("data-url");
   swal(
      {
         title: "Alert",
         text: "Are you sure you want to delete this record?",
         showCancelButton: true,
         confirmButtonColor: "#556EE6",
         cancelButtonColor: "#DD6B55",
         confirmButtonText: "Delete",
         cancelButtonText: "Cancel",
         closeOnConfirm: true,
         closeOnCancel: true,
      },
      function (isConfirm) {
         if (isConfirm) {
            // AJAX request to delete records
            $.ajax({
               headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                     "content"
                  ),
               },
               url: url,
               type: "DELETE",
               success: function (response) {
                  if (!response.error) {
                     // Get the current DataTable instance
                     var table = $("#enquiry-table-data").DataTable();

                     // Find the row in the DataTable that matches the deleted record ID
                     table.rows().every(function () {
                        var rowData = this.data();
                        if (rowData.id == response.deletedRecordId) {
                           // Remove the row from the DataTable
                           this.remove();
                        }
                     });

                     table.draw(false); // Redraw the table without resetting pagination

                     toastr.success(response.message);
                  } else {
                     toastr.error(response.message);
                  }
               },
               error: function (xhr, status, error) {
                  $("#status").hide();
                  $("#preloader").hide();
                  toastr.error("Error occurred!");
               },
            });
         }
      }
   );
}
