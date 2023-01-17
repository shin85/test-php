<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="/fontawesome/css/all.css" rel="stylesheet" />
    <link href="/css/mdb.min.css" rel="stylesheet" />
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<container>
    <div class="container py-5">

        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center p-3"
                         style="border-top: 4px solid #ffa900;">
                        <h5 class="mb-0">Chat messages</h5>
                        <div class="d-flex flex-row align-items-center">
                            <span class="badge bg-warning me-3">20</span>
                            <i class="fas fa-minus me-3 text-muted fa-xs"></i>
                            <i class="fas fa-comments me-3 text-muted fa-xs"></i>
                            <i class="fas fa-times text-muted fa-xs"></i>
                        </div>
                    </div>
                    <div class="card-body overflow-auto" data-mdb-perfect-scrollbar="true" id="chat-content" data-mdb-suppress-scroll-x="true" style="position: relative; height: 400px">
                        <x-chat-item type="me1" name="aksjhdf" time="23 Jan 2:05 pm" message="kjhasdfjh" />
                        <x-chat-item type="me" name="aksjhdf" time="23 Jan 2:05 pm" message="kjhasdfjh" />

                    </div>
                    <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                        <div class="input-group mb-0">
                            <input type="text" class="form-control" placeholder="Type message"
                                   aria-label="Recipient's username" aria-describedby="button-addon2" />
                            <button class="btn btn-warning" type="button" id="button-chat" style="padding-top: .55rem;">
                                Button
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</container>
<script type="text/javascript" src="/js/mdb.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.3.min.js.js"></script>
<script>
    // load data from local storage
    let data = localStorage.getItem('chat');
    if (data) {
        data = JSON.parse(data);
        // put data to chat content
        data.forEach(item => {
            // replace item type to me1 if item type is me
            item = JSON.parse(item);
            if (item.name === '<?php echo $name_chat;?>' ) {
                $('#chat-content').append(`<x-chat-item name="${item.name}" time="${item.time}" message="${item.message}" />`);
            } else {
                item.type = '123123';
                $('#chat-content').append(`<x-chat-item-other name="${item.name}" time="${item.time}" message="${item.message}" />`);
            }

        });
    } else {
        data = [];
    }
    // put data when click button
    $('#button-chat').click(function () {
        let message = $('input').val();
        let time = new Date();
        let hour = time.getHours();
        let minute = time.getMinutes();
        let name = '<?php echo $name_chat; ?>';
        let timeString = hour + ':' + minute;
        let item = {
            name: name,
            time: timeString,
            message: message
        };
        $('#chat-content').append(`<x-chat-item name="${item.name}" time="${item.time}" message="${item.message}" />`);
        data[data.length] = JSON.stringify(item);
        localStorage.setItem('chat',  JSON.stringify(data));
        // clear input
        $('input').val('');
    });
    // reload update data
    setInterval(function () {
        let data = localStorage.getItem('chat');
        if (data) {
            // clear old data
            $('#chat-content').empty();
            data = JSON.parse(data);
            // put data to chat content
            data.forEach(item => {
                // replace item type to me1 if item type is me
                item = JSON.parse(item);
                if (item.name === '<?php echo $name_chat;?>' ) {
                    $('#chat-content').append(`<x-chat-item name="${item.name}" time="${item.time}" message="${item.message}" />`);
                } else {
                    item.type = '123123';
                    $('#chat-content').append(`<x-chat-item-other name="${item.name}" time="${item.time}" message="${item.message}" />`);
                }
                // limit 25
                if (data.length > 25) {
                    data.shift();
                }
            });
        } else {
            data = [];
        }
    }, 1000);
</script>
</body>
</html>
