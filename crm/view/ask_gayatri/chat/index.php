<div class="chat-container">
    <div class="chat-header">
        <h1><i class="fa fa-globe"></i>&nbsp;&nbsp;Chat Gayatri</h1>
    </div>

    <div class="chat-messages" id="chat-messages">
    </div>
    <form method=" POST" id="frm_data_save">
        <div class="chat-input">
        <textarea name="user_input" id="user-input" rows="2" required placeholder="Type your message..." autocomplete="off"></textarea>
            <button id="send-button" type="submit"><i class="fa fa-send"></i></button>
    </form>
    <form method="POST" id="fileUploadForm" enctype="multipart/form-data">
        <!-- file -->
        &nbsp;&nbsp;&nbsp;
        <label for="file" class="custom-file-upload">
            <i class="fa fa-paperclip"></i> Attach File
        </label>
        <input type="file" name="file" id="file">
        <!-- file -->
    </form>
</div>

<script>
    getMessage();



    function getMessage() {
        var client_id = $('#client_id').val();
        var base_url = $('#base_url_support').val();
        $.get(base_url + 'view/ask_gayatri/chat/get_chat_message.php', {
            client_id: client_id,
            user_side: "Client"
        }, function(data) {
            $('#chat-messages').html(data);
            scrollToBottom();
        });
    }

    setInterval(() => {
        getUnreadMessage();
    }, 2000);


    function getUnreadMessage() {
        var client_id = $('#client_id').val();
        var base_url = $('#base_url_support').val();
        $.get(base_url + 'view/ask_gayatri/chat/get_chat_message_unread.php', {
            client_id: client_id,
            user_side: "Client"
        }, function(data) {
            $('#chat-messages').append(data);
            // scrollToBottom();
        });
    }


    function scrollToBottom() {
        var chatMessages = $('#chat-messages');
        chatMessages.scrollTop(chatMessages.prop('scrollHeight'));
    }


    $(function() {
        $('#frm_data_save').validate({
            rules: {
                rules: {
                    user_input: {
                        required: true
                    },
                }
            },
            submitHandler: function(form) {
                var base_url = $('#base_url_support').val();;
                var value = convertToHtml($('#user-input').val());
                var user_side_id = 0;
                var client_name = $('#client_name').val();

                if (value == '') {
                    error_msg_alert("Message Is Required");
                    return false;
                }

                var client_id = $('#client_id').val();

                $.post(base_url + 'view/ask_gayatri/chat/store_chat_message.php', {
                    client_id: client_id,
                    user_side: 'Client',
                    user_side_id: user_side_id,
                    message: value,
                    reply_id: 0,
                    client_name: client_name
                }, function(data) {
                    $('#user-input').val('');
                    // getMessage();
                    getUnreadMessage();
                    setTimeout(() => {
                        scrollToBottom();
                    }, 1000);
                });


            }
        })
    });
</script>


<script>
    $(document).ready(function() {
        $("#file").change(function() {
            var formData = new FormData($("#fileUploadForm")[0]);
            var base_url = $('#base_url_support').val();
            var user_side_id = $('#user_side_id').val();
            var client_id = $('#client_id').val();
            var client_name = $('#client_name').val();

            var fileInput = $("#fileUploadForm input[type='file']")[0];
            var selectedFile = fileInput.files[0];
            if (!selectedFile) {
                return false;
            }
            if (fileInput == false && fileInput.files.length == 0) {
                return false;
            }
            if (selectedFile.size > 100 * 1024 * 1024) {
                error_msg_alert("File Size Limit Is 100 MB");
                return false;
            }
            $.ajax({
                url: base_url + "view/ask_gayatri/upload.php", // Change this to the path of your PHP file
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var fileName = response.split("/");
                    if (fileName[(fileName.length - 1)] == "error") {
                        return false;
                    }
                    var message = `File:` + fileName[(fileName.length - 1)] + `<br>`;
                    $.post(base_url + 'view/ask_gayatri/chat/store_chat_message.php', {
                        client_id: client_id,
                        user_side: 'Client',
                        user_side_id: user_side_id,
                        message: message,
                        reply_id: 0,
                        is_url: 1,
                        url: response,
                        client_name: client_name
                    }, function(data) {
                        $('#user-input').val('');
                        getUnreadMessage();
                        setTimeout(() => {
                            scrollToBottom();
                        }, 1000);
                    });
                },
                error: function() {
                    error_msg_alert("Error uploading the file.");
                    return false;
                }
            });
        });
    });

    function convertToHtml(text) {


        // Replace line breaks with <br> tags
        var html = text.replace(/\n/g, '<br>');

        return html;
    }
</script>

<script>
    $(document).ready(function() {
        const textarea = $('#user-input');
        const form = $('#frm_data_save');

        textarea.on('keydown', function(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault(); // Prevent default form submission
                form.submit(); // Submit the form
            } else if (event.key === 'Enter' && event.shiftKey) {
                // Insert a line break
                const start = this.selectionStart;
                const end = this.selectionEnd;
                const text = this.value;
                this.value = text.substring(0, start) + '\n' + text.substring(end);
                this.selectionStart = this.selectionEnd = start + 1; // Place the cursor after the line break
                event.preventDefault(); // Prevent the default Enter key behavior
            }
        });
    });
</script>