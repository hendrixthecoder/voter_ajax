import './bootstrap';
$(document).ready(function(){
    // $.get('get-count', ({count}) => {
    //     $('#counter').html(count)
    // })
    console.log(document.getElementById(1))

    $.ajax({
        type: "GET",
        url: "get-candidates",
        dataType: "JSON",
        success: function (response) {
            $.each(response.candidates, (key, {name}) => {
                $('#candidate').append(
                    `<option id="${key}" value="${name}">${name}</option>`
                )
            })
        }
    });

    function getStudents () {
        $.ajax({
            type: "GET",
            url: "get-users",
            dataType: "JSON",
            success: function (response) {
                if(response.users != ''){
                    $("tbody").html('')

                    $.each(response.users, (key, {name,vote_count}) => {
                        $('tbody').append(
                            `<tr>
                                <td>${name}</td>
                                <td class="text-center">${vote_count}</td>
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
            "email": $('#email').val(),
            "candidate": $('#candidate').val()
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
                
                }else if (response.state == 'alreadyVoted'){
                    $('#exampleModalLabel').html('Whoops')
                    $('#error_list').html(response.error)
                    $('#error_button').click();
                    
                }else if (response.state == 'noCandidate') {
                    $('#exampleModalLabel').html('Whoops')
                    $('#error_list').html(response.error)
                    $('#error_button').click();
                }
                else if(response.status == 200){
                    $('#exampleModalLabel').html('Success!')
                    $('#error_list').html(response.success)
                    $('#error_button').click();
                }
            }
        });
    })


})