 //update order in admin page
 //open modal
 $(document).on('click', '.updateButton', function(){
    var orderId=( $(this).attr('orderIdUpdate'));
    console.log( $(this).attr('orderIdUpdate'));
    $.ajax({
        url:'updateOrder.php',
        method:'POST',
        data: {orderId_js:orderId},//colon equals = symbol
        success: function(data){
            $('#updateOrderModal').modal('show');
            $('#showModalBodyFooter1').html(data);
        } 
    });
    });

//save changes in modal      
$('#updateOrderForm').on('submit',function(event){
      event.preventDefault(); //prevents the submit form validation
      $.ajax({
          url: 'orderUpdateSaveChanges.php',
          method: "POST",
          data: $('#updateOrderForm').serialize(),
          success:function(data){
              $('#updateOrderModal').modal('hide');
              $('#orderTable').html(data);
             // $('#addStudentForm')[0].reset();
          }
      });
      console.log("submitted");
  });



// JavaScript for deleting product admin page
$(document).on('click', '.delete-object', function(){
  
   var orderId = $(this).attr('orderIdDelete');
   console.log(orderId);
   swal({
      title: "Are you sure?",
      text: "Once deleted, it cannot be recovered!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
         //if user selects yes
        $.ajax({
                   url:'orderDelete.php',
                   method:'POST',
                   data: {orderId_js:orderId},//colon equals = symbol
                   success: function(data){
                       $('#orderTable').html(data);
                       swal("Success! Record has been deleted!", {
                        icon: "success",
                      });
                       
                   } 
               });
      } else {
        swal("Record not deleted!");
      }
    });
});

//add product in customer's page open modal, get customerId
$(document).on('click', '.orderButton', function(){
   var customerId=( $(this).attr('customerId'));
  console.log( $(this).attr('customerId'));
   $.ajax({
       url:'add.php',
       method:'POST',
       data: {customerId_js:customerId},//colon equals = symbol
       success: function(data){
           $('#addModal').modal('show');
           $('#showModalBodyFooter1').html(data);
       } 
   });
   });

//save entered details in the modal-customer's page
$('#addForm').on('submit',function(event){
     event.preventDefault(); //prevents the submit form validation
     $.ajax({
         url: 'orderAdd.php',
         method: "POST",
         data: $('#addForm').serialize(), 
         success:function(data){
             $('#addModal').modal('hide');
             $('#orderTable').html(data);
             $('#addForm')[0].reset();//erases the data in the form after clicking save changes button
             //swal("Success!", "Laundry added to queue!", "success");
            // window.location.reload();
           
         }
     });
  });

//cancel order -customer's page
$(document).on('click', '.cancelOrder', function(){
    console.log($(this).attr('orderIdCancel'));
    var orderId=( $(this).attr('orderIdCancel'));
    swal({
        title: "Are you sure?",
        text: "Once cancelled, it cannot be undone!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
           //if user selects yes
          $.ajax({
                     url:'orderCancel.php',
                     method:'POST',
                     data: {orderId_js:orderId},//colon equals = symbol
                     success: function(data){
                         $('#orderTable').html(data);
                         swal("Success! Order has been cancelled!", {
                          icon: "success",
                        });
                         
                     } 
                 });
        } else {
          swal("Order not cancelled!");
        }
      });
  });