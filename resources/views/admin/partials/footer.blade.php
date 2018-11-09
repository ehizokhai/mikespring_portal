  
              <!-- footer -->
 <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
  </div>
     </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('js/lib/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('js/lib/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>

    <script src="{{asset('js/lib/datamap/d3.min.js')}}"></script>
    <script src="{{asset('js/lib/datamap/topojson.js')}}"></script>
    <script src="{{asset('js/lib/datamap/datamaps.world.min.js')}}"></script>
    <script src="{{asset('js/lib/datamap/datamap-init.js')}}"></script>

    <script src="{{asset('js/lib/weather/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{asset('js/lib/weather/weather-init.js')}}"></script>
    <script src="{{asset('js/lib/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/lib/owl-carousel/owl.carousel-init.js')}}"></script>


    <script src="{{asset('js/lib/chartist/chartist.min.js')}}"></script>
    <script src="{{asset('js/lib/chartist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('js/lib/chartist/chartist-init.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/lib/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <!--Custom JavaScript -->

    <script src="{{asset('js/lib/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')}}"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
    <script src="{{asset('/js/jquery-confirm.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>

     <script src="{{asset('js/jquery.loading.min.js')}}"></script>
    @include('sweet::alert')
<script>

//$.alert('hello');
 $("#fupForm").on('submit', function(e){
  e.preventDefault();
  var formData = new FormData(this);

  console.log(formData)

  alert(JSON.stringify(formData));


//   $.ajax({
//     url: "page.php",
//     type: "POST",
//     data: formData,
//     success: function (msg) {
//       alert(msg)
//     },
//     cache: false,
//     contentType: false,
//     processData: false
//   });

});

$('#enterSubject').click(function(){

    $.confirm({
    title: 'Add Subject!',
    content: '' +
    '<form action="" class="formName">' +
    '<div class="form-group">' +
    '<label>Title</label>' +
    '<input type="text" placeholder="Your name" id="tit" class="titl form-control" required />' +
    '<div class="form-group">' +
    '<label>Code Name</label>' +
    '<input type="text" placeholder="Your name" class="codeName form-control" required />' +
    '<label>Category</label>' +
    '<select name="country" id="category" class="category form-control custom-select"><option>--Select your Category--</option><option>Junior</option><option>Senior</option></select>' +
    '</div>' +
    '</form>',
    buttons: {
        formSubmit: {
            text: 'Submit',
            btnClass: 'btn-blue',
            action: function () {
                var titl = $('#tit').val();
                var codeName = this.$content.find('.codeName').val();
                var category = this.$content.find('.category').val();
                confirmSubmit(titl, codeName, category);
                // var name = this.$content.find('.name').val();
                // if(!name){
                //     $.alert('provide a valid name');
                //     return false;
                // }
                // $.alert('Your name is ' + name);
            }
        },
        cancel: function () {
            //close
        },
    },
    onContentReady: function () {
        // bind to events
        var jc = this;
        this.$content.find('form').on('submit', function (e) {
            // if the user submits the form by pressing enter in the field.
            e.preventDefault();
            jc.$$formSubmit.trigger('click'); // reference the button and click it
        });
    }
});

})


function confirmSubmit(titl, codeName, category){

//const titl = titl;
//const codeName = codeName;
//const category= category;
$.confirm({
    title: 'Confirm!',
    content: 'Are you sure you want to submit!',
    buttons: {
        confirm: function () {
            finallySubmit(titl, codeName, category);
        },
        cancel: function () {
            $.alert('Canceled!');
        },
        // somethingElse: {
        //     text: 'Something else',
        //     btnClass: 'btn-blue',
        //     keys: ['enter', 'shift'],
        //     action: function(){
        //         $.alert('Something else?');
        //     }
        // }
    }
});
}

function finallySubmit(title, codeName, category){

// var category= $('#category').val();

//   if(category !== " "){

// $("#result11").html(' ');

// }else{

//  $("#result11").html('This field is required');

// }
   jQuery.ajax({
   type: "POST", // Post / Get method
   url: "/add_subject", //Where form data is sent on submission
   dataType:"text", // Data type, HTML, json etc.
   data:{title: title, codeName: codeName, category: category, "_token": "{{ csrf_token() }}"}, //Form variables
   success:function(response){
    var json=JSON.parse(response);
    console.log(json);
    if(json.title == 'success'){
        swal("Success!", "User has been added!", "success");
    } else {
        swal("Error!", "An error occured adding classroom!", "error");
    }
    
   },
   error:function (xhr, ajaxOptions, thrownError){
      alert(thrownError);
      //$("#loading").hide();
      swal("Error!", "An error occured adding classroom!", "error"); 
   }
 });
}


$('#enterClassroom').click(function(){

$.confirm({
title: 'Add Classroom!',
content: '' +
'<form action="" class="formName">' +
'<div class="form-group">' +
'<label>Title</label>' +
'<input type="text" placeholder="Your name" id="name" class="titl form-control" required />' +
'<div class="form-group">' +
'<label>Code Name</label>' +
'<input type="text" placeholder="Your name" class="alias form-control" required />' +
'<label>Category</label>' +
'<select name="country" id="category" class="category form-control custom-select"><option>--Select your Category--</option><option>Junior</option><option>Senior</option></select>' +
'</div>' +
'</form>',
buttons: {
    formSubmit: {
        text: 'Submit',
        btnClass: 'btn-blue',
        action: function () {
            var titl = $('#name').val();
            var codeName = this.$content.find('.alias').val();
            var category = this.$content.find('.category').val();
            confirmSubmitClass(titl, codeName, category);
            // var name = this.$content.find('.name').val();
            // if(!name){
            //     $.alert('provide a valid name');
            //     return false;
            // }
            // $.alert('Your name is ' + name);
        }
    },
    cancel: function () {
        //close
    },
},
onContentReady: function () {
    // bind to events
    var jc = this;
    this.$content.find('form').on('submit', function (e) {
        // if the user submits the form by pressing enter in the field.
        e.preventDefault();
        jc.$$formSubmit.trigger('click'); // reference the button and click it
    });
}
});
})

function confirmSubmitClass(title, codeName, category){
    $.confirm({
    title: 'Confirm!',
    content: 'Are you sure you want to submit!',
    buttons: {
        confirm: function () {
            finallySubmitClass(title, codeName, category);
        },
        cancel: function () {
            $.alert('Canceled!');
        },
        // somethingElse: {
        //     text: 'Something else',
        //     btnClass: 'btn-blue',
        //     keys: ['enter', 'shift'],
        //     action: function(){
        //         $.alert('Something else?');
        //     }
        // }
    }
});
}

function finallySubmitClass(title, codeName, category){

// var category= $('#category').val();

//   if(category !== " "){

// $("#result11").html(' ');

// }else{

//  $("#result11").html('This field is required');

// }

    $('#main-body').loading({
        message: 'Working...'
    });
   jQuery.ajax({
   type: "POST", // Post / Get method
   url: "/add_classroom", //Where form data is sent on submission
   dataType:"text", // Data type, HTML, json etc.
   data:{title: title, codeName: codeName, category: category, "_token": "{{ csrf_token() }}"}, //Form variables
   success:function(response){
    var json= JSON.parse(response);

    if(json.title == "success"){
        swal("Success!", "User has been added!", "success");
    } else {
        swal("Error!", "An error occured adding classroom!", "error");
    }
    location.reload();
    $('#main-body').loading('stop');
   },
   error:function (xhr, ajaxOptions, thrownError){
      alert(thrownError);
      //$("#loading").hide(); 
      $('#main-body').loading('stop');
   }
 });
}



</script>
</body>