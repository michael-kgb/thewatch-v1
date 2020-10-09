

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function validateonlynum(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

function tanggal(){
  var d = new Date();

var month = d.getMonth()+1;
var day = d.getDate();

var dt = new Date();
var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();


var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day + ' '+time;
  return output;
}

function registTimexRaffle1(){
        $("#submitKodeVerifikasi").attr("disabled", true);
        $("#submitKodeVerifikasi").html('Waiting');



        var nama = $('input[name=nama]').val();
        var email = $('input[name=mail]').val();
        var hp = $('input[name=hp]').val();
          var ktp = $('input[name=ktp]').val();
          
             console.log("Nama:"+nama);
          console.log("Email:"+email);
          console.log("Hp:"+hp);
          console.log("KTP-:"+ktp);


          nama = $.trim(nama);
          email = $.trim(email);
          hp = $.trim(hp);
          ktp = $.trim(ktp);

          console.log("Nama:"+nama);
          console.log("Email:"+email);
          console.log("Hp:"+hp);
          console.log("KTP:"+ktp);

          if(nama!=""&&
          email!=""&&
          hp!=""&&
          ktp!=""&&
          nama.length>=3&&
          email.length>=4&&
          hp.length>=10&&
          ktp.length==16&&
          isEmail(email)){

          $.ajax({
            type: "POST",
            url: "https://www.thewatch.co/go-api/collaborate-user/sign-up/",
            data: { 
              name: nama,
              key: ktp,
              email: email,
              phone: hp,
              regdate: tanggal(),
              event: 'timexraffle'
             },
            dataType: "text",
            success: function(resultData){
              var hasil = $.parseJSON(resultData);
                
                if(hasil['message']=="Data created successfully."){
                    alert("Saved. Success Register.");
                }else{
                    alert(hasil['message']);
                }
              
              $("#submitKodeVerifikasi").attr("disabled", false);
              $("#submitKodeVerifikasi").html('Submit');
            },
            error: function (xhr, ajaxOptions, thrownError) {
               alert("Error, Submit dibatalkan");
               $("#submitRegistrant").attr("disabled", false);
               $("#submitRegistrant").html('Submit');
               console.log(e);
            }
          });

        }else{
          alert("Sesuaikan data yang anda masukan");
          $("#submitRegistrant").attr("disabled", false);
          $("#submitRegistrant").html('Submit');
        }
    
}

function registTimexRaffle2(){
        $("#submitKodeVerifikasi").attr("disabled", true);
        $("#submitKodeVerifikasi").html('Waiting');



        var nama = $('input[name="nama2"]').val();
        var email = $('input[name=mail2]').val();
        var hp = $('input[name=hp2]').val();
          var ktp = $('input[name=ktp2]').val();


          nama = $.trim(nama);
          email = $.trim(email);
          hp = $.trim(hp);
          ktp = $.trim(ktp);

          console.log("Nama:"+nama);
          console.log("Email:"+email);
          console.log("Hp:"+hp);
          console.log("KTP:"+ktp);

          if(nama!=""&&
          email!=""&&
          hp!=""&&
          ktp!=""&&
          nama.length>=3&&
          email.length>=4&&
          hp.length>=10&&
          ktp.length==16&&
          isEmail(email)){

          $.ajax({
            type: "POST",
            url: "https://www.thewatch.co/go-api/collaborate-user/sign-up/",
            data: { 
              name: nama,
              key: ktp,
              email: email,
              phone: hp,
              regdate: tanggal(),
              event: 'timexraffle'
             },
            dataType: "text",
            success: function(resultData){
                var hasil = $.parseJSON(resultData);
                
                if(hasil['message']=="Data created successfully."){
                    alert("Saved. Success Register.");
                }else{
                    alert(hasil['message']);
                }
              
              $("#submitKodeVerifikasi").attr("disabled", false);
              $("#submitKodeVerifikasi").html('Submit');
            },
            error: function (xhr, ajaxOptions, thrownError) {
               alert("Error, Submit dibatalkan");
               $("#submitRegistrant").attr("disabled", false);
               $("#submitRegistrant").html('Submit');
               console.log(e);
            }
          });

        }else{
          alert("Sesuaikan data yang anda masukan");
          $("#submitRegistrant").attr("disabled", false);
          $("#submitRegistrant").html('Submit');
        }
    
}

new Vue({
    el: '#form-raffle',
    methods: { 
      greet: function (event) {
          alert('asd');
        $("#submitKodeVerifikasi").attr("disabled", true);
        $("#submitKodeVerifikasi").html('Waiting');


            var nama = $('input[name=nama]').val();
        var email = $('input[name=email]').val();
        var hp = $('input[name=hp]').val();
          var ktp = $('input[name=ktp]').val();
          nama = $.trim(nama);
          email = $.trim(email);
          hp = $.trim(hp);
          ktp = $.trim(ktp);

          console.log("Nama:"+nama);
          console.log("Email:"+email);
          console.log("Hp:"+hp);
          console.log("KTP:"+ktp);

          if(nama!=""&&
          email!=""&&
          hp!=""&&
          ktp!=""&&
          nama.length>=3&&
          email.length>=4&&
          hp.length>=10&&
          ktp.length==16&&
          isEmail(email)){

          $.ajax({
            type: "POST",
            url: "https://www.thewatch.co/go-api/collaborate-user/sign-up/",
            data: { 
              name: nama,
              key: ktp,
              email: email,
              phone: hp,
              regdate: tanggal(),
              event: 'timexraffle'
             },
            dataType: "text",
            success: function(resultData){
              alert("Sukses");
              $("#submitKodeVerifikasi").attr("disabled", false);
              $("#submitKodeVerifikasi").html('Submit');
            },
            error: function (xhr, ajaxOptions, thrownError) {
               alert("Error, Submit dibatalkan");
               $("#submitRegistrant").attr("disabled", false);
               $("#submitRegistrant").html('Submit');
               console.log(e);
            }
          });

        }else{
          alert("Sesuaikan data yang anda masukan");
          $("#submitRegistrant").attr("disabled", false);
          $("#submitRegistrant").html('Submit');
        }

       

            /*
            axios.post('https://www.thewatch.co/go-api/collaborate-user/sign-up/', {
            name: nama,
            key: ktp,
            email: email,
            phone: hp,
            regdate: '2019-06-15 00:00:00',
            event: 'timexraffle'
            }).then(response => {
                alert(response);
                this.captionButton = 'Submit';
                this.statusButton = '';
            })
            .catch((e) => {
                alert("Error, Submit dibatalkan");
                this.captionButton = 'Submit';
                console.log(e);
                
            });
            */
        
      }
    }
  })