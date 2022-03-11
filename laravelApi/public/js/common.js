$('#confirmCreatePost').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    var title = document.getElementById('title').value
    var comment = document.getElementById('comment').value
    $('input:text:eq(1)').val(title)
    $('textarea:eq(1)').val(comment)
  })

  $('#confirmUpdatePost').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    var title = document.getElementById('title').value
    var comment = document.getElementById('comment').value
    var status = $('#status').is(":checked")
    $('input:text:eq(1)').val(title)
    $('textarea:eq(1)').val(comment)
    $('input:checkbox').attr('checked', status)
  })
  function excelDownload(){
    var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#tableWrap').html())
    location.href = url
    return false
  }
 

  function showDetail(post){
    var title = post['title'];
    var comment = post['description'];
    $('input:text:eq(1)').val(title);
    $('textarea').val(comment);
  }
  
  function confirmDelete(id){
    var id = id;
    var url = '{{ __('/user/post/delete-post/') }}'+id;
    $("#confirm").attr('action', url);
  }
  function formSubmit(){
    $("#confirm").submit();
  }

  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
  
  $(document).on("click", ".browse", function() {
      var file = $(this).parents().find(".file");
      file.trigger("click");
    });
  $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);
    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
     document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  });
  

  $('#confirmCreateUser').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    var name = document.getElementById('name').value
    var email = document.getElementById('email').value
    var password = document.getElementById('password').value
    var passwordConfirm = document.getElementById('password_confirmation').value
    var type = document.getElementById('type').value
    var phone = document.getElementById('phone').value
    var dateOfBirth = document.getElementById('dateofbirth').value
    var address = document.getElementById('address').value
    

    $('#confirmname').val(name)
    $('#confirmemail').val(email)
    $('#confirmpassword').val(password)
    $('#confirm-password').val(passwordConfirm)
    $('#confirmtype').val(type)
    $('#confirmphone').val(phone)
    $('#confirmdob').val(dateOfBirth)
    $('#confirmaddress').val(address)

    var image = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
     document.getElementById("confirmpreview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(image);
    
  });

  $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);
    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
     document.getElementById("image").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  });

  $('#confirmUpdateUser').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    var name = $('#name').val()
    var email = $('#email').val()
    var type = $('#type').val()
    var phone = $('#phone').val()
    var dateOfBirth = $('#dateofbirth').val()
    var address = $('#address').val()
    $('#confirmname').val(name)
    $('#confirmemail').val(email)
    $('#confirmtype').val(type)
    $('#confirmphone').val(phone)
    $('#confirmdob').val(dateOfBirth)
    $('#confirmaddress').val(address)
    $('#confirmimage').attr('src',image);
    var image = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
     document.getElementById("confirmimage").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(image);
  });
  
  function confirmDeleteUser(id){
    var id = id;
    var url = '{{ __('/user/user/delete-user/') }}'+id;
    $("#confirm").attr('action', url);
  }
  function formSubmit(){
    $("#confirm").submit();
  }