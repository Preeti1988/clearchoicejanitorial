@extends('layouts.admin')
@section('title', 'Clear-ChoiceJanitorial - Chats')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/chat.css') }}">
@endpush
@section('content')
    <div class="body-main-content">
        <div class="chat-section">
            <div class="chat-userlist-sidebar">
                <div class="chat-userlist-sidebar-head">
                    <div class="chat-panel-sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M17 9C17 12.87 13.64 16 9.5 16L8.57001 17.12L8.02 17.78C7.55 18.34 6.65 18.22 6.34 17.55L5 14.6C3.18 13.32 2 11.29 2 9C2 5.13 5.36 2 9.5 2C12.52 2 15.13 3.67001 16.3 6.07001C16.75 6.96001 17 7.95 17 9Z"
                                stroke="#4F5168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M22 12.86C22 15.15 20.82 17.18 19 18.46L17.66 21.41C17.35 22.08 16.45 22.21 15.98 21.64L14.5 19.86C12.08 19.86 9.92001 18.79 8.57001 17.12L9.5 16C13.64 16 17 12.87 17 9C17 7.95 16.75 6.96001 16.3 6.07001C19.57 6.82001 22 9.57999 22 12.86Z"
                                stroke="#4F5168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7 9H12" stroke="#7BC043" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <h2>New Messages <span>{{ TotalCountMSG() }} New</span></h2>
                </div>
                <div class="chat-userlist-sidebar-body">
                    <form action="{{ route('Chats') }}" method="POST">
                        @csrf
                        <div class="chat-userlist-filter">
                            <input type="text" name="search" class="form-control" value="{{ $search ?? '' }}"
                                placeholder="Search by Employee Name">
                            <button class="search-btn"type="submit"><i class="las la-search"></i></button>
                        </div>
                    </form>
                    <div class="chat-userlist-info">
                        @if ($datas->isEmpty())
                            <tr>
                                <td colspan="11" class="text-center">
                                    No record found
                                </td>
                            </tr>
                        @elseif(!$datas->isEmpty())
                            @foreach ($datas as $val)
                                <a href="{{ url('chat/' . encryptDecrypt('encrypt', $val->userid)) }}">
                                    <div class="chat-userlist-item">
                                        <div class="chat-userlist-item-image">
                                            <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                                            <span class="user-status"></span>
                                        </div>
                                        <div class="chat-userlist-item-content">
                                            <h4>{{ $val->fullname }} </h4>
                                            <p>{{ $val->email }}</p>
                                        </div>
                                        <div class="chat-userlist-item-content">
                                            {{-- <div class="chat-userlist-time">02:50 PM</div> --}}

                                            @if (CountMSG($val->userid) > 0)
                                                <div class="unread-message"><span
                                                        class="badge">{{ CountMSG($val->userid) }}</span>
                                                </div>
                                            @endif


                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="chat-panel-section">
                <div class="chat-panel-chat-header">
                    <div class="chat-panel-user-item">
                        <div class="chat-panel-user-item-image"><img
                                src="{{ asset('public/assets/admin-images/user-default.png') }}"></div>
                        <div class="chat-panel-user-item-text">
                            <h4>{{ $firstData->fullname }}</h4>
                            <p>Emp Id: {{ $firstData->userid }}</p>
                        </div>
                    </div>

                    <div class="chat-panel-user-form">
                        <div class="chat-panel-service-dropdown">
                            <select class="form-control" id="select_id">
                                <option>Select Service</option>
                                @foreach ($servise_list as $cty)
                                    <option value="{{ $cty->service_id }}">{{ ServiceName($cty->service_id) ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="chat-panel-user-action">
                        <a class="viewbtn" href="#">View Job Details</a>
                    </div>
                </div>
                @if ($firstData)
                    <input type="hidden" id="ajax-chat-url" data-id="{{ $firstData->userid }}">
                    <input type="hidden" id="ajax-chat-url-first" data-id="{{ $firstData->fullname }}">
                    <input type="hidden" id="ajax-chat-url-service-id" value="">
                @endif
                <div class="chat-panel-chat-body" tabindex="1" style="overflow: auto; outline: none;">
                    <div class="chat-panel-chat-content">
                        <div class="messages-list">

                        </div>
                    </div>
                </div>
                <div class="chat-panel-chat-footer">
                    <form>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Write a message." name="message"
                                        id="message-input">
                                    <span class="form-attachemnt-icon">
                                        <a class="fs-24 ms-3 text-muted" id="image-attach" href="#!">
                                            <img class="la-paperclip"
                                                src="{{ asset('public/assets/admin-images/attachemnt.svg') }}">
                                        </a>
                                        <input type="file" hidden accept="image/png, image/jpg, image/jpeg"
                                            id="upload-file" name="image-attachment">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn-send btnSend" title="" type="button">
                                    <img src="{{ asset('public/assets/admin-images/direction.svg') }}"> Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).on('click', "#image-attach", function() {

            $("#upload-file").trigger('click');
        })

        $(document).on('change', "input[name='image-attachment']", function() {
            $('.la-paperclip').css('color', '#0d6efd');
        });

        $(document).ready(function() {
            // Get the container element
            var container = $('.items-container');
            container.scrollTop(container.prop('scrollHeight'));
        });
    </script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import {
            getAuth,
            signInAnonymously
        } from "https://www.gstatic.com/firebasejs/9.1.3/firebase-auth.js"
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/9.1.3/firebase-app.js";

        import {
            getFirestore,
            collection,
            getDocs,
            addDoc,
            orderBy,
            query
        } from "https://www.gstatic.com/firebasejs/9.1.3/firebase-firestore.js";

        const firebaseConfig = {
            apiKey: "AIzaSyDf4ELcOikFnTqdG0xqLSRJb1G8_m4VT7k",
            authDomain: "clearchoice-619de.firebaseapp.com",
            databaseURL: "https://clearchoice-619de-default-rtdb.firebaseio.com",
            projectId: "clearchoice-619de",
            storageBucket: "clearchoice-619de.appspot.com",
            messagingSenderId: "821858695540",
            appId: "1:821858695540:web:cf95a17411383e4d22d421",
            measurementId: "G-S14B9V3K3B"
        };

        var receiver_id = $("#ajax-chat-url").data('id');
        var serviceID = $("#ajax-chat-url-service-id").val();
        var group_id = receiver_id + "-" + serviceID;
        const app = initializeApp(firebaseConfig);
        let defaultFirestore = getFirestore(app);
        const auth = getAuth(app);
        signInAnonymously(auth)
            .then((result) => {
                console.log(result);
            }).catch((error) => {
                console.log('error', error);
                const errorCode = error.code;
                const errorMessage = error.message;
            });

        length = 36;
        const characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // characters used in string
        let result = ''; // initialize the result variable passed out of the function
        for (let i = length; i > 0; i--) {
            result += characters[Math.floor(Math.random() * characters.length)];
        }
        let random = result;


        window.sendNewMessage = async function(group_id_new2, message, receiver_id, userName, image = '') {
            if (image != '') {
                image = 'https://nileprojects.in/clearchoice-janitorial/public/upload/chat/' + image;
            } else {
                image = '';
            }
            const chatCol = collection(defaultFirestore, 'chatrooms/' + group_id_new2 + '/messages');
            let data = {
                image: image,
                text: message,
                status: 0,
                sendBy: '1',
                sendto: receiver_id,
                adminName: 'Admin',
                userName: userName,
                user: {
                    _id: 1
                },
                _id: random,
                createdAt: new Date()
            };

            // if (image) {
            //     data = {
            //         ...data,
            //         image: image
            //     };
            // }
            const add = await addDoc(chatCol, data);
            const chatCols = query(collection(defaultFirestore, 'chatrooms/' + group_id_new2 + '/messages'),
                orderBy('createdAt', 'asc'));
            const chatSnapshot = await getDocs(chatCols);
            const chatList = chatSnapshot.docs.map(doc => doc.data());
            showAllMessages(chatList);
            //location.reload();
        }


        window.getClientChat = async function(group_id, ajax_call = false) {
            const chatCols = query(collection(defaultFirestore, 'chatrooms/' + group_id + '/messages'),
                orderBy(
                    'createdAt',
                    'asc'));
            const chatSnapshot = await getDocs(chatCols);
            const chatList = chatSnapshot.docs.map(doc => doc.data());

            showAllMessages(chatList);

            //return chatList;
        }
        //getClientChat(group_id);
    </script>
    <script>
        $(document).ready(function() {
            $('#select_id').on('change', function() {
                var value = this.value; /*Service Id*/
                $('#ajax-chat-url-service-id').val(value);
                var receiver_id = $("#ajax-chat-url").data('id');
                var group_id = receiver_id + "-" + value;
                getClientChat(group_id);
                UpdateChatCount(value, receiver_id);
            });
            $(document).on('click', '.btnSend', function() {
                const userName = $("#ajax-chat-url-first").data('id');
                const receiver_id = $("#ajax-chat-url").data('id');
                var serviceID = $("#ajax-chat-url-service-id").val();
                if (serviceID != '') {
                    const group_id = receiver_id + "-" + serviceID;
                    let message = $('#message-input').val();
                    $(this).val('');
                    let time = moment().format('MMM DD, YYYY HH:mm A');
                    let image = '';
                    if ($('#upload-file')[0].files[0]) image = URL.createObjectURL($('#upload-file')[0]
                        .files[0]);
                    else image = '';
                    if (message != '' || image != '') {
                        // image = 'https://nileprojects.in/clearchoice-janitorial/public/upload/chat/' +
                        //     image;

                        let formData = new FormData();
                        formData.append('image', $('#upload-file')[0].files[0]);
                        formData.append('_token', "{{ csrf_token() }}");
                        if (image !== undefined && image !== '') {

                            $.ajax({
                                type: 'post',
                                url: "{{ url('/') }}" + '/support-save-img',
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(res) {
                                    console.log(res);
                                    if (res.status == false) {
                                        //alert(res.msg);
                                        return false;
                                    }
                                    if (res.status) {
                                        sendNewMessage(group_id, message, receiver_id,
                                            userName, res.url);
                                        $('#message-input').val('');

                                        $('#upload-file').val('');

                                        $('.la-paperclip').css('color', '#6c757d');
                                    }
                                }
                            })
                        } else {

                            sendNewMessage(group_id, message, receiver_id, userName);
                            $('#message-input').val('');
                            showMessage(message, time, userName, image);
                        }
                    }
                    $.ajax({
                        url: '{{ url('submit-chat-count') }}',
                        method: 'GET',
                        data: {
                            serviceID: serviceID,
                            receiver_id: receiver_id
                        },
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data) {

                        }
                    });
                } else {
                    alert('Please select service');
                    $('#message-input').val('');
                }
            })
        });
        //Update count accoding to user-service based (manage accoding database)
        function UpdateChatCount(serviceID, receiver_id) {
            $.ajax({
                url: '{{ url('update-chat-count') }}',
                method: 'POST',
                data: {
                    serviceID: serviceID,
                    receiver_id: receiver_id
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    alert(data);
                }
            });
        }

        //Showing all msg accoding user id and service id
        function showAllMessages(list, ajax_call = false) {
            if (list.length == 0) {
                $('.messages-list').html('');
            } else {
                let html = `${list.map(row => admin(row,ajax_call)).join('')}`;
                $('.messages-list').html(html);
            }

            // if (ajax_call == false) {
            //     $(".body-chat-message-user").stop().animate({
            //         scrollTop: $(".body-chat-message-user")[0].scrollHeight
            //     }, 1000);
            // }
        }

        //For showing one firebase msg after submit the input field
        function showMessage(message, time, userName) {
            let msg = `<div class="message-item  outgoing-message">
                        <div class="message-item-chat-card">
                            <div class="message-item-user">
                                <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                            </div>
                            <div class="message-item-chat-content">
                                <div class="message-content">
                                    ${message}
                                </div>
                                <div class="time">${time}</div>
                            </div>
                        </div>
                    </div>`;
            $('.messages-list').append(msg);

            $(".chat-panel-chat-body").stop().animate({
                scrollTop: $(".chat-panel-chat-body")[0].scrollHeight
            }, 1000);
        }
        //For showing all firebase msg
        function admin(row) {
            let html = '';
            var formattedDate = moment.unix(row.createdAt.seconds).format('MMM DD, YYYY HH:mm A');
            if (row.sendBy == 1) {

                html = `
                <div class="message-item  outgoing-message">
                        <div class="message-item-chat-card">
                            <div class="message-item-user">
                                <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                            </div>
                            <div class="message-item-chat-content">
                                <div class="message-content">
                                    ${(row.image !== undefined && row.image !== '') ? `<img style="border: 1px solid #eee; border-radius: 8px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" src="${row.image}" alt="avatar" class="d-flex align-self-center m-3" width="100"/>` : ''}
                                    ${(row.text !== '' && row.text !== undefined) ? `<p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">${row.text}</p>` : '' }
                                </div>
                                <div class="time">${formattedDate}</div>
                            </div>
                        </div>
                    </div>
                
                `;
            } else {
                html = `
                <div class="message-item ">
                        <div class="message-item-chat-card">
                            <div class="message-item-user">
                                <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                            </div>
                            <div class="message-item-chat-content">
                                <div class="message-content">
                                    ${(row.image !== undefined && row.image !== '') ? `<img style="border: 1px solid #eee; border-radius: 8px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" src="${row.image}" alt="avatar" class="d-flex align-self-center m-3" width="100"/>` : ''}
                                    ${(row.text !== '' && row.text !== undefined) ? `<p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">${row.text}</p>` : '' }
                                </div>
                                <div class="time">${formattedDate}</div>
                            </div>
                        </div>
                    </div>
                `;
            }
            return html;
        }
    </script>
    {{-- This function auto call after 5 second and show looping data accoding to service-ID   --}}
    <script>
        setInterval(function() {
            var receiver_id = $("#ajax-chat-url").data('id');
            var serviceID = $("#ajax-chat-url-service-id").val();
            var group_id = receiver_id + "-" + serviceID;
            getClientChat(group_id, true);
        }, 5000);
    </script>
@endsection
