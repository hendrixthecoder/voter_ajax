import './bootstrap';
$(document).ready(function(){
    $.get('get-count', ({count}) => {
        $('#counter').html(count)
    })

    function getStudents () {
        $.ajax({
            type: "GET",
            url: "get-users",
            dataType: "JSON",
            success: function (response) {
                if(response.users != ''){
                    $("tbody").html('')

                    $.each(response.users, (key, {id,name,email,ip}) => {
                        $('tbody').append(
                            `<tr>
                                <td>${name}</td>
                                <td>${email}</td>
                            </tr>`
                        )
                    })
                }

            }
        })
    }

    getStudents();

    const interval = window.setInterval(() => {
        $.get('get-count', function({count}){
            $('#counter').html(count)
        })

        getStudents();

    }, 5000);

    $(document).on('submit', 'form', function(e){
        e.preventDefault();
        let data = {
            "name": $('#name').val(),
            "email": $('#email').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "vote",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400){
                    $.each(response.errors, function (key, value) { 
                        $('#exampleModalLabel').html('Whoops!')
                        $('#error_list').append(`<li class=" ">${value}</li>`);
                        $('#error_button').click();

                        $('#close_btn').click(() => $('#error_list').html(''))
                        $('#close_icon').click(() => $('#error_list').html(''))
                    });
                
                }else if (response.state == 'wahala'){
                    $('#exampleModalLabel').html('Whoops')
                    $('#error_list').html(response.errors)
                    $('#error_button').click();
                    
                }else if(response.status == 200){
                    $('#exampleModalLabel').html('Success!')
                    $('#error_list').html(response.success)
                    $('#error_button').click();
                }
            }
        });
    })


})