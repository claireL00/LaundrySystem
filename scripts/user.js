 //update user in admin page
 //open modal
 $(document).on('click', '.updateButton', function(){
    var userId=( $(this).attr('userIdUpdate'));
    console.log( $(this).attr('userIdUpdate'));
    $.ajax({
        url:'updateUser.php',
        method:'POST',
        data: {userId_js:userId},//colon equals = symbol
        success: function(data){
            $('#updateUserModal').modal('show');
            $('#showModalBodyFooter1').html(data);
        } 
    });
    });

    //save changes in modal      
$('#updateUserForm').on('submit',function(event){
    event.preventDefault(); //prevents the submit form validation
    $.ajax({
        url: 'userUpdateSaveChanges.php',
        method: "POST",
        data: $('#updateUserForm').serialize(),
        success:function(data){
            $('#updateUserModal').modal('hide');
            $('#userTable').html(data);
           // $('#addStudentForm')[0].reset();
        }
    });
    console.log("submitted");
});


// JavaScript for deleting user admin page
$(document).on('click', '.delete-object', function(){
  
    var userId = $(this).attr('userIdDelete');
    console.log(userId);
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
                    url:'userDelete.php',
                    method:'POST',
                    data: {userId_js:userId},//colon equals = symbol
                    success: function(data){
                        $('#userTable').html(data);
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