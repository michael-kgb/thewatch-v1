function exportTableToExcel(tableID, filename = ''){

    var downloadLink;

    var dataType = 'application/vnd.ms-excel';

    var tableSelect = document.getElementById(tableID);

    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    

    // Specify file name

    filename = filename?filename+'.xls':'excel_data.xls';

    

    // Create download link element

    downloadLink = document.createElement("a");

    

    document.body.appendChild(downloadLink);

    

    if(navigator.msSaveOrOpenBlob){

        var blob = new Blob(['\ufeff', tableHTML], {

            type: dataType

        });

        navigator.msSaveOrOpenBlob( blob, filename);

    }else{

        // Create a link to the file

        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

    

        // Setting the file name

        downloadLink.download = filename;

        

        //triggering the function

        downloadLink.click();

    }

}



function setView(sel){

    window.location.href = "https://www.thewatch.co/timexraffle/verifikator?view="+sel.value;

}





new Vue({

  el: '#modal-verifikator',

  methods: {  

    verifikasi: function (event) {

      $("#submitLoginVerifikator").attr("disabled", true);

      $("#submitLoginVerifikator").html('Waiting');





        var kode = $('input[name=kode]').val();



        kode = $.trim(kode);

        console.log(kode);



        if(

          kode!=""&&

          kode.length==6){

          $.ajax({

            type: "GET",

            url: "https://www.thewatch.co/go-api/collaborate-verificator/verify-code//",

            data: { 

              code: kode

             },

            dataType: "text",

            success: function(resultData){

              

              var hasilData = JSON.parse(resultData);

              console.log(hasilData);

              resultLogin = hasilData['status']

              alert(hasilData['message'])



              if(resultLogin){

                  tableData.loadTableData();

              }



              $("#submitKodeVerifikasi").attr("disabled", false);

              $("#submitKodeVerifikasi").html('Submit');



            },

            error: function (xhr, ajaxOptions, thrownError) {

               alert("Error, Submit dibatalkan");

               $("#submitKodeVerifikasi").attr("disabled", false);

                $("#submitKodeVerifikasi").html('Submit');

            }

          });

        }else{

          alert("Masukan kode secara lengkap dan sesuai");

          $("#submitKodeVerifikasi").attr("disabled", false);

          $("#submitKodeVerifikasi").html('Submit');

        }



       

        

       

      

    }

  }

});







var i=0;



var tableData = new Vue({

  el: '#dataRegistrant',

  data: {

        filter: '',

      columns: [

                //{label: 'Nama Lengkap', field: 'events.reg_email', headerClass: 'class-in-header second-class'},
				
				
				{label: 'Nama Lengkap', field: 'events.reg_name'},
				
                {label: 'Email', field: 'events.reg_email'},

                {label: 'Nomor Handphone', field: 'events.reg_phone'},

                //{label: 'Nomor KTP', field: 'user.ktp'},

                {label: 'Verifikasi', representedAs: function(row){

                  //console.log(row.events.status);

                  if(row.events.status=="1"){

                   return 'Sukses Verifikasi <i class="fa fa-check" style="color:green;"></i>';

                  }else{

                    return 'Belum Verfikasi <i class="fa fa-times" style="color:red;"></i>';

                  }

                }, interpolate: true},

                //{label: 'address', representedAs: function(row){

                //    return row.address + '<br />' + row.city + ', ' + row.state;

                //}, interpolate: true}

              ],

      rows: [],  

      page: 1,

      per_page: 10

  },

  methods: {  

    loadTableData: function (event) {

      $('#verificationBtn').hide();

      let searchParams = new URLSearchParams(window.location.search);

      if(searchParams.get('view')!=null){

        if(searchParams.get('view')=="all"){

          this.per_page = 0;

          $('#num_per_page option[value=0]').removeAttr('selected')

          $('#num_per_page option[value=all]').attr('selected','selected');

        }else{

          this.per_page = searchParams.get('view');

          $('#num_per_page option[value=0]').removeAttr('selected')

          $('#num_per_page option[value='+searchParams.get('view')+']').attr('selected','selected');

        }

      }

        



        axios.get(

          'https://www.thewatch.co/go-api/collaborate-verificator/get-registrants/?events=timexraffle,timexraffles', 

          {

            events: ['timexraffle','timexraffles']

          } 

        )

        .then(response => {

          this.rows=response['data']['results'];

          $(".lds-dual-ring").hide();

          $("#verificationBtn").show();

        

        })

        .catch((e) => {

                    console.log(e)

        }) 

      

    }

  },

  created(){

    this.loadTableData();    

  }

});





new Vue({

  el: '#form-login-verifikator-raffle',

  methods: { 

    signin: function (event) {

      $("#submitLoginVerifikator").attr("disabled", true);

      $("#submitLoginVerifikator").html('Waiting');





        var username = $('input[name=usernamesignin]').val();

        var password = $('input[name=passwordsignin]').val();



        username = $.trim(username);

        password = $.trim(password);

        console.log(username);

        console.log(password);



        if(

          username!=""&&

          password!=""&&

          username.length>3 &&

          password.length>4){

          $.ajax({

            type: "POST",

            url: "https://www.thewatch.co/go-api/collaborate-verificator/sign-in/",

            data: { 

              username: username,

              password: password

             },

            dataType: "text",

            success: function(resultData){

              

              var hasilData = JSON.parse(resultData);

              console.log(hasilData);

              resultLogin = hasilData['status']

              alert(hasilData['message'])

              



              if(resultLogin){

                alert("Please wait, redirect page...")

                window.location.href = "https://www.thewatch.co/timexraffle/verifikator";

              }else{

                $("#submitLoginVerifikator").attr("disabled", false);

                $("#submitLoginVerifikator").html('Login');

              }



              



            },

            error: function (xhr, ajaxOptions, thrownError) {

               alert("Error, Submit dibatalkan");

               $("#submitLoginVerifikator").attr("disabled", false);

                $("#submitLoginVerifikator").html('Login');

            }

          });

        }else{

          alert("Masukan username dan password lengkap dan sesuai");

          $("#submitLoginVerifikator").attr("disabled", false);

          $("#submitLoginVerifikator").html('Login');

          

        }



        console.log(tableData);



       

        

       

      

    }

  }

});

