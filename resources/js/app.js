// import './bootstrap';

$(document).ready(function(){

    
    $('#homepage').show()

    $('#home').click(() => {

        $('#pollpage').hide()
        $('#resultpage').hide()
        $('#homepage').show()
    })

    $('#poll').click(() => {
        $('#homepage').hide()
        $('#resultpage').hide()
        $('#pollpage').show()
    })

    $('#results').click(() => {
        $('#homepage').hide()
        $('#pollpage').hide()
        $('#resultpage').show()
    })

    $('#toggleLDBtn').click(() => {
        $('#light').toggle();
        $('#dark').toggle();
        $('html').toggleClass('dark');
        
    })

    const openBtn = document.getElementById('openBtn');
    const btnClose = document.getElementById('closeBtn');
    const modal = document.getElementById('modal');

    openBtn.addEventListener('click', () => {
        modal.showModal();
    })

    btnClose.addEventListener('click', () => {
        modal.close();
    })

    // Get list of candidates in the database and append them to the select element in the form
    $.ajax({
        type: "GET",
        url: "get-candidates",
        dataType: "JSON",
        success: function (response) {
            console.log(response.candidates)
            $.each(response.candidates, (key, {name, vote_count}) => {
                
                $('#candidate').append(
                    `<option id="${key}" value="${name}">${name}</option>`
                )
                
                $('#palate').html('')
                $.each(response.candidates, (key, {name,vote_count}) => {

                    $('#palate').append(`
                        <div class="flex justify-between w-11/12 mx-auto border-b">
                            <div class="p-2">${name}</div>
                            <div class="p-2">${vote_count}</div>
                        </div>
       
                    `)
                })
            })
        }
    });

    // Get lists of all candidates and their vote count and append it to the table

    function getCandidates () {
        $.ajax({
            type: "GET",
            url: "get-candidates",
            dataType: "JSON",
            success: function (response) {
                if(response.users != '' && response.status == 200){
                    $("#palate").html('')

                    $.each(response.candidates, (key, {name,vote_count}) => {
                        $('#palate').append(`
                            <div class="flex justify-between w-11/12 mx-auto border-b">
                                <div class="p-2">${name}</div>
                                <div class="p-2">${vote_count}</div>
                            </div>
           
                        `)
                    })
                }

            }
        })
    }

    // setting time to 5 seconds to refresh vote list
    const interval = window.setInterval(() => {
        getCandidates();

    }, 5000);

    // getting data to send to backend from form 
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
                    $('#modal-body').html('');
                    $.each(response.errors, function (key, value) { 
                        $('#modal-body').append(
                            `<li class="text-red-600">${value}</li>`
                        )
                        $('#openBtn').click();
                    });
                
                }else if (response.state == 'alreadyVoted'){
                    $('#modal-body').html('');
                    $('#modal-body').html(response.error)
                    $('#openBtn').click();
                    
                }else if (response.state == 'noCandidate') {
                    $('#modal-body').html('');
                    $('#modal-body').html(response.error)
                    $('#openBtn').click();
                }
                else if(response.status == 200){
                    $('#modal-body').html('');
                    $('#modal-body').html(response.success)
                    $('#openBtn').click();

                    $('#before-vote').hide();
                    $('#after-vote').show();
                }
            }
        });
    })


})