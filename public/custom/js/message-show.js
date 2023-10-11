$(document).ready(function () {
    $('#send-message').click(function () {
        var message = $('#message').val();
        if (message) {
            Swal.fire({
                title: "Êtes vous sûr de vouloir envoyer cette réponse ?",
                icon: 'question',
                height: '40%',
                width: '40%',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<span style="font-size: 15px;">OUI</span>',
                cancelButtonText: '<span style="font-size: 15px;">NON</span>',
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = $(this).data('url');
                    var token = $(this).data('token');

                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: {
                            _token: token,
                            message: message
                        },
                        success: function (data) {
                            $('#message').val('');
                            var text = `
                            <li class="left clearfix admin_chat">
                                <span class="chat-img1 pull-right">
                                    <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">
                                </span>
                                <div class="chat-body1 clearfix">
                                    <p>` + data.reponse + `</p>
                                    <div class="chat_time pull-left">` + data.date + `</div>
                                </div>
                            </li>
                            `;
                            // $('#message-zone').remove();
                            $('#message-client').append(text).hide().fadeIn(1000);
                            var counter = $('#message-counter').text();
                            counter--;
                            $('#message-counter').text(counter);
                            $('#message-li-' + data.id).remove();
                        },
                        error: function (data) {
                            alert(data.message);
                        }
                    });
                }
            });
        }
    });

    $('.cloturer').click(function() {
        var text = $(this).data('index') == 0 ? '' : 'définitivement';
        var confirmation = confirm('Voulez-vous vraiment cloturer cette discussion ' + text + '?');
        if (confirmation) {
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    if(text == '') {
                        $('#cloturer').remove();
                    }
                    else {
                        $('#message-zone').remove();
                    }
                },
                error: function(data) {
                    alert(data.message);
                }
            });
        }
    });
});