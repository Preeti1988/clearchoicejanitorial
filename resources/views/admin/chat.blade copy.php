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
                    <h2>New Messages <span>08 New</span></h2>
                </div>
                <div class="chat-userlist-sidebar-body">
                    <form action="{{ route('Chats') }}" method="POST">
                        @csrf
                        <div class="chat-userlist-filter">

                            <input type="text" name="search" class="form-control" placeholder="Search by Employee Name">
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
                                            {{-- <p>hey! there I'm available</p> --}}
                                        </div>
                                        <div class="chat-userlist-item-content">
                                            <div class="chat-userlist-time">02:50 PM</div>
                                            <div class="unread-message"><span class="badge">02</span></div>
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
                            <select class="form-control">
                                <option>Select Service</option>
                                <option>Select: Service 1: Testla Motors HQ</option>
                            </select>
                        </div>
                    </div>

                    <div class="chat-panel-user-action">
                        <a class="viewbtn" href="#">View Job Details</a>
                    </div>
                </div>
                @if ($firstData)
                    <input type="hidden" id="ajax-chat-url" data-id="{{ $firstData->userid }}">
                    <input type="hidden" id="ajax-chat-url-first" data-id="{{ $firstData->first_name }}">
                    <input type="hidden" id="ajax-chat-url-last" data-id="{{ $firstData->last_name }}">
                @endif
                <div class="chat-panel-chat-body" tabindex="1" style="overflow: auto; outline: none;">
                    <div class="chat-panel-chat-content">
                        <div class="messages-list">
                            <div class="message-item  outgoing-message">
                                <div class="message-item-chat-card">
                                    <div class="message-item-user">
                                        <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                                    </div>
                                    <div class="message-item-chat-content">
                                        <div class="message-content">
                                            Did you make sure to clean the CEO's Cabin? 😃
                                        </div>
                                        <div class="time">2 Sep 2023, Sat: 12:03pm</div>
                                    </div>
                                </div>
                            </div>

                            <div class="message-item ">
                                <div class="message-item-chat-card">
                                    <div class="message-item-user">
                                        <img src="{{ asset('public/assets/admin-images/user-default.png') }}">
                                    </div>
                                    <div class="message-item-chat-content">
                                        <div class="message-content">
                                            Yes Boss, I have taken care of that. I have also informed to other employees
                                        </div>
                                        <div class="time">2 Sep 2023, Sat: 12:05pm</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="chat-panel-chat-footer">
                    <form>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Write a message.">
                                    <span class="form-attachemnt-icon">
                                        <img src="{{ asset('public/assets/admin-images/attachemnt.svg') }}">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn-send" title="" type="button">
                                    <img src="{{ asset('public/assets/admin-images/direction.svg') }}"> Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the active item element
        var activeItem = document.querySelector('.current-chat-active');
        if (activeItem) {
            activeItem.scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
    <script>
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

        const receiver_id = $("#ajax-chat-url").data('id');
        const group_id = "1-" + receiver_id;
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

        window.sendNewMessage = async function(group_id_new2, message, receiver_id, userName) {
            const chatCol = collection(defaultFirestore, 'chatrooms/' + group_id_new2 + '/messages');
            let data = {
                text: message,
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
            const chatCols = query(collection(defaultFirestore, 'chatrooms/' + group_id + '/messages'), orderBy(
                'createdAt',
                'asc'));
            const chatSnapshot = await getDocs(chatCols);
            const chatList = chatSnapshot.docs.map(doc => doc.data());
            showAllMessages(chatList);
            //return chatList;
        }
        getClientChat(group_id);
    </script>
    <script>
        $(document).ready(function() {
            const receiver_id = $("#ajax-chat-url").data('id');

            $(document).on('click', '.btnSend', function() {
                const user_firstName = $("#ajax-chat-url-first").data('id');
                const user_lastName = $("#ajax-chat-url-last").data('id');
                const userName = user_firstName + user_lastName;
                const receiver_id = $("#ajax-chat-url").data('id');
                const group_id = "1-" + receiver_id;
                let message = $('#message-input');
                let time = moment().format('MMM DD, YYYY HH:mm A');
                if (message.val() != '') {
                    sendNewMessage(group_id, message.val(), receiver_id, userName);
                    showMessage(message.val(), time, userName);
                    message.val('').focus();
                }

            })
        });

        function showAllMessages(list, ajax_call = false) {
            if (list.length == 0) return false;
            let html = `${list.map(row => admin(row,ajax_call)).join('')}`;
            $('.messages-card').html(html);
            if (ajax_call == false) {
                $(".body-chat-message-user").stop().animate({
                    scrollTop: $(".body-chat-message-user")[0].scrollHeight
                }, 1000);
            }
        }

        function showMessage(message, time, userName) {
            let msg = `<div class="message-user-right">
                        <div class="message-user-right-avtar">
                            <div class="message-user-right-img">
                                <img src="https://nileprojects.in/roadman/dev/public/assets/admin-images/no-image.png"
                                alt="">
                            </div>
                            <div class="message-user-title">
                                <h4>${userName} <span>${time}</span></h4>
                            </div>
                        </div>
                        <div class="message-user-right-text">
                            <p>${message}</p> 
                        </div>
                    </div>`;
            $('.messages-card').append(msg);

            $(".body-chat-message-user").stop().animate({
                scrollTop: $(".body-chat-message-user")[0].scrollHeight
            }, 1000);
        }

        function admin(row) {
            let html = '';
            var formattedDate = moment.unix(row.createdAt.seconds).format('MMM DD, YYYY HH:mm A');
            if (row.sendto == 1) {

                html = `
                    <div class="message-user-left">
                        <div class="message-user-left-avtar">
                            <div class="message-user-left-img">
                                <img src="https://nileprojects.in/roadman/dev/public/assets/admin-images/no-image.png" alt="user image" class="img-fluid">
                            </div>
                            <div class="message-user-title">
                                <h4>${row.userName} <span>${formattedDate}</span></h4>
                            </div>
                        </div>
                        <div class="message-user-left-text">
                            <p>${row.text}</p> 
                        </div>
                    </div>
                `;
            } else {
                html = `
                    <div class="message-user-right">
                        <div class="message-user-right-avtar">
                            <div class="message-user-right-img">
                                <img src="https://nileprojects.in/roadman/dev/public/assets/admin-images/no-image.png"
                                alt="">
                            </div>
                            <div class="message-user-title">
                                <h4>${row.adminName} <span>${formattedDate}</span></h4>
                            </div>
                        </div>
                        <div class="message-user-right-text">
                            <p>${row.text}</p> 
                        </div>
                    </div>
                `;
            }
            return html;
        }
    </script>
    <script>
        setInterval(function() {
            getClientChat(group_id, true);
        }, 5000);
    </script>
@endsection
